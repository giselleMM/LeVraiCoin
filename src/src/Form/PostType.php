<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Post;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostType extends AbstractType
{



    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $vetements = new Tag();
        $vetements->setName('vetements');

        $immobilier = new Tag();
        $immobilier->setName('immobilier');

        $electromenager = new Tag();
        $electromenager->setName('electromenager');

        $vehicule = new Tag();
        $vehicule->setName('vehicule');

        $service = new Tag();
        $service->setName('service');
    
        $builder
            ->add('title', TextType::class, ['required' => true])
            ->add('description', TextareaType::class, ['required' => true])
            ->add('price', NumberType::class, ['required' => true])
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => false,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
