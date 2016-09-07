<?php

namespace spec\Esputnik\Api;

use Esputnik\Api\Callouts;
use Esputnik\Client;
use Esputnik\HttpClient\HttpClient;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CalloutsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Callouts::class);
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
            ->get('callouts/sms/', [])
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->sms();
    }
}
