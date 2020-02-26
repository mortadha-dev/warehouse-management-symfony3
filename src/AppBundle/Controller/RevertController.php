<?php


namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;

class RevertController extends BaseController
{
    /**
     * @Route("/test/home")
     */
    public function homeAction()
    {
        return $this->render(":frontend:base.html.twig");
    }
}
