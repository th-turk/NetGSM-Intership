<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 4.9.2017
 * Time: 12:53
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="profile_photo")
 */
class ProfilePhoto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private  $id;
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Employee")
     * @ORM\JoinColumn(name="employee",referencedColumnName="id")
     */
    private $employee;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     */
    private $photo;


    public function getId()
    {
        return $this->id;
    }


    public function getEmployee()
    {
        return $this->employee;
    }


    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto(UploadedFile $photo)
    {
        $this->photo = $photo;
    }

    public function __toString()
    {
        return $this->photo;
    }

    public function getUploadDir()
    {
        return "uploads/profile_photos";
    }

    public function getAbsoluteRoot()
    {
        return $this->getUploadRoot().$this->name;
    }

    public function getWebPath()
    {
        return $this->getUploadDir()."/".$this->name;
    }

    public function getUploadRoot()
    {
        return __DIR__."/../../../web/".$this->getUploadDir()."/";
    }
    public function upload()
    {
        if ($this->photo===null){
            return;
        }
        $this->name = $this->photo->getClientOriginalName();


        if (!is_dir($this->getUploadRoot()))
        {
            mkdir($this->getUploadRoot(),"0777",true);
        }

        $this->photo->move($this->getUploadRoot(),$this->name);
        unset($this->photo);


    }
}