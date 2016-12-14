<?php

use PHPUnit\Framework\TestCase;
use Redbubble\HtmlBuilder\IndexPageBuilder;
use Redbubble\HtmlBuilder\ModelPageBuilder;
use Redbubble\HtmlBuilder\MakePageBuilder;
use Redbubble\HtmlBuilder\AbstractPageBuilder;
use Redbubble\Repository\ImageRepository;
use Redbubble\ImageProvider\XmlProvider;
use Redbubble\HtmlBuilder\Template\AbstractTemplate;

class AbstractPageBuilderTest extends TestCase
{
    protected $page;

    protected $dir;

    public function setUp()
    {
        $this->page = $this
            ->getMockBuilder('\Redbubble\Domain\Page')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->dir = 'something';
    }

    public function testIndexPageTemplate()
    {
        $builder = new IndexPageBuilder($this->page, $this->dir);
        $template = $builder->getTemplate();
        $this->assertInstanceOf('Redbubble\HtmlBuilder\Template\IndexTemplate', $template);
    }

    public function testMakePageTemplate()
    {
        $builder = new MakePageBuilder($this->page, $this->dir);
        $template = $builder->getTemplate();
        $this->assertInstanceOf('Redbubble\HtmlBuilder\Template\MakeTemplate', $template);
    }

    public function testModelPageTemplate()
    {
        $builder = new ModelPageBuilder($this->page, $this->dir);
        $template = $builder->getTemplate();
        $this->assertInstanceOf('Redbubble\HtmlBuilder\Template\ModelTemplate', $template);
    }

    public function testBuild()
    {
        $builder = $this->getMockForAbstractClass(
            AbstractPageBuilder::class,
            [$this->page, $this->dir]
        );

        $template = $this
            ->getMockBuilder(AbstractTemplate::class)
            ->setMethods(['render'])
            ->getMockForAbstractClass()
        ;

        $template
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($this->page))
        ;

        $builder->expects($this->once())
             ->method('getTemplate')
             ->will($this->returnValue($template))
        ;

        $builder->createHtml();
    }
}