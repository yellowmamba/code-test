<?php

namespace Redbubble\HtmlBuilder;

use Redbubble\Repository\ImageRepositoryInterface;
use Redbubble\Domain\Page;

abstract class AbstractPageBuilder
{
    protected $page;

    protected $outputDir;

    protected $template;

    public function __construct(Page $page, $outputDir)
    {
        $this->page = $page;
        $this->outputDir = $outputDir;
        $this->template = $this->getTemplate();
    }

    abstract public function getTemplate();

    public function build()
    {
        $content = $this->template->render($this->page);

        file_put_contents($this->outputDir . $this->page->getTitle() . '.html', $content);
    }
}