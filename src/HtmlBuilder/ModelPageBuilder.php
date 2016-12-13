<?php

class ModelPageBuilder extends AbstractPageBuilder
{
    public function __construct($images, $dir)
    {
        parent::__construct($images, $dir);

        $this->template = $this->getTemplate();
    }

    public function build()
    {
        // constrcut page object

        // pass to a renderer to generate files
    }

    protected function getTemplate()
    {
        return new ModelTemplate();
    }
}