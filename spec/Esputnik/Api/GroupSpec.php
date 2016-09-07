<?php

namespace spec\Esputnik\Api;

use Esputnik\Client;
use Esputnik\Api\Group;
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
}
