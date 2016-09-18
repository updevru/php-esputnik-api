<?php

namespace spec\Esputnik\Api;

use Esputnik\Client;
use Esputnik\Api\Group;
use Esputnik\HttpClient\HttpClient;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GroupSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Group::class);
    }

    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_should_get_all_contacts_from_group(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $httpClient
            ->get('group/231/contacts', [], ['maxrows' => 10, 'startindex' => 99])
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->contacts(231, ['maxrows' => 10, 'startindex' => 99]);
    }
}
