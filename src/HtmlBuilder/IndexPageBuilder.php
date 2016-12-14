<?php

namespace Redbubble\HtmlBuilder;

use Redbubble\HtmlBuilder\Template\IndexTemplate;

class IndexPageBuilder extends AbstractPageBuilder
{
    public function getTemplate()
    {
        return new IndexTemplate();
    }
}