<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 11.8.2017
 * Time: 13:28
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DepartmentRepository")
 * @ORM\Table(name="department")
 */
class Department
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
    private $name;
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $address;
    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank()
     */
    private $delCase=0;
    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    private $startDate;


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getDelCase()
    {
        return $this->delCase;
    }

    public function setDelCase($delCase)
    {
        $this->delCase = $delCase;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function __toString()
    {
      return $this->getName();
    }


}