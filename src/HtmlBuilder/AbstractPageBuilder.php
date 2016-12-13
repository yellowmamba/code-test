<?php

abstract class AbstractPageBuilder
{
    protected $images;

    protected $dir;

    protected $template;

    public function __construct($images, $dir)
    {
        $this->images = $images;
        $this->dir = $dir;
    }

    abstract protected function getTemplate();

    abstract public function build();

}