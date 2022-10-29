<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'=> 'Firstname',
                'attr' =>[
                    'placeholder'=> "John",
                    'class' => "form-control mb-3"
                ]
            ])
            ->add('lastname', TextType::class, [
                'label'=> 'Lastname',
                'attr' =>[
                    'placeholder' => 'Bob',
                    'class' => "form-control mb-3"
                ]
            ])
            ->add('email', EmailType::class,[
                'label'=> "Email",
                'attr' => [
                    'placeholder' => 'johnbob@example.com',
                    'class' => "form-control mb-3"
                ]
            ])
            //->add('roles')
            ->add('password', PasswordType::class, [
                'label'=>'Password',
                'attr'=> [
                    'placeholder' => "",
                    'class' => "form-control mb-3"
                ]
            ])
            ->add('password_confirm', PasswordType::class,[
                'label' => 'Confirm Password',
                'mapped'=> false,
                'attr' => [
                    'placeholder' => "",
                    'class' => "form-control mb-3"
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label'=> "Register",
                'attr' => [
                    'class' => "btn btn-outline-dark me-2"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
