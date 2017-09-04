<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 31.8.2017
 * Time: 20:20
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Degree;
use AppBundle\Form\DegreeForm;
use Couchbase\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DegreeController
 * @package AppBundle\Controller\Admin
 * @Route("/admin")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class DegreeController extends Controller
{
    /**
     * @Route("/Degree",name="all_degrees")
     */
    public function showAction(Request $request)
    {
        $form = $this->createForm(DegreeForm::class);

        $degrees = $this->getDoctrine()
        ->getRepository("AppBundle:Degree")
        ->findAllNotDeleted();

        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid()){
            $degree=$form->getData();
            $em = $this->getDoctrine()->getManager();
            $em ->persist($degree);
            $em->flush();

            $this->addFlash("success","Degree Added Successfully ");
            return $this->redirect($this->generateUrl("all_degrees"));
        }
        return $this->render("admin/degree/index.html.twig",[
            "degreeForm"=> $form->createView(),
            "degree"=>$degrees
        ]);
    }

    /**
     * @Route("/Degree/{id}/edit",name="edit_degree")
     */
    public function editAction(Request $request,Degree $degree)
    {
        $form = $this->createForm(DegreeForm::class,$degree);
        try{
            $form->handleRequest($request);
            if ($form->isSubmitted() &&$form->isValid()){
                $degree=$form->getData();
                $em = $this->getDoctrine()->getManager();
                $em ->persist($degree);
                $em->flush();

                $this->addFlash("success","Degree Edited Successfully ");
                return $this->redirect($this->generateUrl("all_degrees"));
            }
        }
        catch (Exception $exception){
            return new Response($exception);
        }

        return $this->render("admin/degree/edit.html.twig",[
            "form" => $form->createView()
        ]);

    }
    /**
     * @Route("/Degree/{id}/delete",name="delete_degree")
     */
    public function deleteAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $department=$em->getRepository("AppBundle:Degree")->find($id);

        try{
            $department->setDelCase("1");
            $em = $this->getDoctrine()->getManager();
            $em->persist($department);
            $em->flush();

            $this->addFlash("success","Deleted Successfully ");

        } catch(\Exception $e){
            // other exceptions
            $this->addFlash('error', 'Degree  Has Employess ');
            // flash
            // logger
            // redirection
        }

        return $this->redirect($this->generateUrl("all_degrees"));

    }
}