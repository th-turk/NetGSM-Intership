<?php

namespace AppBundle\Form;

use AppBundle\Entity\Photos;
use AppBundle\Entity\ProfilePhoto;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("photo",FileType::class,
                array(
                    "label"=>false,
                    "attr"=>[

                    ]
                ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                "data_class"=>Photos::class,
            ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_photo_type';
    }

    public static function processImage(UploadedFile $uploadedFile , Photos $photos)
    {
        $path = "../../NetGsm/web/uploads/profile_photos";
        $uploade_file_info = pathinfo($uploadedFile->getClientOriginalName());
        $file_name = $uploadedFile->getClientOriginalName();

        $uploadedFile->move($path,$file_name);

        return $file_name ;

    }
}
