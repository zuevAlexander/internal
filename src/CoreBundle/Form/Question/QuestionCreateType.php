<?php

namespace CoreBundle\Form\Question;

use CoreBundle\Model\Request\Question\QuestionCreateRequest;
use RestBundle\Form\AbstractFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class QuestionCreateType
 * @package CoreBundle\Form\Question
 */
class QuestionCreateType extends AbstractFormType
{
    const DATA_CLASS = QuestionCreateRequest::class;

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', TextType::class, [
                'required' => true,
            ]);
    }
}
