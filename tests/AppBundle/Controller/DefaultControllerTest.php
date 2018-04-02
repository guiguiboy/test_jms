<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Model\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    public function testDenormalizer()
    {
        static::createClient();
        $serializer = static::$kernel->getContainer()->get('serializer');

        $userToPopulate = new User();
        $userToPopulate->setLogin('this will be replaced');

        $input = [
            'login' => 'guiguiboy',
            'firstname' => 'guigui',
            'lastname' => 'boy',
        ];

        $serializer->denormalize($input, User::class, null, [
            'object_to_populate' => $userToPopulate
        ]);
        $this->assertEquals('guiguiboy', $userToPopulate->getLogin());
    }
}
