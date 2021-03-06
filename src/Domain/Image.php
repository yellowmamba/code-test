<?php

namespace Redbubble\Domain;

class Image
{
    protected $id;

    protected $make;

    protected $model;

    protected $thumbnail;

    public function __construct($id, $thumbnail, $make = null, $model = null)
    {
        $this->id = $id;
        $this->thumbnail = $thumbnail;
        $this->make = $make;
        $this->model = $model;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    public function getMake()
    {
        return $this->make;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setMake($make)
    {
        $this->make = $make;

        return $this;
    }

    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }
}