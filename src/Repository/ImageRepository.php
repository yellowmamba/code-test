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

    /**
     * {@inheritDoc}
     */
    public function getAllMakes()
    {
        $makes = [];

        foreach ($this->images as $image) {
            $make = $image->getMake();
            if ($make) {
                $makes[$make] = $make;
            }
        }

        return array_values($makes);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllModelsByMake($make)
    {
        $models = [];

        foreach ($this->images as $image) {
            if (strtolower($image->getMake()) === strtolower($make)) {
                $model = $image->getModel();
                if ($model) {
                    $models[$model] = $model;
                }
            }
        }

        return array_values($models);
    }

    /**
     * {@inheritDoc}
     */
    public function findByMake($make, $limit = null)
    {
        $result = array_filter($this->images, function (Image $image) use ($make) {
            return strtolower($image->getMake()) === strtolower($make);
        });

        if (!$limit) {
            return $result;
        }

        if (is_int($limit) && $limit > 0) {
            return array_slice($result, 0, $limit);
        }

        throw new \Exception(
            "Invalid limit: " . $limit . " is specified for 'findByMake' method, it must be a positive integer if supplied."
        );
    }

    /**
     * {@inheritDoc}
     */
    public function findByMakeAndModel($make, $model, $limit = null)
    {
        $result = array_filter($this->images, function (Image $image) use ($make, $model) {
            return strtolower($image->getMake()) === strtolower($make) &&
                strtolower($image->getModel()) === strtolower($model);
        });

        if (!$limit) {
            return $result;
        }

        if (is_int($limit) && $limit > 0) {
            return array_slice($result, 0, $limit);
        }

        throw new \Exception(
            "Invalid limit: " . $limit . " is specified for 'findByMakeAndModel' method, it must be a positive integer if supplied."
        );
    }

    /**
     * {@inheritDoc}
     */
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