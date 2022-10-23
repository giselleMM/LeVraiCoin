<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SearchTestType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('title', TextType::class, [
                'required' => false,
            ])
            ->add('tag_id', ChoiceType::class, [
                'choices' => [
                    '' => '',
                    'mode' => "1",
                    'loisirs' => '2',
                    'multimedia' => '3',
                ],
                'required' => false,
                'placeholder' => 'Choose a tag'
            ])
            ->add('minimumPrice', NumberType::class, [
                'required' => false,
            ])
            ->add('maximumPrice', NumberType::class, [
                'required' => false,
            ]);
    }
}