<?php

namespace CoreBundle\Model\Request\User;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UserValidationTrait.
 */
trait UserValidationTrait
{
    /**
     * @var string
     */
    private $username = '';

    /**
     * @var string
     */
    private $password = '1234';

    /**
     * @var string
     */
    private $email = '';
}