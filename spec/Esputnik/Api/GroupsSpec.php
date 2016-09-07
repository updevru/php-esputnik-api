<?php

namespace spec\Esputnik\Api;

use Esputnik\Client;
use Esputnik\Api\Groups;
use Esputnik\HttpClient\HttpClient;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GroupsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Groups::class);
    }

    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_should_search_groups_by_name(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $httpClient
            ->get('groups/', ['name' => 'name'])
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->search('name');
    }

    function it_should_show_all_groups(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $httpClient
            ->get('groups/', [])
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->all();
    }
}
