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

class BatchProcessorCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('redbubble:images-processor')
            ->setDescription('A batch processor to process image data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Start processing...');

        $client = new Client([
            'base_uri' => 'http://take-home-test.herokuapp.com/api/v1/'
        ]);

        $response = $client->request('GET', 'works.xml');

        $source = $response->getBody()->getContents();

        $provider = new XmlProvider($source);

        $images = $provider->convertToImages();

        $repository = new ImageRepository($images);

        $allMakes = $repository->getAllMakes();
        $firstTenImages = $repository->find(10);

        // build Index page
        $indexPageTitle = 'Index';
        $indexPage = new Page($indexPageTitle, $allMakes, $firstTenImages);
        $indexPageBuilder = new IndexPageBuilder($indexPage, __DIR__ . '/output/');
        $indexPageBuilder->build();

        // build make and model pages
        foreach ($allMakes as $make) {
            // build make page
            $modelsOfMake = $repository->getAllModelsByMake($make);
            $makePageNav = $modelsOfMake + [$indexPageTitle];
            $makeGallery = $repository->findByMake($make);
            $makePage = new Page($make, $makePageNav, $makeGallery);

            $makePageBuilder = new MakePageBuilder($makePage, __DIR__ . '/output/');
            $makePageBuilder->build();

            // build model pages of this make
            foreach ($modelsOfMake as $model) {
                $modelPageNav = [$indexPageTitle, $make];
                $modelGallery = $repository->findByMakeAndModel($make, $model);
                $modelPage = new Page($model, $modelPageNav, $modelGallery);

                $modelPageBuilder = new ModelPageBuilder($modelPage, __DIR__ . '/output/');
                $modelPageBuilder->build();
            }
        }

        $output->writeln('Job done!');
    }
}