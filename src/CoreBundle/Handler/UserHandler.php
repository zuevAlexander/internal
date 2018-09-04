<?php

namespace CoreBundle\Handler;

use CoreBundle\Entity\ResponseUser;
use CoreBundle\Model\Request\User\UserListRequest;
use CoreBundle\Model\Request\User\UserLoginRequest;
use CoreBundle\Model\Request\User\UserRegisterRequest;
use CoreBundle\Model\Request\User\UserRestorePasswordRequest;
use CoreBundle\Model\Request\User\UserUpdatePatchRequest;
use CoreBundle\Service\User\UserService;
use RestBundle\Handler\ProcessorInterface;

/**
 * Class UserHandler
 */
class UserHandler implements ProcessorInterface
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
     * @return ResponseUser
     */
    public function processPostLogin(UserLoginRequest $request): ResponseUser
    {
        return $this->userService->loginUser($request);
    }

    /**
     * @param UserRegisterRequest $request
     * @return ResponseUser
     */
    public function processPostRegister(UserRegisterRequest $request): ResponseUser
    {
        return $this->userService->createUser($request);
    }

    /**
     * @param UserListRequest $request
     * @return array
     */
    public function processGetC(UserListRequest $request)
    {
        return $this->userService->getUsers($request);
    }

    /**
     * @param UserRestorePasswordRequest $request
     * @return ResponseUser
     */
    public function processPostRestorePassword(UserRestorePasswordRequest $request): ResponseUser
    {
        return $this->userService->restorePassword($request);
    }

    /**
     * @param UserUpdatePatchRequest $request
     * @return ResponseUser
     */
    public function processPatch(UserUpdatePatchRequest $request): ResponseUser
    {
        return $this->userService->updateUser($request);
    }
}
