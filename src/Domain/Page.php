<?php

namespace Redbubble\Domain;

class Page
{
    protected $title;

    protected $navigation;

    protected $gallery;

    public function __construct($title, $navigation, $gallery)
    {
        $this->title = $title;
        $this->navigation = $navigation;
        $this->gallery = $gallery;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getNavigation()
    {
        return $this->navigation;
    }

    public function getGallery()
    {
        return $this->gallery;
    }
}