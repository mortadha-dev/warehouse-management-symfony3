<?php

namespace GestionAchatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommandeController extends Controller
{
    public function indexAction()
    {
        return $this->render('@GestionAchatBundle/Default/index.html.twig');
    }
}





