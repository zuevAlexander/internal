<?php

namespace CoreBundle\Form\CheckPhone;

use CoreBundle\Model\Request\CheckPhone\SendCodeRequest;
use RestBundle\Form\AbstractFormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class SendCodeType extends AbstractFormType
{
    const DATA_CLASS = SendCodeRequest::class;

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country_code', IntegerType::class, [
                'required' => true,
            ])
            ->add('phone_number', IntegerType::class, [
                'required' => true,
            ]);
    }
}
