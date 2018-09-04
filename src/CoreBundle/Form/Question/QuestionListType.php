<?php

namespace CoreBundle\Form\Question;

use CoreBundle\Model\Request\Question\QuestionListRequest;
use RestBundle\Form\AbstractFormGetListType;

/**
 * Class QuestionListType
 */
class QuestionListType extends AbstractFormGetListType
{
    const DATA_CLASS = QuestionListRequest::class;
}
