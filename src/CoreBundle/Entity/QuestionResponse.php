<?php

namespace CoreBundle\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class QuestionResponse.
 */
class QuestionResponse
{
    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    private $id;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    private $text;

    /**
     * @var Question
     *
     * @JMS\Exclude()
     */
    private $question;

    /**
     * QuestionResponse constructor.
     * @param Question $question
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
        $this->setId($question->getId());
        $this->setText($question->getText());
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return QuestionResponse
     */
    public function setId(int $id) : self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return QuestionResponse
     */
    public function setText(string $text) : self
    {
        $this->text = $text;
        return $this;
    }
}
