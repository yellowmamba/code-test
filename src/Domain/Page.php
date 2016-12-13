<?php

namespace Redbubble\Domain;

class Page
{
    protected $title;

    protected $navigation;

    protected $thumbnails;

    public function __construct($title, $navigation, $thumbnails)
    {
        $this->title = $title;
        $this->navigation = $navigation;
        $this->thumbnails = $thumbnails;
    }
}