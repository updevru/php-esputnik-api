<?php

namespace spec\Esputnik\Api;

use Esputnik\Client;
use Esputnik\HttpClient\HttpClient;
use Esputnik\Model\Channel;
use Esputnik\Api\Contact;
use Esputnik\Model\Contact as ContactModel;
use Esputnik\Model\Group;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContactSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Contact::class);
    }

    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_should_add_contact(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $json = '{"firstName":"firstName","channels":[{"type":"email","value":"channelname"}],"fields":[],"groups":[{"name":"groupname","type":"Static","types":["Static","Dynamic","Combined"]}]}';
        $httpClient
            ->post('contact/', $json)
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $contact = new ContactModel(
            'firstName',
            [new Group(Group::GROUP_TYPE_STATIC, 'groupname')],
            [new Channel(Channel::TYPE_EMAIL, 'channelname')]
        );

        $this->add($contact);
    }
}
