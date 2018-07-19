<?php

namespace CoreBundle\Model\Request\User;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UserLoginRequest.
 */
class UserLoginRequest
{
    /**
     * @var string
     *
     */
    private $email = '';

    /**
     * @var string
     *
     */
    private $password = '';

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return (string)$this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
