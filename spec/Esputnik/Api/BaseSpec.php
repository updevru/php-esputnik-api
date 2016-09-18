<?php

namespace spec\Esputnik\Api;

use Esputnik\Client;
use Esputnik\HttpClient\HttpClient;
use PhpSpec\ObjectBehavior;

class BaseSpec extends ObjectBehavior
{
    protected function getHttpClient(Client $client, HttpClient $httpClient)
    {
        return $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;
    }
}