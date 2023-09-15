<?php

namespace Matula\WpApiClient\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Interface ClientInterface
 * @package Matula\WpApiClient\Http
 */
interface ClientInterface
{
    /**
     * @param string $uri
     * @return UriInterface
     */
    public function makeUri($uri);

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function send(RequestInterface $request);
}
