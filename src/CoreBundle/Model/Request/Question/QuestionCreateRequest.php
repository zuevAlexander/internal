<?php

namespace CoreBundle\Model\Request\Question;

/**
 * Class QuestionCreateRequest
 * @package CoreBundle\Model\Request\User
 */
class QuestionCreateRequest
{
    /**
     * @var string
     */
    private $text;

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }
}
