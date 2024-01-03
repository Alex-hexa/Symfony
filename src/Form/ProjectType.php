<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType /* Formulaire de la page de création de projet */
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                "attr" => [
                    "placeholder" => "Titre du projet",
                ]
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                "attr" => [
                    "placeholder" => "Description du projet",
                ]
            ])
            ->add('image', TextType::class, [
                'label' => 'Image',
                "attr" => [
                    "placeholder" => "Image du projet",
                ]
            ])
            ->add('colorBackCard', ColorType::class, [
                "label" => "Couleur de fond de la carte du projet",
                "required" => false
            ])

            ->add("tags", EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'title',
                'expanded' => true,
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class
        ]);
    }
}
