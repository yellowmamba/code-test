<?php

namespace Redbubble\Repository;

interface ImageRepositoryInterface
{
    /**
     * Get all make names from all images
     *
     * @return array
     */
    public function getAllMakes();

    /**
     * Get all model names of a make
     *
     * @param  string $make
     * @return array
     */
    public function getAllModelsByMake($make);

    /**
     * Retrieve images of a make
     *
     * @param  string $make
     * @param  int|null $limit
     * @return array a collection of Image objects
     */
    public function findByMake($make, $limit = null);

    /**
     * Retrieve images of a specific model of a make
     *
     * @param  string $make
     * @param  string $model
     * @param  int|null $limit
     * @return array a collection of Image objects
     */
    public function findByMakeAndModel($make, $model, $limit = null);

    /**
     * retrieve images
     *
     * @param  int|null $limit
     * @return array a collection of Image objects
     */
    public function find($limit = null);
}