<?php
/**
 * Created by PhpStorm.
 * User: guigui
 * Date: 29/03/2018
 * Time: 17:14
 */

namespace Tests\AppBundle\Rest;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use AppBundle\Rest\Client as RestClient;
use Prophecy;

class ClientTest extends TestCase
{
    public function testGetUser()
    {
        $mockHandler = new MockHandler([
            new Response(200, [], '{"login":"mocked response"}')
        ]);

        $handler = HandlerStack::create($mockHandler);
        $client = new Client([
            'handler' => $handler
        ]);

        $restClient = new RestClient('http://example.com');
        $restClient->setClient($client);

        $response = $restClient->getUser('Paul');

        $this->assertEquals('mocked response', $response['login']);
    }

    public function testGetUserWithProphecy()
    {
        $prophet = new Prophecy\Prophet;

        $prophecy = $prophet->prophesize('GuzzleHttp\Client');

        $response1 = new Response(200, [], '{"login":"dummy_login"}');
        $response2 = new Response(200, [], '{"login":"pwet"}');

        $prophecy->get('/user/dummy_login')->willReturn($response1);
        $prophecy->get('/user/pwet')->willReturn($response2);
        $mockClient = $prophecy->reveal();

        $restClient = new RestClient('http://example.com');
        $restClient->setClient($mockClient);

        $this->assertInstanceOf(Client::class, $mockClient);
        $this->assertEquals('dummy_login', $restClient->getUser('dummy_login')['login']);
        $this->assertEquals('pwet', $restClient->getUser('pwet')['login']);



    }
}
