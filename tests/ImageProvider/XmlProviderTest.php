<?php

use PHPUnit\Framework\TestCase;
use Redbubble\ImageProvider\XmlProvider;

class ImageProviderTest extends TestCase
{
    public function testXmlProvier()
    {
        $xml = file_get_contents(__DIR__ . '/fixtures/works.xml');

        $provider = new XmlProvider($xml);

        $images = $provider->convertToImages();

        $this->assertCount(11, $images);
    }
}