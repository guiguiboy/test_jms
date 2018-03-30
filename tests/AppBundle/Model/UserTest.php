<?php
/**
 * Created by PhpStorm.
 * User: guigui
 * Date: 30/03/2018
 * Time: 16:20
 */

namespace Tests\AppBundle\Model;

use AppBundle\Model\User;
use PHPUnit\Framework\TestCase;
use Prophecy;

class UserTest extends TestCase
{
    /**
     * @var Prophecy\Prophet
     */
    protected $prophet;

    public function setUp()
    {
        parent::setUp();
        $this->prophet = new Prophecy\Prophet;
    }

    public function testUserWithProphecyDouble()
    {
        $userProphecy = $this->prophet->prophesize(User::class);

        $userProphecy->setLogin('guiguiboy')->will(function($args) use ($userProphecy) {
            $userProphecy->getFirstName()->willReturn('everzet');
        });

        $user = $userProphecy->reveal();
        $user->setLogin('guiguiboy');
        $this->assertEquals('everzet', $user->getFirstName());
    }

    public function testUserWithProphecyMultipleDoubles()
    {
        $userProphecy = $this->prophet->prophesize(User::class);

        $userProphecy->setLogin()->willReturn(null);

        $userProphecy->setLogin(Prophecy\Argument::containingString('guigui'))->will(function($args) use ($userProphecy) {
            $userProphecy->getFirstName()->willReturn('lol');
        });

        $userProphecy->setLogin('guiguiboy')->will(function($args) use ($userProphecy) {
            $userProphecy->getFirstName()->willReturn('everzet');
        });

        $user = $userProphecy->reveal();
        $user->setLogin('guigui');
        $this->assertEquals('lol', $user->getFirstName());
        //most precise prophecy wins here
        $user->setLogin('guiguiboy');
        $this->assertEquals('everzet', $user->getFirstName());
    }

    public function tearDown()
    {
        $this->prophet->checkPredictions();
        parent::tearDown();
    }
}
