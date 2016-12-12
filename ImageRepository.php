<?php

class ImageRepository implements ImageRepositoryInterface
{
    protected $images = [];

    public function __construct($images)
    {
        if (!is_array($images)) {
            throw new Exception("Cannot initialise the image repository.");
        }

        $this->images = $images;
    }

    public function findByModel($model)
    {

    }

    public function findByMake($make)
    {

    }

    public function find($limit = null)
    {

    }
}