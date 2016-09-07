<?php

namespace spec\Esputnik\Api;

use Esputnik\Client;
use Esputnik\Api\Unsubscribe;
use Esputnik\HttpClient\HttpClient;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnsubscribeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Unsubscribe::class);
    }

    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_should_add_unsubscribe(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $httpClient
            ->post('emails/unsubscribe/add', '{"emails":["email1","email2"]}')
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->add(['email1', 'email2']);
    }

    function it_should_remove_unsubscribe(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $httpClient
            ->post('emails/unsubscribe/delete', '{"emails":["email1","email2"]}')
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->remove(['email1', 'email2']);
    }
}
