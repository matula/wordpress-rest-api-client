<?php

namespace Matula\WpApiClient\Endpoint;

/**
 * Class PostStatuses
 * @package Matula\WpApiClient\Endpoint
 */
class PostStatuses extends AbstractWpEndpoint
{
    /**
     * {@inheritdoc}
     */
    protected function getEndpoint()
    {
        return '/wp-json/wp/v2/statuses';
    }
}
