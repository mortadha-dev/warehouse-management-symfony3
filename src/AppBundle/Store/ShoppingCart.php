<?php

namespace AppBundle\Store;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use GestionStockBundle\Entity\Produit;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ShoppingCart
{
    const CART_PRODUCTS_KEY = '_shopping_cart.products';
    const CART_PRODUCTS_TOTAL = 'shopping_cart.total';
    private $session;
    private $em;

    private $association;
    private $products;

    public function __construct(SessionInterface $session, EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->em = $em;
    }

    public function addProduct(Produit $product)
    {
        $products = $this->getProducts();

        if (!in_array($product, $products)) {
            $products[] = $product;
        }

        $this->updateProducts($products);
    }

    /**
     * @return Produit[]
     */
    public function getProducts()
    {
        if ($this->products === null) {
            $productRepo = $this->em->getRepository('GestionStockBundle:Produit');
            $ids = $this->session->get(self::CART_PRODUCTS_KEY, []);
            $products = [];
            foreach ($ids as $id) {
                $product = $productRepo->find($id);

                // in case a product becomes deleted
                if ($product) {
                    $products[] = $product;
                }
            }

            $this->products = $products;
        }

        return $this->products;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        //foreach ($this->getProducts() as $product) {
            //$product->getPrice() * intval($this->association[(string)$product->getId()])
            //$total += $product->getPrice() ;
        //}


        return $this->session->get(self::CART_PRODUCTS_TOTAL);
    }

    public function emptyTotal()
    {
        $this->session->set(self::CART_PRODUCTS_TOTAL,0);
    }

    public function setTotal($t)
    {
        $total=0;
        foreach ($this->getProducts() as $product) {
            $total += $product->getPrix() * intval($this->association[$product->getId()]);
        }
        $this->session->set(self::CART_PRODUCTS_TOTAL, $total);
    }

    public function emptyCart()
    {
        $this->updateProducts([]);
    }

    /**
     * @param Produit[] $products
     */
    private function updateProducts(array $products)
    {
        $this->products = $products;

        $ids = array_map(function(Produit $item) {
            return $item->getId();
        }, $products);

        $this->session->set(self::CART_PRODUCTS_KEY, $ids);
    }

    /**
     * @return mixed
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * @param mixed $association
     */
    public function setAssociation($association)
    {
        $this->association = $association;
    }


}
