<?php

namespace Matula\WpApiClient\Auth;

use Psr\Http\Message\RequestInterface;

/**
 * Interface AuthInterface
 * @package Matula\WpApiClient\Auth
 */
interface AuthInterface
{
    /**
     * @param RequestInterface $request
     * @return mixed
     */
    public function addCredentials(RequestInterface $request);
}
