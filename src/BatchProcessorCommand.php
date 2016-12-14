<?php

namespace Redbubble;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Client;
use Redbubble\ImageProvider\XmlProvider;
use Redbubble\Repository\ImageRepository;
use Redbubble\Domain\Page;
use Redbubble\HtmlBuilder\IndexPageBuilder;
use Redbubble\HtmlBuilder\MakePageBuilder;
use Redbubble\HtmlBuilder\ModelPageBuilder;
use Symfony\Component\Console\Input\InputArgument;

class BatchProcessorCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('redbubble:images-processor')
            ->setDescription('A batch processor to process image data')
            ->addArgument('url', InputArgument::REQUIRED, 'The endpoint of the API')
            ->addArgument('output', InputArgument::REQUIRED, 'The directory where files will be generated.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $outputDir = $input->getArgument('output');
        $url = $input->getArgument('url');

        if (!is_writable($outputDir)) {
            if (!@mkdir($outputDir)) {
                $output->writeln('<error>Cannot make directory writable: ' . $outputDir . '</error>');
                return;
            }
        }

        $output->writeln('Start processing...');

        try {
            $client = new Client([
                'base_uri' => $url
            ]);

            $response = $client->request('GET');

            $source = $response->getBody()->getContents();            
        } catch (\Exception $e) {
            $output->writeln('<error>Cannot retrieve content from the endpoint: ' . $url . '</error>');
            return;
        }

        try {
            $provider = new XmlProvider($source);
        } catch (\Exception $e) {
            $output->writeln('<error>Content from your endpoint is not valid XML.</error>');
            return;
        }

        try {
            $images = $provider->convertToImages();
            $repository = new ImageRepository($images);

            $allMakes = $repository->getAllMakes();

            // build Index page
            $indexPageTitle = 'Index';
            $firstTenImages = $repository->find(10);
            $indexPage = new Page($indexPageTitle, $allMakes, $firstTenImages);
            $indexPageBuilder = new IndexPageBuilder($indexPage, $outputDir);
            $indexPageBuilder->output();

            // build make and model pages
            foreach ($allMakes as $make) {
                // build make page
                $modelsOfMake = $repository->getAllModelsByMake($make);
                $makePageNav = array_merge([$indexPageTitle], $modelsOfMake);
                $makeGallery = $repository->findByMake($make, 10);
                $makePage = new Page($make, $makePageNav, $makeGallery);

                $makePageBuilder = new MakePageBuilder($makePage, $outputDir);
                $makePageBuilder->output();

                // build model pages of this make
                foreach ($modelsOfMake as $model) {
                    $modelPageNav = [$indexPageTitle, $make];
                    $modelGallery = $repository->findByMakeAndModel($make, $model);
                    $modelPage = new Page($model, $modelPageNav, $modelGallery);

                    $modelPageBuilder = new ModelPageBuilder($modelPage, $outputDir);
                    $modelPageBuilder->output();
                }
            }
        } catch (\Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return;
        }

        $output->writeln('Job done!');
    }
}