<?php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('nombreEvaluateur')
            ->add('input', NumberType::class, [
                "label"=>"Nombre de champ a remplir",
                "required"=>true,
                "mapped"=>false
            ])
            ->add('radio', NumberType::class, [
                "label"=>"Nombre de bouton radio",
                "required"=>true,
                "mapped"=>false
            ])
            ->add('chexkbox', NumberType::class, [
                "label"=>"Nombre de bouton checkbox ",
                "required"=>true,
                "mapped"=>false
            ])
            ->add('Creer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
