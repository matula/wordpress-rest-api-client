<?php

namespace Matula\WpApiClient\Endpoint;

/**
 * Class Posts
 * @package Matula\WpApiClient\Endpoint
 */
class Posts extends AbstractWpEndpoint
{
    protected function getEndpoint(): string
    {
        return '/wp-json/wp/v2/posts';
    }
}
