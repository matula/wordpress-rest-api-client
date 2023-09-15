<?php

namespace Matula\WpApiClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Matula\WpApiClient\Auth\AuthInterface;
use Matula\WpApiClient\Endpoint;
use Matula\WpApiClient\Http\ClientInterface;

/**
 * Class WpClient
 * @package Matula\WpApiClient
 *
 * @method Endpoint\Categories categories()
 * @method Endpoint\Comments comments()
 * @method Endpoint\Media media()
 * @method Endpoint\Pages pages()
 * @method Endpoint\Posts posts()
 * @method Endpoint\PostStatuses postStatuses()
 * @method Endpoint\PostTypes postTypes()
 * @method Endpoint\Tags tags()
 * @method Endpoint\Users users()
 */
class WpClient
{
    private Client|ClientInterface $httpClient;

    private ?AuthInterface $credentials = null;

    private string $wordpressUrl;

    private array $endPoints = [];

    public function __construct(string $wordpressUrl = '')
    {
        $this->httpClient   = new Client();
        $this->wordpressUrl = $wordpressUrl;
    }

    public function setWordpressUrl(string $wordpressUrl): void
    {
        $this->wordpressUrl = $wordpressUrl;
    }

    public function setCredentials(AuthInterface $auth): void
    {
        $this->credentials = $auth;
    }

    public function __call($endpoint, array $args)
    {
        if (!isset($this->endPoints[$endpoint])) {
            $class = 'Matula\WpApiClient\Endpoint\\' . ucfirst($endpoint);
            if (class_exists($class)) {
                $this->endPoints[$endpoint] = new $class($this);
            } else {
                throw new RuntimeException('Endpoint "' . $endpoint . '" does not exist"');
            }
        }

        return $this->endPoints[$endpoint];
    }

    public function send(RequestInterface $request): ResponseInterface
    {
        if ($this->credentials) {
            $request = $this->credentials->addCredentials($request);
        }

        $request = $request->withUri(
            $this->httpClient->makeUri($this->wordpressUrl . $request->getUri())
        );

        try {
            return $this->httpClient->send($request);
        } catch (GuzzleException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
