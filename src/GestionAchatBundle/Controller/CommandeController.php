<?php

namespace GestionAchatBundle\Controller;
use GestionAchatBundle\Entity\Commande;
use GestionAchatBundle\Entity\Fournisseur;
use GestionAchatBundle\Form\CommandeType;
use GestionAchatBundle\Form\PrixType;
use GestionAchatBundle\Form\RechercheType;
use GestionAchatBundle\Form\UpdateCommandeType;
use GestionAchatBundle\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends Controller
{
    public function indexAction()
    {
        return $this->render('@GestionAchatBundle/Default/index.html.twig');
    }

    public function readAction(Request $request)
    {

        $commande = $this->getDoctrine()->getManager()->getRepository(Commande::class)->findAll();


        $paginationCommands = $this->get('knp_paginator')->paginate(
            $commande, $request->query->getInt('page', 1), 3);
        //add the list of clubs to the render function as input to be sent to the view
        return $this->render('@GestionAchat/commande/readcommande.html.twig', array('commandes' => $paginationCommands));

    }

    public function createAction(Request $request)

    {
        $commande = new Commande();
        //prepare the form with the function: createForm()
        $form = $this->createForm(CommandeType::class, $commande);
        //extract the form answer from the received request
        $form = $form->handleRequest($request);
        //if this form is valid
        if ($form->isValid()) {

            $commande->setNomFournisseur($commande->getFournisseur()->getNom());
            //create an entity manager object
            $em = $this->getDoctrine()->getManager();
            //persist the object $club in the ORM
            $commande->setPrixUnitaire('null');
            $commande->setCommentaire('null');
            $commande->setPrixTotal('null');
            $commande->setEtat('en attente');
            $em->persist($commande);
            //update the data base with flush
            $em->flush();
            //redirect the route after the add
            return $this->redirectToRoute('gestion_achat_commande_read');
        }
        return $this->render('@GestionAchat/commande/createcommande.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function updateAction(Request $request, $id)
    {
        $commande = $this->getDoctrine()->getmanager()->getRepository(Commande::class)->find($id);
        $form = $this->createForm(UpdateCommandeType::class, $commande);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $ef = $this->getDoctrine()->getManager();
            $ef->persist($commande);
            $ef->flush();
            return $this->redirectToRoute("gestion_achat_commande_read");
        }
        return $this->render("@GestionAchat/commande/updatecommande.html.twig", array("forma" => $form->createView()));

    }

    public function deleteAction($id)
    {

        $ef = $this->getDoctrine()->getManager();
        $commande = $ef->getRepository(Commande::class)->find($id);
        $ef->remove($commande);
        $ef->flush();
        return $this->redirectToRoute("gestion_achat_commande_read");
    }

    public function searchAction(Request $request)
    {
        $commande = new Commande();//instance d'entity
        $form = $this->createForm(RechercheType::class, $commande);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $commande = $this->getDoctrine()->getManager()->getRepository(Commande::class)
                ->findBy(array('libellecommande' => $commande->getLibelleCommande()));
        } else {
            $formations = $this->getDoctrine()->getManager()->getRepository(Commande::class)->findAll();
        }
        return $this->render("@GestionAchat/commande/recherchecommande.html.twig", array("Form" => $form->createView(), 'commandes' => $commande));

    }

    public function showAction(Commande $commande)
    {

        return $this->render('@GestionAchat/commande/show.html.twig', array(
            'commande' => $commande,
        ));
    }

    public function calendarAction()
    {
        return $this->render('@GestionAchat/booking/calendar.html.twig');
    }

    public function importerAction(Request $request)
    {
        $fournisseurId = $this->getDoctrine()->getManager()->getRepository(Fournisseur::class)->findFournisseurByIdUser($this->getUser()->getId());
        $commande = $this->getDoctrine()->getManager()->getRepository(Commande::class)->findCommands($fournisseurId);

        $paginationCommands = $this->get('knp_paginator')->paginate(
            $commande, $request->query->getInt('page', 1), 3);
        //add the list of clubs to the render function as input to be sent to the view
        return $this->render('@GestionAchat/commande/importer.html.twig', array('commandes' => $paginationCommands));
    }


    public function acceptAction(Request $request, $id)
    {
        $commande = $this->getDoctrine()->getmanager()->getRepository(Commande::class)->find($id);
        $form = $this->createForm(PrixType::class, $commande);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $ef = $this->getDoctrine()->getManager();
            $commande->setEtat("Accepté");
            $es = $commande->getPrixUnitaire();
            $ty = $commande->getQuantitecommande();
            $commande->setPrixTotal($es * $ty);
            $ef->persist($commande);
            $ef->flush();
            return $this->redirectToRoute("felecit");
        }
        return $this->render("@GestionAchat/commande/prix.html.twig", array('commande' => $commande, "forma" => $form->createView()));
    }

//    public function acceptAction(Request $request, $id)
//    {
//        $ef = $this->getDoctrine()->getManager();
//        $commande= $this->getDoctrine()->getmanager()->getRepository(Commande::class)->find($id);
//        $commande->setEtat('Accepté');
//        $ef->persist($commande);
//        $ef->flush();
//        return $this->redirectToRoute("felecit");
//    }
    public function refusAction(Request $request, $id)
    {
        $ef = $this->getDoctrine()->getManager();
        $commande = $this->getDoctrine()->getmanager()->getRepository(Commande::class)->find($id);
        $commande->setEtat('refusé');
        $ef->persist($commande);
        $ef->flush();
        return $this->redirectToRoute("desole");
    }

    public function felecitAction()
    {
        return $this->render('@GestionAchat/commande/felecitcommande.html.twig');
    }

    public function desoleAction()
    {
        return $this->render('@GestionAchat/commande/desolecommande.html.twig');
    }
    public function commentaireAction(Request $request)
     {

        $commande = $this->getDoctrine()->getManager()->getRepository(Commande::class)->findAll();


        $paginationCommands = $this->get('knp_paginator')->paginate(
            $commande, $request->query->getInt('page', 1), 3);
        //add the list of clubs to the render function as input to be sent to the view
        return $this->render('@GestionAchat/commande/commentairecommande.html.twig', array('commandes' => $paginationCommands));

    }

}





