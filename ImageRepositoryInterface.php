<?php

interface ImageRepositoryInterface
{
    public function findByModel($model);

    public function findByMake($make);

    public function find($limit = null);
}