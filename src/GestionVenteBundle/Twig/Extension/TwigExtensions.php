<?php


namespace GestionVenteBundle\Twig\Extension;


use Symfony\Bridge\Doctrine\RegistryInterface;

class TwigExtensions extends \Twig_Extension
{

    protected $doctrine;
    // Retrieve doctrine from the constructor
    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getFilters()
    {
        return array(
            'find' => new \Twig_Filter_Method($this, 'find'),
        );
    }

    public function find($id){
        $em = $this->doctrine->getManager();
        $myRepo = $em->getRepository('AppBundle:Product');
        ///

        return $myRepo->find($id);
    }

    public function getName()
    {
        return 'Twig myCustomName Extensions';
    }
}
