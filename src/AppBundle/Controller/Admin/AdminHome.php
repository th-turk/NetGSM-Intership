<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 2.9.2017
 * Time: 20:23
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Degree;
use AppBundle\Entity\Department;
use AppBundle\Entity\Employee;
use AppBundle\Entity\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminHome
 * @package AppBundle\Controller\Admin
 * @Route("/admin")
 * @Security("is_granted('ROLE_USER')")
 */
class AdminHome extends  Controller
{
    /**
     * @Route("/",name="admin_page")
     */
    public function adminAction()
    {

        return $this->render("admin/homepage.html.twig",[
            "widgets"=>$this->widgetContenAction()
        ]);
    }

    /**
     * @return array
     */
    public function widgetContenAction()
    {
        $em= $this->getDoctrine()->getManager();
        $allEmployees =
            $em
                ->getRepository(Employee::class)
                ->findAll();

        $activeEmployees=
            $em
                ->getRepository(Employee::class)
                ->findAllNotDeleted();
        $allDepartments =
            $em
                ->getRepository(Department::class)
                ->findAll();
        $activeDepartments=
            $em
                ->getRepository(Department::class)
                ->findAllNotDeleted();
        $allDegrees =
            $em
                ->getRepository(Degree::class)
                ->findAll();
        $activeDegree=
            $em
                ->getRepository(Degree::class)
                ->findAllNotDeleted();
        $allUsers =
            $em
                ->getRepository(Users::class)
                ->findAll();
        $adminUsers=
            $em
                ->getRepository(Users::class)
                ->findAllAdmins();
        $userUsers=
            $em
                ->getRepository(Users::class)
                ->findAllNotAdmins();
        $employeedUsers=
            $em
                ->getRepository(Users::class)
                ->findAllEmployeeUser();
        $notEmployeedUsers=
            $em
                ->getRepository(Users::class)
                ->findAllNotEmployeeUser();

        return array(
            "allEmployees"=>count($allEmployees),
            "activeEmployees"=>count($activeEmployees),
            "allDepartments"=>count($allDepartments),
            "activeDepartments"=>count($activeDepartments),
            "allDegrees"=>count($allDegrees),
            "activeDegree"=>count($activeDegree),
            "allUsers"=>count($allUsers),
            "adminUsers"=>count($adminUsers),
            "userUsers"=>count($userUsers),
            "employeedUsers"=>count($employeedUsers),
            "notEmployeedUsers"=>count($notEmployeedUsers)
            );
    }
}