<?php

namespace spec\Esputnik\Api;

use Esputnik\Client;
use Esputnik\Api\Messages;
use Esputnik\HttpClient\HttpClient;
use Esputnik\Model\EmailMessage;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MessagesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Messages::class);
    }

    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_should_add_email(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $json = '{"name":"enail name","from":"Esputnik <esputnik@email.ua>","subject":"Subject","htmlText":"<html><body><h1>\u0422\u0415\u0421\u0422!<\/h1><\/body><\/html>","tags":["tag1"]}';
        $httpClient
            ->post('messages/email/', $json)
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $emailMessage = new EmailMessage(
            'enail name',
            "Esputnik <esputnik@email.ua>",
            'Subject',
            '<html><body><h1>ТЕСТ!</h1></body></html>',
            ['tag1']
        );

        $this->add($emailMessage);
    }

    function it_should_show_all_emails(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $httpClient
            ->get('messages/email/', [], ['maxrows' => 10, 'startindex' => 99])
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->all(['maxrows' => 10, 'startindex' => 99]);
    }

    function it_should_search_emails(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $httpClient
            ->get('messages/email/', ['search' => 'somevalue'], ['maxrows' => 10, 'startindex' => 99])
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->search('somevalue', ['maxrows' => 10, 'startindex' => 99]);
    }

    function it_should_show_email(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $httpClient
            ->get('messages/email/7', [], [])
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->show(7);
    }

    function it_should_remove_email(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $httpClient
            ->delete('messages/email/7', '[]')
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $this->remove(7);
    }

    function it_should_update_email(Client $client, HttpClient $httpClient)
    {
        $client
            ->getHttpClient()
            ->willReturn($httpClient)
        ;

        $json = '{"name":"enail name","from":"Esputnik <esputnik@email.ua>","subject":"Subject","htmlText":"<html><body><h1>\u0422\u0415\u0421\u0422!<\/h1><\/body><\/html>","tags":["tag1"]}';
        $httpClient
            ->put('messages/email/7', $json)
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        $emailMessage = new EmailMessage(
            'enail name',
            "Esputnik <esputnik@email.ua>",
            'Subject',
            '<html><body><h1>ТЕСТ!</h1></body></html>',
            ['tag1']
        );

        $this->update(7, $emailMessage);
    }
}
