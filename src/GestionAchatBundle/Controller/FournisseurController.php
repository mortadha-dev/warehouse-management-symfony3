<?php

namespace GestionAchatBundle\Controller;

use GestionAchatBundle\Entity\Fournisseur;
use GestionAchatBundle\Form\FournisseurType;
use GestionAchatBundle\Form\UpdateFournisseurType;
use UserBundle\Entity\User;
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
        $form = $this->createForm(FournisseurType::class, $fournisseur);
        $form = $form->handleRequest($request);

        if ($form->isValid() && $fournisseur->getTelephone()>9999999 && $fournisseur->getTelephone()<100000000) {
            $user = new User();
            $user->setUsername($fournisseur->getNom());
            $user->setEmail($fournisseur->getNom());
            $user->setEnabled(1);
            $user->setPlainPassword($fournisseur->getTelephone());
            $fournisseur->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $em->persist($fournisseur);
            $em->flush();
            $this->addFlash(
                'info',
                'Added successfully!'
            );
           return $this->redirectToRoute('gestion_achat_fournisseur_read');
        }
        return $this->render('@GestionAchat/Default/create.html.twig', array(
            'fournisseur' => $fournisseur,
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
            $this->addFlash(
                'info',
                'modified successfully!'
            );
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
