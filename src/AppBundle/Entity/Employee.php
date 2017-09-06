<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 11.8.2017
 * Time: 13:22
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmplooyeeRepository")
 * @ORM\Table(name="employee")
 */
class Employee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $firstname;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $lastname;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $email;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $phone;
    /**
     * @ORM\Column(type="text")
     */
    private $address;
    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;
    /**
     * @ORM\Column(type="boolean")
     */
    private $delCase=false;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Degree")
     * @ORM\JoinColumn(name="degree_id",referencedColumnName="id",nullable=true)
     */
    private $degree;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Department")
     * @ORM\JoinColumn(name="department_id",referencedColumnName="id",nullable=true)
     */
    private $department;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Photos" ,mappedBy="employee")
     */
    private $photos;

    /**
     * @ORM\Column(type="string")
     */
    private $photoName;

    private $photo;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getDelCase()
    {
        return $this->delCase;
    }

    public function setDelCase($delCase)
    {
        $this->delCase = $delCase;
    }

    /**
     * @return Degree
     */
    public function getDegree()
    {
        return $this->degree;
    }


    public function setDegree(Degree $degree)
    {
        $this->degree = $degree;
    }


    /**
     * @return Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    public function setDepartment(Department $department)
    {
        $this->department = $department;
    }

    /**
     * @return ArrayCollection |Photos[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }


    public function getPhotoName()
    {
        return $this->photoName;
    }

    public function setPhotoName($photoName)
    {
        $this->photoName = $photoName;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto(UploadedFile $photo)
    {
        $this->photo = $photo;
    }

    public function getUploadDir()
    {
        return "uploads/profile_photos";
    }

    public function getAbsoluteRoot()
    {
        return $this->getUploadRoot().$this->photoName;
    }

    public function getWebPath()
    {
        return $this->getUploadDir()."/".$this->photoName;
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
        $this->photoName = md5(uniqid())."-".$this->photo->getClientOriginalName();


        if (!is_dir($this->getUploadRoot()))
        {
            mkdir($this->getUploadRoot(),"0777",true);
        }

        $this->photo->move($this->getUploadRoot(),$this->photoName);
        unset($this->photo);

    }


    public function __toString()
    {
        return $this->getFirstname()." ".$this->getLastname();
    }






}