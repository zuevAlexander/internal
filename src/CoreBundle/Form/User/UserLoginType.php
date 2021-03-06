<?php

namespace CoreBundle\Form\User;

use CoreBundle\Model\Request\User\UserLoginRequest;
use RestBundle\Form\AbstractFormType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UserLoginType
 * @package CoreBundle\Form\User
 */
class UserLoginType extends AbstractFormType
{
    const DATA_CLASS = UserLoginRequest::class;

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
            'required' => true,
            ])
            ->add('password', TextType::class, [
            'required' => true,
            ]);
    }
}
