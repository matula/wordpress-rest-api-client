<?php

namespace Matula\WpApiClient\Endpoint;

/**
 * Class Tags
 * @package Matula\WpApiClient\Endpoint
 */
class Tags extends AbstractWpEndpoint
{
    /**
     * {@inheritdoc}
     */
    protected function getEndpoint()
    {
        return '/wp-json/wp/v2/tags';
    }
}
