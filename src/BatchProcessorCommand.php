<?php

namespace Redbubble;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Client;
use Redbubble\ImageProvider\XmlProvider;

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
        $client = new Client([
            'base_uri' => 'http://take-home-test.herokuapp.com/api/v1/'
        ]);

        $response = $client->request('GET', 'works.xml');

        $source = $response->getBody()->getContents();

        $provider = new XmlProvider($source);

        $images = $provider->convertToImages();
    }
}