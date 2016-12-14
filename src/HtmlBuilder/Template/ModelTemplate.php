<?php

namespace Redbubble\HtmlBuilder\Template;

use Redbubble\Domain\Page;

class ModelTemplate extends AbstractTemplate
{
    public function render(Page $page)
    {
        $content = parent::render($page);

        // override ...

        return $content;
    }
}