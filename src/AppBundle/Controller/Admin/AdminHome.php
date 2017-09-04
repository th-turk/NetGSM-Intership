<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 2.9.2017
 * Time: 20:23
 */

namespace AppBundle\Controller\Admin;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminHome
 * @package AppBundle\Controller\Admin
 * @Route("/admin")
 * @Security("is_granted('ROLE_USER')")
 */
class AdminHome extends  Controller
{
    /**
     * @Route("/",name="admin_page")
     */
    public function adminAction()
    {
        return $this->render("admin/homepage.html.twig");
    }
}