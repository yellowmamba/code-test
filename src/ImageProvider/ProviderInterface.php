<?php

namespace Redbubble\ImageProvider;

interface ProviderInterface
{
    /**
     * Convert data source to collection of Image objects
     *
     * @return array
     */
    public function convertToImages();
}