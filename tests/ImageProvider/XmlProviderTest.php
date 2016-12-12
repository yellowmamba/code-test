<?php

use PHPUnit\Framework\TestCase;

class ImageProviderTest extends TestCase
{
    public function testXmlProvier()
    {
        $xml = simplexml_load_file('fixtures/works.xml');

        $provider = new XmlProvider($xml);

        $images = $provider->convertToImages();
    }
}