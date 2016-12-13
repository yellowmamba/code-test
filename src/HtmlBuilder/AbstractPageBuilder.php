<?php

namespace Redbubble\HtmlBuilder;

use Redbubble\Repository\ImageRepositoryInterface;

abstract class AbstractPageBuilder
{
    protected $repository;

    protected $dir;

    protected $template;

    public function __construct(ImageRepositoryInterface $repository, $dir)
    {
        $this->repository = $repository;
        $this->dir = $dir;
        $this->template = $this->getTemplate();
    }

    abstract public function getTemplate();

    abstract public function build();

}