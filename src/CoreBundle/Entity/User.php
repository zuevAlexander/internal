<?php

namespace CoreBundle\Entity;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User.
 *
 * @OGM\Node(label="User")
 */
class User implements  UserInterface
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    private $id;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    private $username;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    private $password;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    private $email;

    /**
     * @var int
     *
     * @OGM\Property(type="int")
     */
    private $phone;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    private $token;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    private $salt;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    private $gender;

    /**
     * @var int
     *
     * @OGM\Property(type="int")
     */
    private $age;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    private $country;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    private $zipcode;

    /**
     * @return string
     */
    public function getGender(): string
    {
        return (string)$this->gender;
    }

    /**
     * @param string $gender
     * @return User
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
        return (int)$this->age;
    }

    /**
     * @param int $age
     * @return User
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
        return (string)$this->country;
    }

    /**
     * @param string $country
     * @return User
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
        return (string)$this->zipcode;
    }

    /**
     * @param string $zipcode
     * @return User
     */
    public function setZipcode(string $zipcode) : self
    {
        $this->zipcode = $zipcode;

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
     *
     * @return User
     */
    public function setUsername(string $username) : self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return User
     */
    public function setPassword($password) : self
    {
        $this->password = $password;

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
     * @return User
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
     * @return User
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
     * @return User
     */
    public function setToken($token) : self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles() : array
    {
        return [];
    }

    /**
     * @return string
     */
    public function getSalt() : string
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     * @return User
     */
    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @return null
     */
    public function eraseCredentials()
    {
        return null;
    }
}
