<?php

namespace Matula\WpApiClient\Endpoint;

/**
 * Class Categories
 * @package Matula\WpApiClient\Endpoint
 */
class Categories extends AbstractWpEndpoint
{
    /**
     * {@inheritdoc}
     */
    protected function getEndpoint()
    {
        return '/wp-json/wp/v2/categories';
    }
}
