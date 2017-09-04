<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 10.8.2017
 * Time: 15:03
 */

namespace AppBundle\Controller;


use AppBundle\Form\LoginForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    /**
     * @Route("/",name="homepage")
     */
    public function HomeAction(Request $request)
    {
        $form = $this->createForm(LoginForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $user =$form->getData();
            dump($user);die;
        }

        $message="MERHABA DUNYA";
        return  $this->render ("main/index.html.twig",[
            "message" =>$message,
            "formLogin" =>$form->createView()
        ]);
    }
    /**
     * @Route("/a",name="photo")
     */
    public function photoAction()
    {
        return $this->render("takephoto.html.twig");
    }
}