<?php

namespace spec\Esputnik\Api;

use Esputnik\Api\AddressBooks;
use Esputnik\Client;
use Esputnik\HttpClient\HttpClient;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AddressBooksSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AddressBooks::class);
    }

    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_should_show_balance(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $httpClient
            ->get('addressbooks/', [])
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->all();
    }
}
