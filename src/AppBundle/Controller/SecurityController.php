<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 11.8.2017
 * Time: 14:03
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Users;
use AppBundle\Form\LoginForm;
use AppBundle\Form\RegistrationForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login",name="user_login")
     */
    public function loginAction(Request $request, AuthenticationUtils $utils)
    {
        // get the login error if there is one
        $error = $utils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $utils->getLastUsername();

        $form = $this->createForm(LoginForm::class,[
            "_username"=>$lastUsername
        ]);

        return $this->render("login/index.html.twig",[
            "loginForm"=>$form->createView(),
            "error" =>$error
        ]);
    }
    /**
     * @Route("/logout",name="user_logout")
     */
    public function logoutAction()
    {
        throw new \Exception("this should not be reached ");
    }


    /**
     * @Route("/register",name="user_register")
     */
    public function registerAction(Request $request)
    {
        $formLogin = $this->createForm(LoginForm::class);
        $formLogin->handleRequest($request);

        if($formLogin->isSubmitted() &&  $formLogin->isValid()){
            $userLogin =$formLogin->getData();
            dump($userLogin);die;
        }

        $form   =   $this->createForm(RegistrationForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()    &&  $form->isValid()){
            /**
             * @var Users $user
             */
            $user= $form->getData();
            $user->setRoles(["ROLE_USER"]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash("success","Welcome ".$user->getUsername());
            return $this->get("security.authentication.guard_handler")
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $this->get("app.security.login_form_authenticator"),
                    "main"
                );

        }

        return $this->render(
            "registration/register.html.twig",[
            "form" => $form -> createView(),
            "formLogin" =>$formLogin->createView()
        ]);
    }

}