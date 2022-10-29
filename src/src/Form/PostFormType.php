<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('title', TextType::class, [
                'required' => false,
            ])
            ->add('tag_id', ChoiceType::class, [
                'choices' => [
                    'vetements' => "vetements",
                    'immobilier' => 'immobilier',
                    'electromenager' => 'electromenager',
                    'vehicule' => 'vehicule',
                    'service' => 'service',
                ],
                'required' => false,
                'expanded' => true,
            ])
            ->add('minimumPrice', NumberType::class, [
                'required' => false,
            ])
            ->add('maximumPrice', NumberType::class, [
                'required' => false,
            ])
            ->add('filter', ChoiceType::class, [
                'choices' => [
                    'id' => "id",
                    'publication date' => 'publishedOn',
                ]
            ]);
    }
}
