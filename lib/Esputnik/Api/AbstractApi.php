<?php

namespace Esputnik\Api;

use Esputnik\Client;
use Esputnik\HttpClient\Message\ResponseMediator;
use GuzzleHttp\Psr7\Response;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;

abstract class AbstractApi
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send a GET request with query parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     GET parameters.
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    protected function get($path, array $parameters = [])
    {
        $response = $this->client->getHttpClient()->get($path, $parameters);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a HEAD request with query parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     HEAD parameters.
     * @param array  $requestHeaders Request headers.
     *
     * @return Response
     */
    protected function head($path, array $parameters = [], $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->request($path, null, 'HEAD', $requestHeaders);

        return $response;
    }

    /**
     * Send a POST request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param array $parameters POST parameters to be JSON encoded
     *
     * @return string
     */
    protected function post($path, $parameters = [])
    {
        return $this->postRaw(
            $path,
            $this->createJsonBody($parameters)
        );
    }

    /**
     * Send a POST request with raw data.
     *
     * @param string $path           Request path.
     * @param $body                     array body.
     *
     * @return mixed|string
     */
    protected function postRaw($path, $body)
    {
        $response = $this->client->getHttpClient()->post(
            $path,
            $body
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PATCH request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param array $parameters POST parameters to be JSON encoded
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    protected function patch($path, array $parameters = [])
    {
        $response = $this->client->getHttpClient()->patch(
            $path,
            $this->createJsonBody($parameters)
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PUT request with JSON-encoded parameters.
     *
     * @param string $path Request path.
     * @param array $parameters POST parameters to be JSON encoded.
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    protected function put($path, $parameters = [])
    {
        $response = $this->client->getHttpClient()->put($path, $this->createJsonBody($parameters));

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a DELETE request with JSON-encoded parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     POST parameters to be JSON encoded.
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    protected function delete($path, array $parameters = [])
    {
        $response = $this->client->getHttpClient()->delete($path, $this->createJsonBody($parameters));

        return ResponseMediator::getContent($response);
    }

    /**
     * Create a JSON encoded version of an array of parameters.
     *
     *
     * @return null|string
     */
    protected function createJsonBody($parameters)
    {
        $serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
            ->build();

        return $serializer->serialize($parameters, 'json');
    }
}
