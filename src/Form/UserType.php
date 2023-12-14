<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add("username", TextType::class, [
            "label" => "Nom",
            "attr" => [
                "placeholder" => "Nom de l'utilisateur"
            ]
        ]);
        $builder->add("password", RepeatedType::class, [
                "label" => "Mot de passe",
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être identiques.',
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe', 'attr' => ["placeholder" => "Votre mot de passe"]],
                'second_options' => ['label' => 'Confirmer le mot de passe', 'attr' => ["placeholder" => "Confirmez votre mot de passe"]]
        ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}