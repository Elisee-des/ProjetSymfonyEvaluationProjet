<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class CreationUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPrenom', TextType::class)
            ->add('email', EmailType::class)
            ->add('roles', ChoiceType::class, [
                "label" => "Definir le role de cet utilisateur",
                "choices" => [
                    'Role Administrateur' => 'ROLE_ADMIN',
                    'Role Utilisateur' => 'ROLE_USER',
                ],
                "multiple" => true
            ])
            ->add('password', RepeatedType::class, [
                "type" => PasswordType::class,
                'constraints'=> [
                    new NotBlank(),
                    new NotNull(),
                    new Length([
                        'min'=>4,
                        "minMessage"=>"Le mot de passe doit etre superieur a {{limit}}",
                        "max"=>30
                    ])
                ],
                'first_options' => [
                    'label' => "Mot de passe"
                ],
                'second_options' => [
                    'label' => "Repeter mot de passe"
                ],
                'invalid_message'=>'Veuillezz saisir un mot de passe valide'
            ])
            ->add('isVerified', ChoiceType::class, [
                "label"=>"Etat du compte",
                "choices"=>[
                    "Activer le compte"=>"1",
                    "Desactiver le compte"=>"0"
                ],
                "expanded"=>false
            ])
            ->add('Creer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
