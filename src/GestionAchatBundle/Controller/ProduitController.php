<?php

namespace GestionAchatBundle\Controller;

use GestionAchatBundle\Entity\Produit;
use GestionAchatBundle\Form\FournisseurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends Controller
{
    public function indexAction()
    {
        return $this->render('@GestionAchat/Default/index.html.twig');
    }
    public function createAction(Request $request)

    {
        $produit = new Produit();
        //prepare the form with the function: createForm()
        $form = $this->createForm(FournisseurType::class, $produit);
        //extract the form answer from the received request
        $form = $form->handleRequest($request);
        //if this form is valid
        if ($form->isValid()) {
            //create an entity manager object
            $em = $this->getDoctrine()->getManager();
            //persist the object $club in the ORM
            $em->persist($produit);
            //update the data base with flush
            $em->flush();
            //redirect the route after the add
            return $this->redirectToRoute('gestion_achat_fournisseur_read');
        }
        return $this->render('@GestionAchat/Default/produit/produit.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
