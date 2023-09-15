<?php

namespace Matula\WpApiClient\Endpoint;

/**
 * Class Pages
 * @package Matula\WpApiClient\Endpoint
 */
class Pages extends AbstractWpEndpoint
{
    /**
     * {@inheritdoc}
     */
    protected function getEndpoint()
    {
        return '/wp-json/wp/v2/pages';
    }
}
