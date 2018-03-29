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
}
