<?php

namespace GestionVenteBundle\Controller;

use GestionVenteBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Client controller.
 *
 * @Route("client")
 */
class ClientController extends Controller
{
    /**
     * Lists all client entities.
     *
     * @Route("/", name="client_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clients = $em->getRepository('GestionVenteBundle:Client')->findAll();

        return $this->render('client/index.html.twig', array(
            'clients' => $clients,
        ));
    }

    /**
     * Finds and displays a client entity.
     *
     * @Route("/{id}", name="client_show")
     * @Method("GET")
     */
    public function showAction(Client $client)
    {

        return $this->render('client/show.html.twig', array(
            'client' => $client,
        ));
    }
}
