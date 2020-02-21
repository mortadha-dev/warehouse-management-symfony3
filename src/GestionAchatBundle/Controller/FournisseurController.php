<?php

namespace GestionAchatBundle\Controller;

use ClubBundle\Entity\Formation;
use GestionAchatBundle\Entity\Fournisseur;
use GestionAchatBundle\Form\FournisseurType;
use GestionAchatBundle\Form\UpdateFournisseurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FournisseurController extends Controller
{

    public function readAction()
    {

        $fournisseur=$this->getDoctrine()->getManager()->getRepository(fournisseur::class)->findAll();
        //add the list of clubs to the render function as input to be sent to the view
        return $this->render('@GestionAchat/Default/read.html.twig', array('fournisseurs'=>$fournisseur ));

    }


        public function createAction(Request $request)

    {
        $fournisseur = new fournisseur();
        //prepare the form with the function: createForm()
        $form = $this->createForm(FournisseurType::class, $fournisseur);
        //extract the form answer from the received request
        $form = $form->handleRequest($request);
        //if this form is valid
        if ($form->isValid()) {
            //create an entity manager object
            $em = $this->getDoctrine()->getManager();
            //persist the object $club in the ORM
            $em->persist($fournisseur);
            //update the data base with flush
            $em->flush();
            //redirect the route after the add
            return $this->redirectToRoute('gestion_achat_fournisseur_read');
        }
        return $this->render('@GestionAchat/Default/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function updateAction(Request $request, $id)
    {
        $fournisseur= $this->getDoctrine()->getmanager()->getRepository(Fournisseur::class)->find($id);
        $form= $this->createForm(UpdateFournisseurType::class,$fournisseur);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($fournisseur);
            $ef->flush();
            return $this->redirectToRoute("gestion_achat_fournisseur_read");
        }
        return $this->render("@GestionAchat/Default/update.html.twig",array("forma"=>$form->createView()));

    }
    public function deleteAction($id){

        $ef= $this->getDoctrine()->getManager();
        $fournisseur = $ef->getRepository(Fournisseur::class)->find($id);
        $ef->remove($fournisseur);
        $ef->flush();
        return $this->redirectToRoute("gestion_achat_fournisseur_read");
    }


}
