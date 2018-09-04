<?php

namespace CoreBundle\Service\Question;

use CoreBundle\Entity\Question;
use CoreBundle\Entity\QuestionResponse;
use CoreBundle\Model\Request\Question\QuestionCreateRequest;
use CoreBundle\Model\Request\Question\QuestionListRequest;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class class CheckPhoneService
 */
class QuestionService
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * QuestionService constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param QuestionCreateRequest $request
     * @return QuestionResponse
     */
    public function createQuestion(QuestionCreateRequest $request): QuestionResponse
    {
        $em = $this->container->get('neo4j.entity_manager');
        $question = $em->getRepository(Question::class)->findOneBy(['text' => $request->getText()]);

        if ($question instanceof Question) {
            return new QuestionResponse($question);
        } else {
            $question = new Question();
            $question->setText($request->getText());
            $em->persist($question);
            $em->flush();
        }

        return new QuestionResponse($question);
    }

    /**
     * @param QuestionListRequest $request
     * @return array
     */
    public function getQuestions(QuestionListRequest $request): array
    {
        $em = $this->container->get('neo4j.entity_manager');
        $questions = $em->getRepository(Question::class)->findAll();

        $ResponseQuestions = [];
        foreach ($questions as $question) {
            $ResponseQuestions[] = new QuestionResponse($question);
        }

        return $ResponseQuestions;
    }
}