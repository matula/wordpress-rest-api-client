<?php

namespace Matula\WpApiClient\Endpoint;

/**
 * Class Comments
 * @package Matula\WpApiClient\Endpoint
 */
class Comments extends AbstractWpEndpoint
{
    /**
     * {@inheritdoc}
     */
    protected function getEndpoint()
    {
        return '/wp-json/wp/v2/comments';
    }
}
