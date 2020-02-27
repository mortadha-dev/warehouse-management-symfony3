<?php

namespace GestionStockBundle\Controller;



use GestionStockBundle\Entity\Produit;
use GestionStockBundle\Entity\Stockage;
use GestionStockBundle\Form\StockageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class StockageController extends Controller
{
    public function indexAction()
    {
        return $this->render('@GestionStock/Stockage/index.html.twig');
    }

    public function readAction()
    {
        $stockages= $this->getDoctrine()->getManager()->getRepository(Stockage::class)->findAll();
        return $this->render("@GestionStock/Stockage/read.html.twig",array ('stockages'=>$stockages));
    }






    public function createAction(Request $request,$id)
    {
        $stockage= new Stockage();
        $form= $this->createForm(StockageType::class,$stockage);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($stockage);
            $ef->flush();
            return $this->redirectToRoute("produitstocke");
        }
        return $this->render("@GestionStock/Stockage/create.html.twig",array("form"=> $form->createView()));
    }










    public function readnnstockeAction()
    {
        $produits = $this->getDoctrine()->getManager()->getRepository(Produit::class)->findAll();
        $stockages = $this->getDoctrine()->getManager()->getRepository(Stockage::class)->findAll();
        $produitsNonStocke = array();

        $i = 0;
        foreach ($produits as $p){
            $ok = false;
            foreach ($stockages as $s){
                if($p->getId()==$s->getProduit()->getId()){
                    $ok = true;
                    break;
                }
            }
            if(!$ok) {
                $produitsNonStocke[$i] = $p;
                $i++;
            }
        }

        $produitStockePartial = array();
        $k = 0;
        foreach ($produits as $p){

            $ok = false;
            $verif = false;
            $produit = new Produit();
            foreach ($stockages as $s){
                if($p->getId()==$s->getProduit()->getId()){
                    $verif = true;
                    if(!$ok){
                        $produit->setId($p->getId());
                        $produit->setDescription($p->getDescription());
                        $produit->setLibelle($p->getLibelle());
                        $produit->setQuantite($p->getQuantite());
                        $produit->setQuantitemin($p->getQuantitemin());
                        $produit->setSupprimer($p->isSupprimer());
                        $produit->setQuantite($s->getQuantite());

                        $ok = true;
                    } else {
                        $produit->setQuantite($produit->getQuantite()+$s->getQuantite());
                    }
                }
            }

            if($verif && $produit->getQuantite()<$p->getQuantite()){
                $produitStockePartial[$k] = $produit;
                $k++;
            }
        }
            return $this->render("@GestionStock/Stockage/listpdtnnstocke.html.twig", array('produitsNonStocke' => $produitsNonStocke, 'produitStockepartial' => $produitStockePartial));
        }


    }
