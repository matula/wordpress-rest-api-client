<?php

namespace Matula\WpApiClient\Endpoint;

/**
 * Class Users
 * @package Matula\WpApiClient\Endpoint
 */
class Users extends AbstractWpEndpoint
{
    /**
     * {@inheritdoc}
     */
    protected function getEndpoint()
    {
        return '/wp-json/wp/v2/users';
    }
}
