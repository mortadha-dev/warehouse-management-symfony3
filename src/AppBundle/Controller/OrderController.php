<?php

namespace AppBundle\Controller;

use GestionStockBundle\Entity\Produit;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends BaseController
{
    /**
     * @Route("/cart/product/{id}", name="order_add_product_to_cart")
     * @Method("POST")
     */
    public function addProductToCartAction(Produit $product)
    {
        $this->get('shopping_cart')
            ->addProduct($product);

        $this->addFlash('success', 'Product added!');

        return $this->redirectToRoute('order_checkout');
    }

    /**
     * @Route("/checkout", name="order_checkout")
     * @Security("is_granted('ROLE_USER')")
     */
    public function checkoutAction(Request $request)
    {
            if ($request->isMethod('POST')) {
                $token = $request->request->get('stripeToken');
                \Stripe\Stripe::setApiKey($this->getParameter("stripe_secret_key"));
                $user = $this->getUser();

                if(!$user->getStripeCustomerId()){ // user first time making payement with
                    \Stripe\Stripe::setApiKey($this->getParameter("stripe_secret_key"));
                    $customer = \Stripe\Customer::create([
                        "email" => $user->getEmail(),
                        "source" => $token
                        ]);

                    $user->setStripeCustomerId($customer->id);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();

                } else {
                    $customer = \Stripe\Customer::retrieve($user->getStripeCustomerId());
                    $customer->source = $token;
                    $customer->save();
                }

                \Stripe\Charge::create(array(
                    "amount" =>  $this->get('shopping_cart')-> getTotal() *100,
                    "currency" => "usd",
                    "customer" => $customer,
                    "description" => "First test charge!"
                ));
                // Empty cart after successful charge
                $this->get('shopping_cart')->emptyCart();
                $this->get('shopping_cart')->emptyTotal();
                $this->addFlash('success', 'Order Complete! Yay!');
                return $this->redirectToRoute('homepage');
                //return new Response(var_dump($this->get("shopping_cart")->getTotal()));
            }



        $products = $this->get('shopping_cart')->getProducts();
        return $this->render('order/checkout.html.twig', array(
            'products' => $products,
            'cart' => $this->get('shopping_cart'),
            'public_key' => $this->getParameter("stripe_public_key")
        ));
    }
}

