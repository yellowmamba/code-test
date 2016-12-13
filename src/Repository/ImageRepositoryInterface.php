<?php

namespace Redbubble\Repository;

interface ImageRepositoryInterface
{
    public function findByMakeAndModel($make, $model);

    public function findByMake($make);

    public function find($limit = null);
}