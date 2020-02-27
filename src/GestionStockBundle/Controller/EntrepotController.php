<?php

namespace GestionStockBundle\Controller;

use GestionStockBundle\Entity\Entrepot;
use GestionStockBundle\Entity\Produit;
use GestionStockBundle\Form\EntrepotType;
use GestionStockBundle\Form\UpdateentrepotType;
use GestionStockBundle\Form\UpdateproduitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EntrepotController extends Controller
{
    public function indexAction()
    {
        return $this->render('@GestionStock/Entrepot/index.html.twig');
    }
    public  function indexxAction(Request $request){
        $snappy = $this->get("knp_snappy.pdf");
        $filename = "myfirst_pdf";
        $websiteUrl = "http://localhost/pi-gestion_stock_tayssir/web/app_dev.php/administration/entrepot/read";

        $snappy->setOption("encoding", "UTF-8");
        return new Response($snappy->getOutput($websiteUrl),200,array('Content-Type'=>'application/pdf',
        'Content-Disposition'=>'inline; filename="'.$filename.'.pdf"'));

//        $snappy = $this->get("knp_snappy.pdf");
//        $html = $this->renderView("@GestionStock/Entrepot/read.html.twig", array("title"=>"PDF title"));
//        $filename = "myfirst_pdf";
//        //$websiteUrl = "http://localhost/pi-gestion_stock_tayssir/web/app_dev.php/read";
//
//        //$snappy->setOption("encoding", "UTF-8");
//        return new Response($snappy->getOutputFromHtml($html),200,array('Content-Type'=>'application/pdf',
//            'Content-Disposition'=>'inline; filename="'.$filename.'.pdf"'));
    }
    public function readAction()
    {

        //Fetching Objects (Clubs) from the Database
        $entrepots=$this->getDoctrine()->getManager()->getRepository(Entrepot::class)->findAll();
        //add the list of clubs to the render function as input to be sent to the view
        return $this->render('@GestionStock/Entrepot/read.html.twig', array('entrepots'=>$entrepots ));

    }
    public function createAction(Request $request)
    {   //create an object to store our data after the form submission
        $entrepot=new Entrepot();
        //prepare the form with the function: createForm()
        $form=$this->createForm(EntrepotType::class,$entrepot);
        //extract the form answer from the received request
        $form=$form->handleRequest($request);
        //if this form is valid
        if($form->isValid()){
            //create an entity manager object
            $em=$this->getDoctrine()->getManager();
            //persist the object $club in the ORM
            $em->persist($entrepot);
            //update the data base with flush
            $em->flush();
            //redirect the route after the add
            return $this->redirectToRoute('entrepot_homepage');
        }
        return $this->render('@GestionStock/Entrepot/create.html.twig', array(
            'form'=>$form->createView()
         ));
    }

    public function updateAction(Request $request, $id)
    {
        $entrepot = $this->getDoctrine()->getmanager()->getRepository(Entrepot::class)->find($id);
        $form= $this->createForm(UpdateentrepotType::class,$entrepot);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($entrepot);
            $ef->flush();
            return $this->redirectToRoute("entrepot_homepage");
        }
        return $this->render("@GestionStock/Entrepot/update.html.twig",array("forma"=>$form->createView()));

    }



    public function deleteAction($id)
    {
        //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $entrepot= $em->getRepository(Entrepot::class)->find($id);
        //remove from the ORM
        $em->remove($entrepot);
        //update the data base
        $em->flush();
        return $this->redirectToRoute("entrepot_homepage");
    }



}
