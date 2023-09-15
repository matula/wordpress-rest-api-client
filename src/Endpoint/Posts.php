<?php

namespace Matula\WpApiClient\Endpoint;

/**
 * Class Posts
 * @package Matula\WpApiClient\Endpoint
 */
class Posts extends AbstractWpEndpoint
{
    /**
     * {@inheritdoc}
     */
    protected function getEndpoint()
    {
        return '/wp-json/wp/v2/posts';
    }
}
