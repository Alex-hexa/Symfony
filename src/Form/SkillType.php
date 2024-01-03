<?php

namespace App\Form;

use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkillType extends AbstractType /* Formulaire de la page de création de talent */
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                "attr" => [
                    "placeholder" => "Titre du talent",
                ]
            ])
            ->add('rate', IntegerType::class, [
                'label' => 'Taux',
                'attr' => [
                    'min' => 0,
                    'max' => 100,
                    "placeholder" => "Taux de la barre de talent",
                ],
            ])
            ->add('color', ColorType::class, [
                "label" => "Couleur",
                "required" => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Skill::class
        ]);
    }
}
