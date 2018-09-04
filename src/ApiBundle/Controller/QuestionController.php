<?php

namespace ApiBundle\Controller;

use CoreBundle\Form\Question\QuestionCreateType;
use CoreBundle\Form\Question\QuestionListType;
use RestBundle\Controller\BaseController;
use RestBundle\Handler\ProcessorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * Class QuestionController.
 *
 * @RouteResource("Question")
 */
class QuestionController extends BaseController
{
    /**
     * @ApiDoc(
     *  resource=true,
     *  section="Question",
     *  description="Create a new question",
     *  input={
     *       "class" = "CoreBundle\Form\Question\QuestionCreateType",
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
    public function postAction(Request $request) : Response
    {
        return $this->process($request, QuestionCreateType::class);
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  section="Question",
     *  description="Get list of questions",
     *  input={
     *       "class" = "CoreBundle\Form\Question\QuestionListType",
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
    public function cgetAction(Request $request) : Response
    {
        return $this->process($request, QuestionListType::class);
    }

    /**
     * @return ProcessorInterface
     */
    protected function getProcessor() : ProcessorInterface
    {
        return $this->get('core.handler.question');
    }
}
