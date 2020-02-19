<?php


namespace GestionVenteBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homeAction(){
        return $this->render("@GestionVente/base/main.html.twig");
    }
}
