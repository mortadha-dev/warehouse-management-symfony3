<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
        public function homepageAction(Request $request)
    {
        $products = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findAll();

        return $this->render('default/homepage.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * @Route("/administration", name="administration")
     */
    public function administrationAction()
    {
        $user = $this->getUser();
        //dump($user->getRoles());
        if ($user->hasRole("ROLE_VENTE")){
            return $this->redirectToRoute("vente_homepage");
        }
        return $this->redirectToRoute("homepage");
    }
}
