<?php

namespace CoreBundle\Handler;

use CoreBundle\Entity\User;
use CoreBundle\Model\Request\User\UserLoginRequest;
use CoreBundle\Model\Request\User\UserRegisterRequest;
use CoreBundle\Model\Request\User\UserReadRequest;
use CoreBundle\Model\Handler\UserProcessorInterface;
use CoreBundle\Service\User\UserService;

/**
 * Class UserHandler
 */
class UserHandler implements UserProcessorInterface
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * TestHandler constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * @param UserLoginRequest $request
     *
     * @return User
     */
    public function processPostLogin(UserLoginRequest $request) : User
    {
        return $this->userService->loginUser($request);
    }

    /**
     * @param UserRegisterRequest $request
     *
     * @return User
     */
    public function processPostRegister(UserRegisterRequest $request) : User
    {
        return $this->userService->createUser($request);
    }

    /**
     * @param UserReadRequest $request
     * @return array
     */
    public function processGet(UserReadRequest $request): array
    {
        return $this->userService->getSomeThing();
    }
}
