<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 29.8.2017
 * Time: 03:03
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DegreeRepository")
 * @ORM\Table(name="degree")
 */
class Degree
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id",type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     *
     * @ORM\Column(type="boolean")
     */
    private $delCase=false;


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

    public function getDelCase()
    {
        return $this->delCase;
    }

    public function setDelCase($delCase)
    {
        $this->delCase = $delCase;
    }

    public function __toString()
    {
        return $this->getName();
    }

}