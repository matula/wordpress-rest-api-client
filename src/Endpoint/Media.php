<?php

namespace Matula\WpApiClient\Endpoint;

use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use RuntimeException;

/**
 * Class Media
 * @package Matula\WpApiClient\Endpoint
 */
class Media extends AbstractWpEndpoint
{
    /**
     * {@inheritdoc}
     */
    protected function getEndpoint()
    {
        return '/wp-json/wp/v2/media';
    }

    /**
     * @param string $filePath absolute path of file to upload, or full URL of resource
     * @param array $data
     * @param string $mimeType if $filePath is a URL, the mime type of the file to be uploaded
     * @throws \RuntimeException
     * @return array
     */
    public function upload(string $filePath, array $data = [], $mimeType = null) : array
    {
        $url = $this->getEndpoint();

        if (isset($data['id'])) {
            $url .= '/' . $data['id'];
            unset($data['id']);
        }

        $fileName = basename($filePath);
        $fileHandle = fopen($filePath, "r");

        if ($fileHandle !== false) {
            if (!$mimeType) {
                $mimeType = mime_content_type($filePath);
            }

            $multipart = new MultipartStream([
                [
                    'name' => 'file',
                    'filename' => basename($filePath),
                    'Mime-Type' => mime_content_type($filePath),
                    'contents' => fopen($filePath, 'r'),
                ]
            ]);

            $request = new Request(
                'POST',
                $url,
                [
                    'Content-Type' => $mimeType,
                    'Content-Disposition' => 'attachment; filename="'.$fileName.'"'
                ],
                $multipart
            );
            $response = $this->client->send($request);
            if ($response->hasHeader('Content-Type') &&
                str_starts_with($response->getHeader('Content-Type')[0], 'application/json')) {
                    return json_decode($response->getBody()->getContents(), true);
            }
        }
        throw new RuntimeException('Unexpected response');
    }
}
