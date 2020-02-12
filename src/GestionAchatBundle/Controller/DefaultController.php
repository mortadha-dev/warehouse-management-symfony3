<?php

namespace GestionAchatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@GestionAchat/Default/index.html.twig');
    }
}
