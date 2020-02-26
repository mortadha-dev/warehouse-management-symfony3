<?php


namespace GestionVenteBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function venteAction(){
        $em = $this->getDoctrine()->getManager();
        $prods = $em->getRepository("AppBundle:Product")->findAll();
        return $this->render("frontend/vente.html.twig", [
            'products' => $prods
        ]);
    }

    public function backHomeAction()
    {
        return $this->render("@GestionVente/base/main.html.twig");
    }
}
