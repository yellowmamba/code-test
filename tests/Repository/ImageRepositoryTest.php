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
        $this->images = [
            new Image(1, 'url-1', 'Sony', 'model-1'),
            new Image(2, 'url-2', 'Sony', 'model-2'),
            new Image(3, 'url-3', 'Sony', 'model-2'),
            new Image(4, 'url-4', 'Canon', 'model-1'),
            new Image(5, 'url-5', 'Canon', 'model-1'),
            new Image(6, 'url-6', 'Nikon', 'model-1'),
            new Image(7, 'url-7', 'Nikon', 'model-2'),
            new Image(8, 'url-8', 'Nikon', 'model-2'),
            new Image(9, 'url-9', 'Nikon', 'model-2'),
        ];

        $this->repository = new ImageRepository($this->images);
    }

    public function testGetAllMakes()
    {
        $makes = $this->repository->getAllMakes();

        $this->assertCount(3, $makes);
        $this->assertContains('Sony', $makes);
        $this->assertContains('Canon', $makes);
        $this->assertContains('Nikon', $makes);
    }

    public function testGetAllModelsByMake()
    {
        $make = 'Sony';
        $models = $this->repository->getAllModelsByMake($make);

        $this->assertCount(2, $models);
        $this->assertContains('model-1', $models);
        $this->assertContains('model-2', $models);
    }

    public function testFindByMake()
    {
        $make = 'Nikon';
        $images = $this->repository->findByMake($make);

        $this->assertCount(4, $images);

        foreach ($images as $image) {
            $this->assertContains($image->getId(), [6, 7, 8, 9]);
        }
    }

    public function testFindByMakeAndModel()
    {
        $make = 'Nikon';
        $model = 'model-2';
        $images = $this->repository->findByMakeAndModel($make, $model);

        $this->assertCount(3, $images);

        foreach ($images as $image) {
            $this->assertContains($image->getId(), [7, 8, 9]);
        }
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