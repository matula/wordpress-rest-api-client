<?php

namespace Matula\WpApiClient\Endpoint;

/**
 * Class PostTypes
 * @package Matula\WpApiClient\Endpoint
 */
class PostTypes extends AbstractWpEndpoint
{
    /**
     * {@inheritdoc}
     */
    protected function getEndpoint()
    {
        return '/wp-json/wp/v2/types';
    }
}
