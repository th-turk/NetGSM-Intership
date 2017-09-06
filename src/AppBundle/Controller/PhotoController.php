<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 24.8.2017
 * Time: 15:41
 */

namespace AppBundle\Controller;



use AppBundle\Entity\Photos;
use AppBundle\Form\LoginPhotoType;
use AppBundle\Form\PhotoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PhotoController extends Controller
{
    /**
     * @Route("/photo", name="photo_new")
     */
    public function newAction(Request $request)
    {
        $hiddenform=$this->createForm(LoginPhotoType::class);

        $hiddenform->handleRequest($request);
        if ($hiddenform->isSubmitted() && $hiddenform->isValid())
        {
            $upload_dir = $this->getUploadRoot();
            //$img = $request->request->get("");
            $img = $hiddenform->get("textArea")->getData();
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = $upload_dir . mktime() . ".png";
            $success = file_put_contents($file, $data);
            print_r($success ? $file : 'Unable to save the file.');
        }
        return $this->render('main/index.html.twig', array(
            "formHidden"=>$hiddenform->createView()
        ));
    }



}