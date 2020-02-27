<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('frontend/base.html.twig');
    }

    /**
     * @Route("/administration", name="administration")
     */
    public function administrationAction()
    {
        $user = $this->getUser();
        //dump($user->getRoles());
        if($user){
            if ($user->hasRole("ROLE_VENTE")){
                return $this->redirectToRoute("vente_homepage");
            }
        }
        return $this->redirectToRoute("homepage");
    }


}
