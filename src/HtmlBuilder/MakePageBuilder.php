<?php

namespace Redbubble\HtmlBuilder;

use Redbubble\HtmlBuilder\Template\MakeTemplate;

class MakePageBuilder extends AbstractPageBuilder
{
    public function getTemplate()
    {
        return new MakeTemplate();
    }
}