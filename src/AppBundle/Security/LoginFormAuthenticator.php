<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 2.9.2017
 * Time: 13:53
 */

namespace AppBundle\Security;


use AppBundle\Form\LoginForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{

    private $formFactory;

    private $entityManager;

    private $router;

    private $passwordEncoder;

    public function __construct(FormFactoryInterface $formFactory ,
                                EntityManagerInterface $entityManager,
                                RouterInterface $router,
                                UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate("admin_page");
    }
    protected function getLoginUrl()
    {
        return $this->router->generate("user_login");
    }

    public function getCredentials(Request $request)
    {
        $isLoginSubmit =
            (
                $request->getPathInfo() == "/"
                &&
                $request->isMethod("POST")
            )
            ||
            (
                $request->getPathInfo()== "/login"
                &&
                $request->isMethod("POST")
            )
            ||
            (
                $request->getPathInfo()== "/register"
                &&
                $request->isMethod("POST")
            )
        ;
        if(!$isLoginSubmit){
            return;
        }

        $loginForm = $this->formFactory->create(LoginForm::class);
        $loginForm->handleRequest($request);
        $data = $loginForm->getData();
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data["_username"]
        );
        return $data;
        
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials["_username"];

        return $this->entityManager->getRepository("AppBundle:Users")
            ->findOneBy(["usernamee" =>$username]);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
       $password = $credentials["_password"];

       if($this->passwordEncoder->isPasswordValid($user,$password)){
           return true;
       }
       return false;

    }

}