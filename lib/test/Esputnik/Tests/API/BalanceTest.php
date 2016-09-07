<?php

namespace test\Esputnik\Tests\API;

use Esputnik\Api\Client;
use GuzzleHttp\Psr7\Response;

class BalanceTest extends \PHPUnit_Framework_TestCase
{
    public function testShow()
    {
        $httpClient = $this->getMockBuilder('\Esputnik\HttpClient\HttpClient')
            ->setMethods(['get', 'request'])
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $httpClient
            ->expects($this->once())
            ->method('get')
            ->with('balance/')
            ->willReturn(new Response());
        ;

        $clientMock = $this->getMockBuilder('\Esputnik\Api\Client')
            ->setMethods(['getHttpClient'])
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $clientMock
            ->expects($this->once())
            ->method('getHttpClient')
            ->willReturn($httpClient)
        ;

        $clientMock->api('balance')->show();
    }
}