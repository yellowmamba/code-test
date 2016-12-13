<?php

namespace Redbubble\HtmlBuilder;

use Redbubble\HtmlBuilder\Template\IndexTemplate;

class IndexPageBuilder extends AbstractPageBuilder
{
    public function build()
    {
        // constrcut page object

        // pass to a renderer to generate files
    }

    public function getTemplate()
    {
        return new IndexTemplate();
    }
}