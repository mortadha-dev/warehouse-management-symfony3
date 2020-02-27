<?php

namespace GestionStockBundle\Controller;

use GestionStockBundle\Entity\Produit;
use GestionStockBundle\Form\ProduitType;
use GestionStockBundle\Form\UpdateproduitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends Controller
{
    public function indexAction()
    {
        return $this->render('@GestionStock/Produit/index.html.twig');
    }

    public function readAction()
    {
        $produits= $this->getDoctrine()->getManager()->getRepository(Produit::class)->findproduit();
        return $this->render("@GestionStock/Produit/read.html.twig",array ('produits'=>$produits));
    }

    public function createAction(Request $request)
    {
        $produit= new Produit();
        $form= $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $produit->setSupprimer(0);
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($produit);
            $ef->flush();
            return $this->redirectToRoute("produit_homepage");
        }
        return $this->render("@GestionStock/Produit/create.html.twig",array("form"=> $form->createView()));
    }

    public function updateAction(Request $request, $id)
    {
        $produit = $this->getDoctrine()->getmanager()->getRepository(Produit::class)->find($id);
        $form= $this->createForm(UpdateproduitType::class,$produit);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($produit);
            $ef->flush();
            return $this->redirectToRoute("produit_homepage");
        }
        return $this->render("@GestionStock/Produit/updateproduit.html.twig",array("forma"=>$form->createView()));

    }
    public function deleteAction($id){

        $ef= $this->getDoctrine()->getManager();
        $produit = $ef->getRepository(Produit::class)->find($id);
        $produit->setSupprimer(1);
        $ef= $this->getDoctrine()->getManager();
        $ef->persist($produit);
        $ef->flush();

        return $this->redirectToRoute("produit_homepage");
    }


    public function produitsuppAction(){
        $produits= $this->getDoctrine()->getManager()->getRepository(Produit::class)->findproduitsupprimer();
        return $this->render("@GestionStock/Produit/produitsupp.html.twig",array ('produits'=>$produits));
    }
    public function recupererAction($id){

        $ef= $this->getDoctrine()->getManager();
        $produit = $ef->getRepository(Produit::class)->find($id);
        $produit->setSupprimer(0);
        $ef= $this->getDoctrine()->getManager();
        $ef->persist($produit);
        $ef->flush();
        return $this->redirectToRoute("produit_supprimer");
    }

}
