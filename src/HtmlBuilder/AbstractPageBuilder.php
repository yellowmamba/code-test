<?php

namespace Redbubble\HtmlBuilder;

use Redbubble\Domain\Page;

abstract class AbstractPageBuilder
{
    protected $page;

    protected $dir;

    public function __construct(Page $page, $dir)
    {
        $this->page = $page;
        $this->dir = rtrim($dir, '/') . '/';
    }

    abstract public function getTemplate();

    public function createHtml()
    {
        return $this->getTemplate()->render($this->page);        
    }

    public function output()
    {
        $fileName = $this->page->getTitle() . '.html';
        file_put_contents($fileName, $this->createHtml());
        rename($fileName, $this->dir . $fileName);
    }
}