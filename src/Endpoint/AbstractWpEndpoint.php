<?php

namespace Matula\WpApiClient\Endpoint;

use GuzzleHttp\Psr7\Request;
use RuntimeException;
use Matula\WpApiClient\WpClient;

/**
 * Class AbstractWpEndpoint
 * @package Matula\WpApiClient\Endpoint
 */
abstract class AbstractWpEndpoint
{
    /**
     * @var WpClient
     */
    protected $client;

    /**
     * Users constructor.
     * @param WpClient $client
     */
    public function __construct(WpClient $client)
    {
        $this->client = $client;
    }

    abstract protected function getEndpoint();

    /**
     * @param int $id
     * @param array $params - parameters that can be passed to GET
     *        e.g. for tags: https://developer.wordpress.org/rest-api/reference/tags/#arguments
     * @return array
     * @throws \RuntimeException
     */
    public function get($id = null, array $params = null): array
    {
        $uri = $this->getEndpoint();
        $uri .= (is_null($id) ? '' : '/' . $id);
        $uri .= (is_null($params) ? '' : '?' . http_build_query($params));

        $request  = new Request('GET', $uri);
        $response = $this->client->send($request);

        return $this->generateResponse($response);
    }

    /**
     * @param array $data
     * @return array
     * @throws \RuntimeException
     */
    public function save(array $data): array
    {
        $url = $this->getEndpoint();

        if (isset($data['id'])) {
            $url .= '/' . $data['id'];
            unset($data['id']);
        }

        $request  = new Request('POST', $url, ['Content-Type' => 'application/json'], json_encode($data));
        $response = $this->client->send($request);

        return $this->generateResponse($response);
    }

    /**
     * @param array $data
     * @return array
     * @throws \RuntimeException
     */
    public function delete(array $data): array
    {
        $url = $this->getEndpoint();

        if (isset($data['ID'])) {
            $url .= '/' . $data['ID'];
        }

        $request  = new Request('DELETE', $url);
        $response = $this->client->send($request);

        return $this->generateResponse($response);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return mixed
     */
    protected function generateResponse(\Psr\Http\Message\ResponseInterface $response): mixed
    {
        if ($response->hasHeader('Content-Type')
            && str_starts_with($response->getHeader('Content-Type')[0], 'application/json')) {
            return json_decode($response->getBody()->getContents(), true);
        }

        throw new RuntimeException('Unexpected response');
    }
}
