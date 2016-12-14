<?php

namespace Redbubble\HtmlBuilder;

use Redbubble\HtmlBuilder\Template\ModelTemplate;

class ModelPageBuilder extends AbstractPageBuilder
{
    public function getTemplate()
    {
        return new ModelTemplate();
    }
}