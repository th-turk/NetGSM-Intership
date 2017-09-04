<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 3.9.2017
 * Time: 09:16
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Employee;
use AppBundle\Form\EmployeeForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Users;
/**
 * Class UsersController
 * @package AppBundle\Controller\Admin
 * @Route("/admin")
 *
 */
class UsersController extends Controller
{
    /**
     * @Route("/users/page{numb}",defaults={"numb"=1},name="all_users")
     */
    public function showAllAction(Request $request,$numb)
    {
        $em = $this->getDoctrine()->getManager();
        $allUsers = $em->getRepository("AppBundle:Users")
            ->findAll();

        $paginator  =   $this->pagination($allUsers,$numb,10);

        $users  =$em->getRepository("AppBundle:Users")
            ->findAll($paginator[1],$paginator[2]);

        return $this->render("admin/users/index.html.twig",[
            "users" => $users,
            "pages"=>$paginator[0]
        ]);
    }


    /**
     * @Route("/A-users/page{numb}",defaults={"numb"=1},name="admin_users")
     */
    public function showAdminAction(Request $request,$numb)
    {
        $em = $this->getDoctrine()->getManager();
        $allUsers = $em->getRepository("AppBundle:Users")
            ->findAllAdmins();

        $paginator  =   $this->pagination($allUsers,$numb,10);

        $users  =$em->getRepository("AppBundle:Users")
            ->findAllAdmins($paginator[1],$paginator[2]);

        return $this->render("admin/users/index.html.twig",[
            "users" => $users,
            "pages"=>$paginator[0]
        ]);
    }
    /**
     * @Route("/E-users/page{numb}",defaults={"numb"=1},name="employee_users")
     */
    public function showEmployeeAction(Request $request,$numb)
    {
        $em = $this->getDoctrine()->getManager();
        $allUsers = $em->getRepository("AppBundle:Users")
            ->findAllNotAdmins();
        $paginator  =   $this->pagination($allUsers,$numb,10);

        $users  =$em->getRepository("AppBundle:Users")
            ->findAllNotAdmins($paginator[1],$paginator[2]);

        return $this->render("admin/users/index.html.twig",[
            "users" => $users,
            "pages"=>$paginator[0]
        ]);
    }
    /**
     * @Route("/Emp-users/page{numb}",defaults={"numb"=1},name="employee_has_users")
     */
    public function showEmpUsersAction(Request $request,$numb)
    {
        $em = $this->getDoctrine()->getManager();
        $allUsers = $em->getRepository("AppBundle:Users")
            ->findAllEmployeeUser();
        $paginator  =   $this->pagination($allUsers,$numb,10);

        $users  =$em->getRepository("AppBundle:Users")
            ->findAllEmployeeUser($paginator[1],$paginator[2]);

        return $this->render("admin/users/index.html.twig",[
            "users" => $users,
            "pages"=>$paginator[0]
        ]);
    }
    /**
     * @Route("/Nemp-users/page{numb}",defaults={"numb"=1},name="employee_has_no_users")
     */
    public function showNotEmpUsersAction(Request $request,$numb)
    {
        $em = $this->getDoctrine()->getManager();
        $allUsers = $em->getRepository("AppBundle:Users")
            ->findAllNotEmployeeUser();
        $paginator  =   $this->pagination($allUsers,$numb,10);

        $users  =$em->getRepository("AppBundle:Users")
            ->findAllNotEmployeeUser($paginator[1],$paginator[2]);

        return $this->render("admin/users/index.html.twig",[
            "users" => $users,
            "pages"=>$paginator[0]
        ]);
    }
    /**
     * @Route("/role/{id}",name="employee_role_edit")
     */
    public function editRoleAction(Request $request ,$id)
    {
        $user = $this->getDoctrine()
            ->getRepository("AppBundle:Users")
            ->find($id);
        $userRoles =$user->getRoles();
        if(in_array("ROLE_ADMIN",$userRoles)){
            $user->setRoles(["ROLE_USER"]);
        }
        else{
            $user->setRoles(["ROLE_ADMIN"]);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $this->addFlash("success","User Role Changed");

        return $this->redirectToRoute("all_users");
    }


    /**
     * @Route("/users/employee/{id}",name="user_employee")
     */
    public function userEmployeeAction(Request $request , $id)
    {

        $user = $this->getDoctrine()
            ->getRepository('AppBundle:Users')
            ->find($id);


        $form = $this->createForm(EmployeeForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $employee = new Employee();
            $employee=$form->getData();
            $user->setEmployee($employee);
            $em = $this->getDoctrine()->getManager();
            $em ->persist($employee);
            $em ->persist($user);
            $em->flush();

            $this->addFlash("success","Employee Added to User Successfully ");
            return $this->redirectToRoute("all_users");

        }
        return $this->render("admin/employees/new/new.html.twig",[
            "employeeForm" => $form->createView(),

        ]);
    }

    public function pagination($allContent,$numb,$perPage)
    {
        $count=count($allContent);

        $pageCount  = ceil($count/$perPage);

        if ($numb =="" || $numb==1){
            $page_1 =  0;
        }
        else{
            $page_1 = ($numb*$perPage)-$perPage;
        }

        return [$pageCount,$page_1,$perPage];
    }

}