<?php

namespace GestionVenteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GestionVenteBundle:Default:index.html.twig');
    }
}
