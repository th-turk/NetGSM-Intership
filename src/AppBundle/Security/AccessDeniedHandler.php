<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 3.9.2017
 * Time: 09:06
 */

namespace AppBundle\Security;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {

        return new RedirectResponse("/Employee/page/1");
    }

}