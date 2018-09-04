<?php

namespace CoreBundle\Model\Request\User;

trait UserSingleRequestTrait
{
    /**
     * @var int
     */
    private $user;

    /**
     * @return int
     */
    public function getUser(): int
    {
        return (int)$this->user;
    }

    /**
     * @param int $user
     */
    public function setUser(int $user)
    {
        $this->user = $user;
    }
}
