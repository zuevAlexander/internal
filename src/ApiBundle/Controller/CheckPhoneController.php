<?php

namespace ApiBundle\Controller;

use CoreBundle\Form\CheckPhone\SendCodeType;
use CoreBundle\Form\CheckPhone\CheckCodeType;
use RestBundle\Controller\BaseController;
use RestBundle\Handler\ProcessorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * Class CheckPhoneController.
 *
 * @RouteResource("CheckPhone")
 */
class CheckPhoneController extends BaseController
{
    /**
     * @ApiDoc(
     *  resource=true,
     *  section="User",
     *  description="Login user",
     *  input={
     *       "class" = "CoreBundle\Form\CheckPhone\CheckCodeType",
     *       "name" = ""
     *  },
     *  statusCodes={
     *      200 = "Ok",
     *      400 = "Bad format",
     *      403 = "Access denied"
     *  }
     *)
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function getCheckCodeAction(Request $request) : Response
    {
        return $this->process($request, CheckCodeType::class);
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  section="User",
     *  description="Get user",
     *  input={
     *       "class" = "CoreBundle\Form\CheckPhone\SendCodeType",
     *       "name" = ""
     *  },
     *  statusCodes={
     *      200 = "Ok",
     *      400 = "Bad format",
     *      403 = "Access denied"
     *  }
     *)
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function getSendCodeAction(Request $request) : Response
    {
        return $this->process($request, SendCodeType::class);
    }

    /**
     * @return ProcessorInterface
     */
    protected function getProcessor() : ProcessorInterface
    {
        return $this->get('core.handler.check_phone');
    }
}
