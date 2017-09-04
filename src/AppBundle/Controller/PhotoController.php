<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 24.8.2017
 * Time: 15:41
 */

namespace AppBundle\Controller;



use AppBundle\Entity\Photos;
use AppBundle\Form\PhotoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;


class PhotoController extends Controller
{
    /**
     * @Route("/photo", name="photo_new")
     */
    public function newAction(Request $request)
    {
        $photo = new Photos();
        $form = $this->createForm(PhotoType::class,$photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $photo->upload();
           $em = $this->getDoctrine()->getManager();
           $em ->persist($photo);
           $em->flush();

        }
        $em = $this->getDoctrine()->getManager();
        $photos  =$em->getRepository("AppBundle:Photos")
            ->findAll();


        return $this->render('takephoto.html.twig', array(
            'form' => $form->createView(),
            "photos"=>$photos,
        ));
    }


}