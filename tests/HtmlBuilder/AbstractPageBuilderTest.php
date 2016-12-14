<?php

use PHPUnit\Framework\TestCase;
use Redbubble\HtmlBuilder\IndexPageBuilder;
use Redbubble\HtmlBuilder\ModelPageBuilder;
use Redbubble\HtmlBuilder\MakePageBuilder;
use Redbubble\Repository\ImageRepository;
use Redbubble\ImageProvider\XmlProvider;

class AbstractPageBuilderTest extends TestCase
{
    protected $imageRepository;

    protected $dir;

    public function setUp()
    {
        $this->imageRepository = $this
            ->getMockBuilder('\Redbubble\Repository\ImageRepositoryInterface')
            ->getMock()
        ;

        $this->dir = 'some dir';
    }

    public function testIndexPageTemplate()
    {
        $builder = new IndexPageBuilder($this->imageRepository, $this->dir);
        $template = $builder->getTemplate();
        $this->assertInstanceOf('Redbubble\HtmlBuilder\Template\IndexTemplate', $template);
    }

    public function testMakePageTemplate()
    {
        $builder = new MakePageBuilder($this->imageRepository, $this->dir);
        $template = $builder->getTemplate();
        $this->assertInstanceOf('Redbubble\HtmlBuilder\Template\MakeTemplate', $template);
    }

    public function testModelPageTemplate()
    {
        $builder = new ModelPageBuilder($this->imageRepository, $this->dir);
        $template = $builder->getTemplate();
        $this->assertInstanceOf('Redbubble\HtmlBuilder\Template\ModelTemplate', $template);
    }

    public function testIndexPageBuild()
    {

    }

    public function testMakePageBuild()
    {

    }

    public function testModelPageBuild()
    {

    }
}