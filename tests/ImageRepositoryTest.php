<?php

use PHPUnit\Framework\TestCase;

class ImageRepositoryTest extends TestCase
{
    protected $images;

    protected $repository;

    public function setUp()
    {
        $this->images = [
            new Image('Sony', 'sony-model-1', 'http://sony/item-1'),
            new Image('Sony', 'sony-model-1', 'http://sony/item-2'),
            new Image('Sony', 'sony-model-2', 'http://sony/item-3'),
            new Image('Sony', 'sony-model-3', 'http://sony/item-4'),
            new Image('Canon', 'canon-model-1', 'http://canon/item-1'),
            new Image('Canon', 'canon-model-1', 'http://canon/item-2'),
            new Image('Canon', 'canon-model-1', 'http://canon/item-3'),
            new Image('Canon', 'canon-model-2', 'http://canon/item-4'),
            new Image('Canon', 'canon-model-2', 'http://canon/item-5'),
            new Image('Nikon', 'nikon-model-1', 'http://nikon/item-1'),
            new Image('Nikon', 'nikon-model-1', 'http://nikon/item-2'),
            new Image('Nikon', 'nikon-model-2', 'http://nikon/item-3'),
        ];

        $this->repository = new ImageRepository($this->images);
    }

    public function testFindByModel()
    {
        $this->assertCount(3, $this->repository->findByModel('canon-model-1'));
    }

    public function testFindByMake()
    {
        $this->assertCount(4, $this->repository->findByMake('Sony'));
    }

    public function testFindWithLimit()
    {
        $this->assertCount(6, $this->repository->find(6));
    }

    public function testFindAll()
    {
        $this->assertCount(count($this->images), $this->repository->find());
    }
}