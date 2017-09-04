<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepartmentForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name",TextType::class,[
                "label"=>"DepartmentForm Name",
                "attr"=>[

                ]
            ])
            ->add("address",TextareaType::class,[
                "label"=>"DepartmentForm Adress",
                "attr"=>[
                    "class"=>"form-control"
                ]
            ])
            ->add("startDate",DateType::class,[
                "html5"=>false,
                "widget" =>"single_text",
                "attr" =>[
                    "class" =>" js-datepicker",
                    "placeholder" =>"Choice a Date"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           "data_class"=>"AppBundle\Entity\Department"
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_branch';
    }
}
