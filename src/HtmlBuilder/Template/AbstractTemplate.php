<?php

namespace Redbubble\HtmlBuilder\Template;

use Redbubble\Domain\Page;

abstract class AbstractTemplate
{
    abstract public function render(Page $page);
}