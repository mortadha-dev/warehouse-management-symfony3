<?php

namespace LivraisonBundle\Controller;

use LivraisonBundle\Entity\Livreure;
use LivraisonBundle\Form\LivreureType;
use LivraisonBundle\Form\UpdateLivreureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LivreureController extends Controller
{
    public function indexAction()
    {
        return $this->render('LivraisonBundle:Default:index.html.twig');
    }
    public function readAction()
    {
        $livreures= $this->getDoctrine()->getManager()->getRepository(Livreure::class)->findAll();
        return $this->render("@Livraison/livreure/read.html.twig",array ('livreures'=>$livreures));
    }
    public function createAction(Request $request)
    {
        $Livreure= new Livreure();
        $form= $this->createForm(LivreureType::class,$Livreure);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if(($Livreure->getNumtel()>=11111111)&&($Livreure->getNumtel()<=999999999)){
                $ef= $this->getDoctrine()->getManager();
                $ef->persist($Livreure);
                $ef->flush();

                $Tel='+216'.$Livreure->getNumtel();
                $msg='Bienvenu avec nous Mr '.$Livreure->getNomliv();
                $twilio = $this->get('twilio.api');

                $message = $twilio->account->messages->sendMessage(
                    '+12564459075', // From a Twilio number in your account
                    $Tel, // Text any number
                    //$tel,
                    $msg
                );
                return $this->redirectToRoute("read");
            }

            else{
                echo"<script>alert(\"le numero de tephone est invalid\")</script>";
            }
        }
        return $this->render("@Livraison/livreure/create.html.twig",array("form"=> $form->createView()));
    }
    public function updateAction(Request $request, $id)
    {
        $Livreure= $this->getDoctrine()->getmanager()->getRepository(Livreure::class)->find($id);
        $form= $this->createForm(UpdateLivreureType::class,$Livreure);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($Livreure);
            $ef->flush();
            return $this->redirectToRoute("read");
        }
        return $this->render("@Livraison/livreure/update.html.twig",array("forma"=>$form->createView()));

    }
    public function deleteAction($id){

        $ef= $this->getDoctrine()->getManager();
        $livreure = $ef->getRepository(Livreure::class)->find($id);
        $ef->remove($livreure);
        $ef->flush();
        return $this->redirectToRoute("read");
    }


}

