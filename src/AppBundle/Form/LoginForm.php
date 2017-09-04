<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("_username",TextType::class,[
                "label" =>" ",
                "attr"  =>[
                    "class" =>"form-control",
                    "placeholder"   =>"Username"
                ]
            ])
            ->add("_password",PasswordType::class,[
                "label" =>" ",
                "attr"  =>[
                    "class" =>"form-control",
                    "placeholder"   =>"Password"
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           "attr"   =>[
               "class" =>"navbar-form navbar-right"
           ]
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_login_form';
    }
}
