<?php

namespace CoreBundle\Form\User;

use CoreBundle\Model\Request\User\UserUpdatePatchRequest;
use RestBundle\Form\AbstractFormType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class UserUpdatePatchType
 * @package CoreBundle\Form\User
 */
class UserUpdatePatchType extends AbstractFormType
{
    const DATA_CLASS = UserUpdatePatchRequest::class;

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'required' => false,
            ])
            ->add('phone', IntegerType::class, array(
                'required' => false,
            ))
            ->add('gender', TextType::class, array(
                'required' => false,
            ))
            ->add('age', IntegerType::class, array(
                'required' => false,
            ))
            ->add('country', TextType::class, array(
                'required' => false,
            ))
            ->add('zipcode', TextType::class, array(
                'required' => false,
            ))->add('profile', TextType::class, array(
                'required' => false,
            ));
    }
}
