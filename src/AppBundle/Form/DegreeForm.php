<?php

namespace AppBundle\Form;

use AppBundle\Entity\Degree;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DegreeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            "name",null,[]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class"=>Degree::class,
            "attr" =>[
                "class" =>"well form-horizontal"
            ]
        ]);
    }

    public function getBlockPrefix()
    {
        return 'degree_form';
    }
}
