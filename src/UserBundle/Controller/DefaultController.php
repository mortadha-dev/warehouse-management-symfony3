<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@User/Default/index.html.twig');
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function backAction()
    {
        return $this->render('@User/Default/back.html.twig');
    }
}
