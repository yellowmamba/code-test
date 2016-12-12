<?php

namespace Redbubble\ImageProvider;

use Redbubble\Domain\Image;

class XmlProvider implements ProviderInterface
{
    protected $xml;

    public function __construct($xml)
    {
        $this->xml = $xml;
    }

    public function convertToImages()
    {
        $works = new \SimpleXMLElement($this->xml);
        $images = [];

        foreach ($works->work as $work) {
            $imageId = (string) $work->id;
            $imageThumbnail = (string) $work->urls->xpath('url[@type="small"]')[0];

            $image = new Image($imageId, $imageThumbnail);

            $exif = $work->exif;

            if ($exif->model) {
                $image->setModel((string) $exif->model);
            }

            if ($exif->make) {
                $image->setMake((string) $exif->make);
            }

            $images[] = $image;
        }

        return $images;
    }
}