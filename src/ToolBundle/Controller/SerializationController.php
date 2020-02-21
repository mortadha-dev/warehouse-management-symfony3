<?php


namespace ToolBundle\Controller;


use AppBundle\Entity\Product;
use GestionVenteBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SerializationController extends  Controller
{
    public function serializeProductAction(Product $product){
        $object = $product;
        $serializer = \JMS\Serializer\SerializerBuilder::create()->setCacheDir("GestionVenteBundle\\Serialization")->build();
        $json = $serializer->serialize($object, 'json');
        $serializer->serialize($object, 'xml');
        return new Response($json);
    }

    public function serializeClientAction(Client $client){

    }

    public function deserializeProductAction(Product $product){

    }

    public function deserializeClientAction(){

    }
}
