<?php

namespace spec\Esputnik\Api;

use Esputnik\Client;
use Esputnik\Api\Message;
use Esputnik\HttpClient\HttpClient;
use Esputnik\Model\MessageParam;
use Esputnik\Model\ParametrizedRecipient;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Esputnik\Model\Contact as ContactModel;
use Esputnik\Model\Group as GroupModel;
use Esputnik\Model\Channel as ChannelModel;

class MessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Message::class);
    }

    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_should_send_message(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $json = '{"email":true,"params":[{"key":"key","value":"value"}],"fromName":"Sender","recipients":["email1@mail.ru","email2@mail.ru"]}';
        $httpClient
            ->post('message/7/send', $json)
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $contact = new ContactModel(
            'firstName',
            [new GroupModel(GroupModel::GROUP_TYPE_STATIC, 'groupname')],
            [new ChannelModel(ChannelModel::TYPE_EMAIL, 'channelname')]
        );

        $this->send(
            7,
            $contact,
            true,
            [new MessageParam('key', 'value')],
            'Sender',
            ['email1@mail.ru', 'email2@mail.ru'],
            new GroupModel(GroupModel::GROUP_TYPE_STATIC, 'groupname')
        );
    }

    function it_should_smart_send_message(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $json = '{"recipients":[{"email":"email@gmailc.om","jsonParam":"[{\"key\":\"key\",\"value\":\"value\"}]","locator":"locator"}],"email":true,"fromName":"fromemail@gmail.com"}';
        $httpClient
            ->post('message/7/smartsend', $json)
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $contact = new ContactModel(
            'firstName',
            [new GroupModel(GroupModel::GROUP_TYPE_STATIC, 'groupname')],
            [new ChannelModel(ChannelModel::TYPE_EMAIL, 'channelname')]
        );

        $this->smartSend(
            7,
            [
                new ParametrizedRecipient(
                    $contact,
                    'email@gmailc.om',
                    [
                        new MessageParam('key', 'value')
                    ],
                    'locator'
                )
            ],
            true,
            'fromemail@gmail.com'
        );
    }

    function it_should_send_email(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $json = '{"from":"sender@gmail.com","subject":"Subject","htmlText":"<html><body><h1>\u0422\u0415\u0421\u0422!<\/h1><\/body><\/html>","plainText":"plainText","emails":["receive1@gmail.com","receive2@gmail.com"],"tags":["tag1"]}';
        $httpClient
            ->post('message/email/', $json)
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->email(
            'sender@gmail.com',
            'Subject',
            '<html><body><h1>ТЕСТ!</h1></body></html>',
            'plainText',
            ['receive1@gmail.com', 'receive2@gmail.com'],
            ['tag1']
        );
    }

    function it_should_get_email_status(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;


        $httpClient
            ->get('message/email/status/', ['ids' => 'id1,id2'])
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->emailStatus(['id1', 'id2']);
    }

    function it_should_sms(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $json = '{"from":"from@email.com","text":"smstext","phoneNumbers":[380999135853,2499311313],"groupId":2}';

        $httpClient
            ->post('message/sms/', $json)
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->sms('from@email.com', 'smstext', ['tag1'], [380999135853, 2499311313], 2);
    }

    function it_should_get_sms_status(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;


        $httpClient
            ->get('message/sms/status/', ['ids' => 'id1,id2'])
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->smsStatus(['id1', 'id2']);
    }
}
