<?php

namespace AppBundle\Form;

use AppBundle\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("username",TextType::class,[
                "label"=>false,
                    "attr" =>[
                    "placeholder"=>"Username",
                ]
            ])
            ->add("plainPassword",RepeatedType::class,[
                "type"=>PasswordType::class,
                'invalid_message' => "The password fields must match."
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class"=>Users::class,
            "validation_groups"=>["Default","Registration"],
            "attr"=>[
                "class"=>"form-horizontal"
            ]
        ]);
    }

    public function getBlockPrefix()
    {
        return 'RegisterForm';
    }
}
