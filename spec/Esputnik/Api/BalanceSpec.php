<?php

namespace spec\Esputnik\Api;

use Esputnik\Api\Balance;
use Esputnik\Client;
use Esputnik\HttpClient\HttpClient;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BalanceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Balance::class);
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
            ->get('balance/', [])
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->show();
    }
}
