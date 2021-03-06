<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 25.8.2017
 * Time: 18:40
 */

namespace AppBundle\Controller\Admin;



use AppBundle\Entity\Department;
use AppBundle\Form\DepartmentForm;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DepartmentController
 * @package AppBundle\Controller\Admin
 * @Route("admin")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class DepartmentController extends  Controller
{
    /**
     * @Route("/departments",name="all_departments")
     */
    public function showAction(Request $request)
    {
        $form = $this->createForm(DepartmentForm::class);

        $em=$this->getDoctrine()->getManager();
        $departments=$em->getRepository("AppBundle:Department")
            ->findAllNotDeleted();

        $form->handleRequest($request);
        if ($form->isSubmitted() &&$form->isValid()) {

            $department=$form->getData();
            $em = $this->getDoctrine()->getManager();
            $em ->persist($department);
            $em->flush();
            $this->addFlash("success"," New DepartmentForm Added ");
            return $this->redirect($this->generateUrl("all_departments"));
        }
        return $this->render("admin/department/index.html.twig",[
            "formDepartment"=>$form->createView(),
            "departments"=>$departments
        ]);
    }

    /**
     * @Route("/departments/{id}/edit",name="edit_department")
     */
    public function editAction(Request $request, Department $department)
    {
        $form = $this->createForm(DepartmentForm::class,$department);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $department=$form->getData();
            $em = $this->getDoctrine()->getManager();
            $em ->persist($department);
            $em->flush();

            $this->addFlash("success","Department Edited Successfully ");
            return $this->redirect($this->generateUrl("all_departments"));
        }
        return $this->render("admin/department/edit.html.twig",[
            "formDepartment" => $form->createView()
        ]);

    }

    /**
     * @Route("/departments/{id}/delete",name="delete_departments")
     */
    public function deleteAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $department=$em->getRepository("AppBundle:Department")->find($id);

        if ($this->checkForDelete($id))
        {
            $this->addFlash('error', 'Department  Has Employess ');
            // flash
            // logger
            // redirection
            return $this->redirect($this->generateUrl("all_departments"));
        }
        else {
            $department->setDelCase("1");
            $em = $this->getDoctrine()->getManager();
            $em->persist($department);
            $em->flush();

            $this->addFlash("success", "Deleted Successfully ");

            return $this->redirect($this->generateUrl("all_departments"));
        }
    }

    public function checkForDelete($id)
    {
        $em=$this->getDoctrine()->getManager();
        $employees= $em
            ->getRepository("AppBundle:Employee")
            ->findAllNotDeleted();
        $flag= false;
        foreach ($employees as $e)
        {
            if ($id == $e->getDepartment()->getId())
            {
                $flag=true;
                break;
            }
        }
        return $flag;
    }
}