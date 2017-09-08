<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 12.8.2017
 * Time: 11:26
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Employee;
use AppBundle\Entity\Photos;
use AppBundle\Entity\ProfilePhoto;
use AppBundle\Form\EmployeeForm;
use AppBundle\Form\PhotoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EmployeeController
 * @package AppBundle\Controller\Admin
 * @Route("/admin")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class EmployeeController extends Controller
{


    /**
     * @Route("/Employees/page/{numb}",defaults={"numb"=1},name="all_employees")
     */
    public function listAction(Request $request,$numb)
    {
        $em = $this->getDoctrine()->getManager();
        $allEmployees=$em->getRepository("AppBundle:Employee")
            ->findAllNotDeleted();

        $paginator  =   $this->pagination($allEmployees,$numb,10);

        $employees  =$em->getRepository("AppBundle:Employee")
            ->findAllNotDeleted($paginator[1],$paginator[2]);
        return $this->render("admin/employees/listAll.html.twig",[
            "employees" =>$employees,
            "pages"=>$paginator[0]
        ]);
    }

    /**
     * @Route("/Employees/new",name="employee_new")
     */
    public function newAction(Request $request)
    {
        $newEmployee = new Employee();
        $newProfilePhoto = new ProfilePhoto();
        $form = $this->createForm(EmployeeForm::class,$newEmployee);
        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid())
       {

           $newProfilePhoto->setPhoto($newEmployee->getPhoto());
           $newProfilePhoto->upload();
           $newProfilePhoto->setEmployee($newEmployee);
           $em = $this->getDoctrine()->getManager();
           $em ->persist($newEmployee);
           $em ->persist($newProfilePhoto);
           $em->flush();

           $this->addFlash("success","Employee Added Successfully ");
           return $this->redirectToRoute("all_employees");
       }
       return $this->render("admin/employees/new/new.html.twig",[
          "employeeForm" => $form->createView(),


       ]);
    }

    /**
     * @Route("/Employees/{id}/edit",name="employee_edit")
     */
    public function editAction(Request $request,Employee $employee)
    {
        $em = $this->getDoctrine()->getManager();
        $emp = $em
            ->getRepository(Employee::class)
            ->find($employee->getId());

        $newProfilePhoto = $em
            ->getRepository(ProfilePhoto::class)
            ->findOneBy(["employee"=>$employee->getId()]);

        if ($emp->getDelCase() != 1)
        {
            $editEmployee = new Employee();
            $editEmployee = $employee;
            $form = $this->createForm(EmployeeForm::class, $editEmployee);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $tempPhoto = $newProfilePhoto->getName();

                $newProfilePhoto->setPhoto($editEmployee->getPhoto());
                $newProfilePhoto->upload();
                $em = $this->getDoctrine()->getManager();
                $em->persist($editEmployee);
                $em ->persist($newProfilePhoto);
                $em->flush();

                unlink($newProfilePhoto->getUploadRoot() . "/" . $tempPhoto);

                $this->addFlash("success", "Employee Edited Successfully ");
                return $this->redirectToRoute("all_employees");
            }
                return $this->render("admin/employees/edit/new.html.twig",[
                    "employeeForm" => $form->createView(),
                    "employee"=>$employee
                ]);
        }
        else
        {
            $this->addFlash("error", "Employee Not Exsist ");
            return $this->redirectToRoute("all_employees");
        }

    }

    /**
     * @Route("/Employees/{id}/delete",name="employee_delete")
     */
    public function deleteAction( $id)
    {

        $something = $this->getDoctrine()
            ->getRepository('AppBundle:Employee')
            ->find($id);
        $something->setDelCase("1");

        $em = $this->getDoctrine()->getManager();
        $em->persist($something);
        $em->flush();

        $this->addFlash("success","Deleted Successfully ");

        return $this->redirect($this->generateUrl('all_employees'));
    }
    /**
     * @Route("/Employees/{id}/details",name="employee_details")
     */
    public function detailsAction(Request $request,Employee $employee)
    {
        $em = $this->getDoctrine()->getManager();
        $emp = $em
            ->getRepository(Employee::class)
            ->find($employee->getId());

        if ($emp->getDelCase() != 1)
        {
        $form = $this->createForm(EmployeeForm::class,$employee);

        return $this->render("admin/employees/details/details.html.twig",[
            "employeeForm" => $form->createView(),
            "employee"=>$employee
        ]);
        }
        else
        {
            $this->addFlash("error", "Employee Not Exsist ");
            return $this->redirectToRoute("all_employees");
        }
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