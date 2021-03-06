<?php

namespace CoreBundle\Exception\User;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserNotFoundException extends \RuntimeException
{
    public function __construct($message = 'User not found', $code = Response::HTTP_FORBIDDEN, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
