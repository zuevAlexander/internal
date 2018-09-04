<?php

namespace CoreBundle\Model\Request\Question;

use RestBundle\Request\ListRequestInterface;
use RestBundle\Request\ListRequestTrait;
use RestBundle\Request\AbstractRequest;

/**
 * Class QuestionListRequest
 * @package CoreBundle\Model\Request\User
 */
class QuestionListRequest extends AbstractRequest implements ListRequestInterface
{
    use ListRequestTrait;
}
