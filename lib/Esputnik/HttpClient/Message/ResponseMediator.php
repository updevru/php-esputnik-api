<?php

namespace Esputnik\HttpClient\Message;

use GuzzleHttp\Psr7\Response;

class ResponseMediator
{
    public static function getContent(Response $response)
    {
        $contentType = $response->getHeader('Content-Type');

        $body = $response->getBody();
        if ($contentType and strpos($contentType[0], 'application/json') === 0) {
            $content = json_decode($body, true);
            if (JSON_ERROR_NONE === json_last_error()) {
                return $content;
            }
        }

        return $body;
    }
}
