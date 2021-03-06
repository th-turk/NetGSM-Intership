<?php

namespace AppBundle\Form;

use AppBundle\Entity\Photos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("logintype",ChoiceType::class,[
			"label"=>"Login Type",
                "placeholder"=>"Choice A Type",
                "choices"=>[
                    "Start Work"=>1,
                    "Finish Work"=>0
                ],


            ])
            ->add("employee",NumberType::class,[
                "label"=>false,
                "attr"=>[
                    "placeholder"=>"Employee Id"
                ]
            ])
            ->add("textArea",TextareaType::class,[
                "label"=>false,
                "attr"=>[
                    "id"=>"textArea",
                    "style"=>"display:none;"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "attr"=>[
                "method"=>"post",
                "accept-charset"=>"utf-8",
                "name"=>"form1"
            ]
        ]);
    }

    public function getBlockPrefix()
    {
        return 'form1';
    }
}
