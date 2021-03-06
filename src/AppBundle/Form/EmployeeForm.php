<?php

namespace AppBundle\Form;



use AppBundle\Entity\Employee;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("photo",FileType::class,
                array(
                    "label"=>false,
                    "attr"=>[

                    ]
                ))
            ->add("firstname",TextType::class,[

                "label" => false,
                "attr" =>[

                    "placeholder" =>"First Name"
                ]
            ])
            ->add("lastname",TextType::class,[
                "label" => false,
                "attr" =>[

                    "placeholder" =>"Last Name"
                ]
            ])
            ->add("email",EmailType::class,[
                "label" => false,
                "attr" =>[

                    "placeholder" =>"example@abc.com"
                ]
            ])
            ->add("phone",NumberType::class,[
                "label" => false,
                "attr" =>[

                    "placeholder" =>"Phone"
                ]
            ])
            ->add("address",TextareaType::class,[
                "label" => false,
                "attr" =>[

                    "placeholder" =>"Address"
                ]
            ])
            ->add("birthdate",DateType::class,[
                "html5"=>false,
                "widget" =>"single_text",
                "label" => false,
                "attr" =>[

                    "class" =>" js-datepicker ",
                    "placeholder" =>"Choice a Date"
                ]
            ])
            ->add("degree",null,[
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere("u.delCase = :deleted")
                        ->setParameter("deleted","0")
                        ->orderBy('u.name', 'ASC');
                },
                "label" => false,
                'placeholder' => 'Choice a Degree',
                "attr" =>[
                    "class"=>"disableme"
                ],



            ])
            ->add("department",null,[
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere("u.delCase = :deleted")
                        ->setParameter("deleted","0")
                        ->orderBy('u.name', 'ASC');
                },
                "label" => false,
                'placeholder' => 'Choice a Department',
                "attr" =>[
                    "class"=>"disableme"
                ],

            ])
            ;

        $employee = $builder->getData();

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class"=>Employee::class,
            "attr" =>[
                "class" =>"well form-horizontal"
            ]
        ]);
    }

    public function getBlockPrefix()
    {
        return 'new_employee_form';
    }

    public static function processImage(UploadedFile $uploadedFile , Employee $photos)
    {
        $path = "../../NetGsm/web/uploads/profile_photos";
        $uploade_file_info = pathinfo($uploadedFile->getClientOriginalName());
        $file_name = $uploadedFile->getClientOriginalName();

        $uploadedFile->move($path,$file_name);

        return $file_name ;

    }

}
