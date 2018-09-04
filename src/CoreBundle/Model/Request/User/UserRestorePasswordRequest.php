<?php

namespace CoreBundle\Model\Request\User;

/**
 * Class UserRestorePasswordRequest.
 */
class UserRestorePasswordRequest
{
    /**
     * @var string
     *
     */
    private $email;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}
