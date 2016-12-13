<?php

use PHPUnit\Framework\TestCase;
use Redbubble\Domain\Image;
use Redbubble\Repository\ImageRepository;
use Redbubble\ImageProvider\XmlProvider;

class ImageRepositoryTest extends TestCase
{
    protected $images;

    protected $repository;

    public function setUp()
    {
        $xml = file_get_contents(__DIR__ . '/fixtures/works.xml');

        $provider = new XmlProvider($xml);

        $this->images = $provider->convertToImages();

        $this->repository = new ImageRepository($this->images);
    }

    public function testFindByMakeAndModel()
    {
        $this->assertCount(5, $this->repository->findByMakeAndModel('LEICA', 'D-LUX 3'));
    }

    public function testFindByMake()
    {
        $this->assertCount(1, $this->repository->findByMake('FUJI PHOTO FILM CO., LTD.'));
    }

    public function testFindWithLimit()
    {
        $this->assertCount(7, $this->repository->find(7));
    }

    /**
     * @expectedException \Exception
     */
    public function testFindException()
    {
        $this->repository->find(-7);
    }

    public function testFindAll()
    {
        $this->assertCount(count($this->images), $this->repository->find());
    }
}