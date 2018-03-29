<?php
/**
 * Created by PhpStorm.
 * User: guigui
 * Date: 27/03/2018
 * Time: 23:31
 */

namespace AppBundle\Model;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\JsonSerializationVisitor;

/**
 * Class User
 * @package AppBundle\Model
 *
 * @Serializer\ExclusionPolicy("ALL")
 *
 * @Serializer\VirtualProperty(
 *     "full_name",
 *     exp="object.getPrintableName()"
 * )
 *
 */
class User
{
    protected $id;

    /**
     * @var string
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    protected $login;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     * @Serializer\Expose
     */
    protected $firstName;

    protected $lastName;

    /**
     * @var PreferenceCollection
     *
     * @Serializer\Expose
     * @Serializer\Since("1.5.0")
     */
    protected $preferences;

    protected $passwordHash;

    /**
     * @Serializer\Expose
     *
     * @var array
     */
    protected $baskets = [];


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
     * @return string
     */
    public function getPrintableName()
    {
        return $this->firstName . ' ' . $this->lastName . ' (' . $this->login . ')';
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

    /**
     * @param PreferenceCollection $preferences
     */
    public function setPreferences(PreferenceCollection $preferences)
    {
        $this->preferences = $preferences;
    }

    /**
     * @return PreferenceCollection
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    public function getBaskets()
    {
        return $this->baskets;
    }

    public function addBasket(Basket $basket)
    {
        $this->baskets[] = $basket;
    }
}
