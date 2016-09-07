<?php

namespace spec\Esputnik\Api;

use Esputnik\Client;
use Esputnik\Api\Sms;
use Esputnik\HttpClient\HttpClient;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SmsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Sms::class);
    }

    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_should_find_all_sms(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $httpClient
            ->get('messages/sms', [])
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->all();
    }

    function it_should_search_sms(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $httpClient
            ->get('messages/sms', ['search' => 'query'])
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->search('query');
    }
}
