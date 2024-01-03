<?php
// src/Form/ProductType.php
namespace App\Form;

use App\Entity\Candidater;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CandidaterType extends AbstractType /* Formulaire de la page Candidater */
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ...
            ->add('objet', TextType::class, [
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
            ->add('brochure', FileType::class, [
                'label' => 'Brochure (PDF file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10M',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidater::class,
        ]);
    }
}
