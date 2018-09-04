<?php

namespace ApiBundle\Controller;

use CoreBundle\Form\User\UserListType;
use CoreBundle\Form\User\UserLoginType;
use CoreBundle\Form\User\UserRegisterType;
use CoreBundle\Form\User\UserRestorePasswordType;
use CoreBundle\Form\User\UserUpdatePatchType;
use RestBundle\Controller\BaseController;
use RestBundle\Handler\ProcessorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * Class UserController.
 *
 * @RouteResource("User")
 */
class UserController extends BaseController
{
    /**
     * @ApiDoc(
     *  resource=true,
     *  section="User",
     *  description="Login user",
     *  input={
     *       "class" = "CoreBundle\Form\User\UserLoginType",
     *       "name" = ""
     *  },
     *  statusCodes={
     *      200 = "Ok",
     *      400 = "Bad format",
     *      403 = "Access denied"
     *  }
     *)
     * @Annotations\Post("/login")
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function postLoginAction(Request $request) : Response
    {
        return $this->process($request, UserLoginType::class);
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  section="User",
     *  description="Register user",
     *  input={
     *       "class" = "CoreBundle\Form\User\UserRegisterType",
     *       "name" = ""
     *  },
     *  statusCodes={
     *      200 = "Ok",
     *      400 = "Bad format"
     *  }
     *)
     * @Annotations\Post("/register")
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function postRegisterAction(Request $request) : Response
    {
        return $this->process($request, UserRegisterType::class, Response::HTTP_CREATED);
    }


    /**
     * @ApiDoc(
     *  resource=true,
     *  section="User",
     *  description="Update profile",
     *  input={
     *       "class" = "CoreBundle\Form\User\UserUpdatePatchType",
     *       "name" = ""
     *  },
     *  statusCodes={
     *      200 = "Ok",
     *      400 = "Bad format"
     *  }
     *)
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function patchAction(Request $request) : Response
    {
        return $this->process($request, UserUpdatePatchType::class, Response::HTTP_CREATED);
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  section="User",
     *  description="Get a list of Users",
     *  input={
     *       "class" = "CoreBundle\Form\User\UserListType",
     *       "name" = ""
     *  },
     *  statusCodes={
     *      200 = "Ok",
     *      204 = "Entity not found",
     *      400 = "Bad format",
     *      403 = "Forbidden"
     *  }
     * )
     *
     * @param Request $request
     *
     * @return Response
     */
    public function cgetAction(Request $request) : Response
    {
        return $this->process($request, UserListType::class);
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  section="User",
     *  description="Restore password",
     *  input={
     *       "class" = "CoreBundle\Form\User\UserRestorePasswordType",
     *       "name" = ""
     *  },
     *  statusCodes={
     *      200 = "Ok",
     *      400 = "Bad format"
     *  }
     *)
     * @Annotations\Post("/restore-password")
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function postRestorePasswordAction(Request $request) : Response
    {
        return $this->process($request, UserRestorePasswordType::class, Response::HTTP_CREATED);
    }

    /**
     * @return ProcessorInterface
     */
    protected function getProcessor() : ProcessorInterface
    {
        return $this->get('core.handler.user');
    }
}
