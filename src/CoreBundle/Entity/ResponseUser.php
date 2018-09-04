<?php

namespace CoreBundle\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class ResponseUser.
 */
class ResponseUser
{
    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    private $id;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    private $username;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    private $email;

    /**
     * @var string
     *
     * @JMS\Type("integer")
     */
    private $phone;

    /**
     * @var string
     *
     * @JMS\Groups({"post_user_register", "post_user_login"})
     * @JMS\Type("string")
     */
    private $token;

    /**
     * @var User
     *
     * @JMS\Exclude()
     */
    private $user;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    private $gender;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    private $age;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    private $country;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    private $zipcode;

    /**
     * ResponseUser constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->setId($user->getId());
        $this->setUsername($user->getUsername());
        $this->setEmail($user->getEmail());
        $this->setPhone($user->getPhone());
        $this->setToken($user->getToken());
        $this->setGender($user->getGender());
        $this->setAge($user->getAge());
        $this->setCountry($user->getCountry());
        $this->setZipcode($user->getZipcode());
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ResponseUser
     */
    public function setId(int $id) : self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return ResponseUser
     */
    public function setUsername(string $username) : self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone() : int
    {
        return $this->phone;
    }

    /**
     * @param $phone
     * @return ResponseUser
     */
    public function setPhone($phone) : self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail() :string
    {
        return $this->email;
    }

    /**
     * @param $email
     * @return ResponseUser
     */
    public function setEmail($email) : self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken() : string
    {
        return $this->token;
    }

    /**
     * @param $token
     * @return ResponseUser
     */
    public function setToken($token) : self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return ResponseUser
     */
    public function setGender(string $gender) : self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     * @return ResponseUser
     */
    public function setAge(int $age) : self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return ResponseUser
     */
    public function setCountry(string $country) : self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     * @return ResponseUser
     */
    public function setZipcode(string $zipcode) : self
    {
        $this->zipcode = $zipcode;

        return $this;
    }
}
