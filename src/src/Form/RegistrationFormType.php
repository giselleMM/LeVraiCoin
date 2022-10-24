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
                'label'=> 'Votre prénom',
                'attr' =>[
                    'placeholder'=> "Merci de saisir votre prénnom"
                ]
            ])
            ->add('lastname', TextType::class, [
                'label'=> 'Votre Nom',
                'attr' =>[
                    'placeholder' => 'Saisir votre nom'
                ]
            ])
            ->add('email', EmailType::class,[
                'label'=> "Votre Email",
                'attr' => [
                    'placeholder' => 'Saisir votre adresse email'
                ]
            ])
            //->add('roles')
            ->add('password', PasswordType::class, [
                'label'=>'Votre mot de passe',
                'attr'=> [
                    'placeholder' => "Saisir votre mot de passe"
                ]
            ])
            ->add('password_confirm', PasswordType::class,[
                'label' => 'Confirmer votre mot de passe',
                'mapped'=> false,
                'attr' => [
                    'placeholder' => "Saisir de nouveau votre mot de plasse"
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label'=> "S'inscrire"
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
