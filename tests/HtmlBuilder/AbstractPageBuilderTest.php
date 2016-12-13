<?php

use PHPUnit\Framework\TestCase;
use Redbubble\HtmlBuilder\IndexPageBuilder;
use Redbubble\HtmlBuilder\ModelPageBuilder;
use Redbubble\HtmlBuilder\MakePageBuilder;

class AbstractPageBuilderTest extends TestCase
{
    protected $images;

    protected $dir;

    public function testIndexPageTemplate()
    {
        $builder = new IndexPageBuilder($this->images, $this->dir);
        $template = $builder->getTemplate();
        $this->assertInstanceOf('Redbubble\HtmlBuilder\Template\IndexTemplate', $template);
    }

    public function testMakePageTemplate()
    {
        $builder = new MakePageBuilder($this->images, $this->dir);
        $template = $builder->getTemplate();
        $this->assertInstanceOf('Redbubble\HtmlBuilder\Template\MakeTemplate', $template);
    }

    public function testModelPageTemplate()
    {
        $builder = new ModelPageBuilder($this->images, $this->dir);
        $template = $builder->getTemplate();
        $this->assertInstanceOf('Redbubble\HtmlBuilder\Template\ModelTemplate', $template);
    }
}