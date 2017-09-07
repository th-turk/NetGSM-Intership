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
use AppBundle\Form\EmployeeForm;
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
     * @Route("/profile/{id}",name="user_profile")
     */
    public function profileAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $emp = $em
            ->getRepository(Employee::class)
            ->find($id);
        foreach ($emp->getPhotos() as $photo){
            dump($photo);die;
        }
        if ($emp->getDelCase() != 1 || $emp==null)
        {
            $form = $this->createForm(EmployeeForm::class,$emp);

            return $this->render("admin/profile.html.twig",[
                "employeeForm" => $form->createView(),
                "employee"=>$emp
            ]);
        }
        else
        {
            $this->addFlash("error", "Employee Not Exsist ");
            return $this->redirectToRoute("admin_page");
        }
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