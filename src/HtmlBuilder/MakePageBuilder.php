<?php

class MakePageBuilder extends AbstractPageBuilder
{
    public function build()
    {
        // constrcut page object

        // pass to a renderer to generate files
    }

    protected function getTemplate()
    {
        return new MakeTemplate();
    }
}