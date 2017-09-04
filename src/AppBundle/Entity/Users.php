<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 11.8.2017
 * Time: 13:38
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="users")
 * @UniqueEntity(fields={"usernamee"},message="It looks like you already have an account")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Write an Username")
     */
    private $usernamee;
    /**
     * @ORM\Column(type="string")
     */
    private $password;
    /**
     * @ORM\Column(type="json_array")
     */
    private $roles=[] ;

    /**
     *@ORM\OneToOne(targetEntity="AppBundle\Entity\Employee")
     * @ORM\JoinColumn(name="employee",referencedColumnName="id")
     */
    private $employee;

    /**
     * @var string
     * @Assert\NotBlank(message="Password",groups={"Registration"})
     */
    private $plainPassword;

    public function getId()
    {
        return $this->id;
    }


    public function getUsername()
    {
        return $this->usernamee;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        if (!in_array("ROLE_USER",$roles))
        {
            $roles[] ="ROLE_USER";
        }
        return $roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {

    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function setUsername($userName)
    {
        $this->usernamee = $userName;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password = null;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    public function getUsernamee()
    {
        return $this->usernamee;
    }

    /**
     * @return Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }




}