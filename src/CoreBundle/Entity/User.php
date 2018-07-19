<?php

namespace CoreBundle\Entity;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;
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
     *
     * @JMS\Expose
     * @JMS\SerializedName("id")
     * @JMS\Type("integer")
     */
    private $id;

    /**
     * @var string
     *
     * @JMS\Groups({"post_user_register"})
     *
     * @OGM\Property(type="string")
     */
    private $username;

    /**
     * @var string
     *
     * @JMS\Exclude()
     *
     * @OGM\Property(type="string")
     */
    private $password;

    /**
     * @var string
     *
     * @JMS\Groups({"post_user_register"})
     *
     * @OGM\Property(type="string")
     */
    private $email;

    /**
     * @var string
     *
     * @JMS\Groups({"post_user_register"})
     *
     * @OGM\Property(type="int")
     */
    private $phone;

    /**
     * @var string
     *
     * @JMS\Groups({"post_user_register"})
     *
     * @OGM\Property(type="string")
     */
    private $token;

    /**
     * @var string
     *
     * @JMS\Exclude()
     *
     * @OGM\Property(type="string")
     */
    private $salt;

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
