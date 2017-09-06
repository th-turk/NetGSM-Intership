<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 10.8.2017
 * Time: 15:03
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Employee;
use AppBundle\Entity\Photos;
use AppBundle\Form\LoginForm;
use AppBundle\Form\LoginPhotoType;
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

        $formLogin = $this->createForm(LoginForm::class);
        $formLogin->handleRequest($request);
        if($formLogin->isSubmitted() &&  $formLogin->isValid()){
            $user =$formLogin->getData();
            dump($user);die;
        }

        $hiddenform=$this->createForm(LoginPhotoType::class);
        $hiddenform->handleRequest($request);

        if ($hiddenform->isSubmitted() && $hiddenform->isValid())
        {
            $employee = $hiddenform->get("employee")->getData();

            $findedEmployee=$this->employeeFind($employee);

                if ( $findedEmployee!= null)
                {
                    if (!is_dir($this->getUploadRoot($employee)))
                    {
                        mkdir($this->getUploadRoot($employee),"0777",true);
                    }

                    $upload_dir = $this->getUploadRoot($employee);
                    $photo=new Photos();
                    $img = $hiddenform->get("textArea")->getData();
                    $img = str_replace('data:image/png;base64,', '', $img);
                    $img = str_replace(' ', '+', $img);
                    $data = base64_decode($img);

                    $file = $upload_dir . mktime() . ".png";

                    $photo->setName(str_replace($upload_dir,"",$file));
                    $photo->setEmployee($findedEmployee);

                    $em = $this->getDoctrine()->getManager();
                    $em ->persist($photo);
                    $em->flush();
                    $success = file_put_contents($file, $data);

                    $this->addFlash("success","You started to login");
                    return $this->redirectToRoute("homepage");
                }
                else{
                    $this->addFlash("error","You failled to login");
                    return $this->redirectToRoute("homepage");
                }


        }

        return  $this->render ("main/index.html.twig",[
            "formLogin" =>$formLogin->createView(),
            "formHidden"=>$hiddenform->createView(),
        ]);
    }


    public function getUploadDir($employeePage)
    {
        return "uploads/photos/".$employeePage;
    }

    public function getUploadRoot($employeePage)
    {
        return __DIR__."/../../../web/".$this->getUploadDir($employeePage)."/";
    }

    public function employeeFind($employee)
    {
        $em= $this->getDoctrine()->getManager();
        $employeeFind =$em
            ->getRepository(Employee::class)
            ->find($employee);
        return $employeeFind;
    }
}