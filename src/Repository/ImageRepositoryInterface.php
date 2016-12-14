<?php

namespace Redbubble\Repository;

interface ImageRepositoryInterface
{
    public function getAllMakes();

    public function getAllModelsByMake($make);

    public function findByMake($make, $limit = null);

    public function findByMakeAndModel($make, $model, $limit = null);

    public function find($limit = null);
}