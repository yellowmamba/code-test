<?php

namespace Redbubble\HtmlBuilder\Template;

use Redbubble\Domain\Page;

abstract class AbstractTemplate
{
    public function render(Page $page)
    {
        $html = '<h1>' . $page->getTitle() . '</h1>';

        // render nav
        $html .= '<ul>';

        foreach ($page->getNavigation() as $navItem) {
            $html .= '<li><a href="' . $navItem . '.html' . '">' . $navItem . '</a></li>';
        }

        $html .= '</ul>';

        // render gallery
        $html .= '<ul>';

        foreach ($page->getGallery() as $image) {
            $html .= '<li><img src="' . $image->getThumbnail() . '" /></li>';
        }

        $html .= '</ul>';

        return $html;
    }
}