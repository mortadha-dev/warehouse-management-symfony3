<?php

namespace LivraisonBundle\Controller;

use LivraisonBundle\Entity\Livraison;
use LivraisonBundle\Form\LivraisonType;
use LivraisonBundle\Form\UpdateLivraisonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LivraisonController extends Controller
{
    public function indexAction()
    {
        return $this->render('LivraisonBundle:Default:index.html.twig');
    }
    public function readAction()
    {
        $livraisons= $this->getDoctrine()->getManager()->getRepository(Livraison::class)->findAll();
        return $this->render("@Livraison/livraison/read.html.twig",array ('livraisons'=>$livraisons));
    }
    public function mapAction()
    {
        return $this->render("@Livraison/livraison/map.html.twig");
    }
    public function deleteAction($id){

        $ef= $this->getDoctrine()->getManager();
        $livraison = $ef->getRepository(Livraison::class)->find($id);
        $ef->remove($livraison);
        $ef->flush();
        return $this->redirectToRoute("readliv");
    }
    public function createAction(Request $request)
    {
        $Livraison= new Livraison();
        $form= $this->createForm(LivraisonType::class,$Livraison);
        $form->handleRequest($request);
        $now = new \DateTime("now");
        if ($form->isSubmitted()&& $now<$Livraison->getDateliv()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($Livraison);
            $ef->flush();
            return $this->redirectToRoute("readliv");
        }
        return $this->render("@Livraison/livraison/create.html.twig",array("form"=> $form->createView()));
    }
    public function updateAction(Request $request, $id)
    {
        $Livraison= $this->getDoctrine()->getmanager()->getRepository(Livraison::class)->find($id);
        $form= $this->createForm(LivraisonType::class,$Livraison);
        $form->handleRequest($request);
        $ef= $this->getDoctrine()->getManager();
        if ($form->isSubmitted()){

            //$ef->persist($Livraison);
            $ef->flush();
            return $this->redirectToRoute("readliv");
        }
        return $this->render("@Livraison/livraison/update.html.twig",array("forma"=>$form->createView()));

    }

    public function callAction()
    {
        //returns an instance of Vresh\TwilioBundle\Service\TwilioWrapper
        $twilio = $this->get('twilio.api');

        $message = $twilio->account->messages->sendMessage(
            '+16467985439', // From a Twilio number in your account
            '+21692957217', // Text any number
            "hello world"
        );

        //get an instance of \Service_Twilio
        $otherInstance = $twilio->createInstance('BBBB', 'CCCCC');

        return new Response($message->sid);
    }
}
