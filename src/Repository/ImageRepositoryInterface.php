<?php

namespace Redbubble\Repository;

interface ImageRepositoryInterface
{
    public function getAllMakes();

    public function getAllModelsByMake($make);

    public function findByMake($make);

    public function findByMakeAndModel($make, $model);

    public function find($limit = null);
}