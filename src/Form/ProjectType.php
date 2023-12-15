<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
//use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
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
                'label' => 'image',
                "attr" => [
                    "placeholder" => "Image du projet",
                ]
            ])
            ->add('color', ColorType::class, [
                "label" => "Couleur",
                "required" => false
            ])
            ->add('tags');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class
        ]);
    }
}
