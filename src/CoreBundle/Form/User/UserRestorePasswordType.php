<?php

namespace CoreBundle\Form\User;

use CoreBundle\Model\Request\User\UserRestorePasswordRequest;
use RestBundle\Form\AbstractFormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UserRestorePasswordType
 * @package CoreBundle\Form\User
 */
class UserRestorePasswordType extends AbstractFormType
{
    const DATA_CLASS = UserRestorePasswordRequest::class;

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', TextType::class, [
            'required' => true,
        ]);
    }
}
