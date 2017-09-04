<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 24.8.2017
 * Time: 15:15
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="status")
 */
class Status
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
    private $employee;
    /**
     * @ORM\Column(type="boolean")
     */
    private $type;
    /**
     * @ORM\Column(type="date")
     */
    private $date;
    /**
     * @ORM\Column(type="string")
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


    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }


    public function getType()
    {
        return $this->type;
    }


    public function setType($type)
    {
        $this->type = $type;
    }


    public function getDate()
    {
        return $this->date;
    }


    public function setDate($date)
    {
        $this->date = $date;
    }


    public function getPhoto()
    {
        return $this->photo;
    }


    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
}