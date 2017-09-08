<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 24.8.2017
 * Time: 15:11
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * @ORM\Entity
 * @ORM\Table(name="photos")
 */
class Photos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private  $id;
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Status",inversedBy="photo")
     * @ORM\JoinColumn(nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    public function getId()
    {
        return $this->id;
    }


    public function getStatus()
    {
        return $this->status;
    }


    public function setStatus(Status $status)
    {
        $this->status = $status;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->name;
    }


}