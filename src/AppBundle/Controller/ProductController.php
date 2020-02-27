<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use GestionStockBundle\Entity\Produit;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends BaseController
{
    /**
     * @Route("/products/{id}", name="product_show")
     */
    public function showAction(Produit $product)
    {
        return $this->render('product/show.html.twig', array(
            'product' => $product
        ));
    }

    /**
     * @Route("/pricing", name="pricing_show")
     */
    public function pricingAction()
    {
        return $this->render('product/pricing.html.twig', array(
        ));
    }
}
