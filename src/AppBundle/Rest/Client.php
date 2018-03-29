<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guigui
 * Date: 29/03/2018
 * Time: 16:08
 */

namespace AppBundle\Rest;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;


class Client
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * Client constructor.
     * @param string $host
     */
    public function __construct(string $host)
    {
        $this->client = new GuzzleClient([
            'base_uri' => $host,
        ]);
    }

    public function getUser(string $login)
    {
        $response = $this->client->get('/user/' . $login);
        return json_decode((string) $response->getBody(), true);
    }

    public function getUserAsync(string $login)
    {
        $promise = $this->client->getAsync('/user/' . $login);
        $promise->wait();
    }

    public function setClient(GuzzleClient $client)
    {
        $this->client = $client;
    }
}
