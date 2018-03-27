<?php
/**
 * Created by PhpStorm.
 * User: guigui
 * Date: 27/03/2018
 * Time: 23:31
 */

namespace AppBundle\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class User
 * @package AppBundle\Model
 *
 * @Serializer\ExclusionPolicy("ALL")
 */
class User
{
    /**
     * @var string
     *
     * @Serializer\Expose
     */
    protected $login;

    protected $firstName;

    protected $lastName;

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }



}