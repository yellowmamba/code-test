<?php

namespace Redbubble\Repository;

use Redbubble\Domain\Image;

class ImageRepository implements ImageRepositoryInterface
{
    protected $images = [];

    public function __construct($images)
    {
        if (!is_array($images)) {
            throw new \Exception("Cannot initialise the image repository.");
        }

        $this->images = $images;
    }

    public function findByModel($model)
    {
        return array_filter($this->images, function (Image $image) use ($model) {
            return strtolower($image->getModel()) === strtolower($model);
        });
    }

    public function findByMake($make)
    {
        return array_filter($this->images, function (Image $image) use ($make) {
            return strtolower($image->getMake()) === strtolower($make);
        });
    }

    public function find($limit = null)
    {
        if (!$limit) {
            return $this->images;
        }

        if (is_int($limit) && $limit > 0) {
            return array_slice($this->images, 0, $limit);
        }

        throw new \Exception("If limit is specified, it must be a positive integer.");
    }
}