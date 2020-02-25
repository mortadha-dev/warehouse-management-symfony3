<?php

namespace GestionVenteBundle\Controller;

use GestionVenteBundle\Entity\CommandeVente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;


class CommandeVenteController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandeVentes = $em->getRepository('GestionVenteBundle:CommandeVente')->findAll();

        return $this->render('@GestionVente/commandevente/index.html.twig', array(
            'commandeVentes' => $commandeVentes,
        ));
    }

    public function newAction(Request $request)
    {
        $commandeVente = new Commandevente();
        $date = new \DateTime("now");
        $commandeVente->setDateEnvoie($date);
        $commandeVente->setDateReception($date);
        dump($commandeVente);
        $form = $this->createForm('GestionVenteBundle\Form\CommandeVenteType', $commandeVente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commandeVente);
            $em->flush();

            return $this->redirectToRoute('vente_show_commande', array('id' => $commandeVente->getId()));
        }

        return $this->render('@GestionVente/commandevente/new.html.twig', array(
            'commandeVente' => $commandeVente,
            'form' => $form->createView(),
        ));
    }


    public function showAction(CommandeVente $commandeVente)
    {
        $deleteForm = $this->createDeleteForm($commandeVente);

        return $this->render('@GestionVente/commandevente/show.html.twig', array(
            'commandeVente' => $commandeVente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, CommandeVente $commandeVente)
    {
        $deleteForm = $this->createDeleteForm($commandeVente);
        $editForm = $this->createForm('GestionVenteBundle\Form\CommandeVenteType', $commandeVente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vente_edit_commande', array('id' => $commandeVente->getId()));
        }

        return $this->render("@GestionVente/commandevente/edit.html.twig", array(
            'commandeVente' => $commandeVente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, CommandeVente $commandeVente)
    {
        $form = $this->createDeleteForm($commandeVente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commandeVente);
            $em->flush();
        }

        return $this->redirectToRoute('vente_index_commande');
    }

    /**
     * Creates a form to delete a commandeVente entity.
     *
     * @param CommandeVente $commandeVente The commandeVente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CommandeVente $commandeVente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vente_delete_commande', array('id' => $commandeVente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function saveCommandeAction(Request $request)
    {
        $products = $request->request->get("products");
        return new Response($products);
    }
}
