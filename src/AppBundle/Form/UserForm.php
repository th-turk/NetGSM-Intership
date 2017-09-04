<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("email",EmailType::class)
            ->add("roles",ChoiceType::class,[
                "choices"=>[
                    "Admin" =>"ROLE_ADMIN",
                    "Employee"=>"ROLE_EMPLOYEE"
                ],
                "multiple" =>true,
                "expanded"=>true
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'app_bundle_user_form';
    }
}
