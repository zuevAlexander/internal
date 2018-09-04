<?php

namespace CoreBundle\Handler;

use CoreBundle\Entity\QuestionResponse;
use CoreBundle\Model\Request\Question\QuestionCreateRequest;
use CoreBundle\Model\Request\Question\QuestionListRequest;
use CoreBundle\Service\Question\QuestionService;
use RestBundle\Handler\ProcessorInterface;

/**
 * Class QuestionHandler
 */
class QuestionHandler implements ProcessorInterface
{
    /**
     * @var QuestionService
     */
    private $questionService;

    /**
     * TestHandler constructor.
     * @param QuestionService $questionService
     */
    public function __construct(QuestionService $questionService) {
        $this->questionService = $questionService;
    }

    /**
     * @param QuestionCreateRequest $request
     * @return QuestionResponse
     */
    public function processPost(QuestionCreateRequest $request): QuestionResponse
    {
        return $this->questionService->createQuestion($request);
    }

    /**
     * @param QuestionListRequest $request
     * @return array
     */
    public function processGetC(QuestionListRequest $request): array
    {
        return $this->questionService->getQuestions($request);
    }
}
