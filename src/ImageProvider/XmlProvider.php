<?php

namespace Redbubble\ImageProvider;

use Redbubble\Domain\Image;

class XmlProvider implements ProviderInterface
{
    protected $works;

    public function __construct($xml)
    {
        $this->works = new \SimpleXMLElement($xml);
    }

    public function convertToImages()
    {
        $images = [];

        foreach ($this->works->work as $work) {
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