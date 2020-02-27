<?php

namespace GestionStockBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite')
            ->add('datedestockage')
            ->add('produit',EntityType::class,array(
                'class'=>'GestionStockBundle:Produit',
                'choice_label'=>'description',
                'multiple'=>false,
                'expanded' => false,))
            ->add('entrepot',EntityType::class,array(
                'class'=>'GestionStockBundle:Entrepot',
                'choice_label'=>'nomcourtlieu',
                'multiple'=>false,
                'expanded' => false,))
            ->add('Ajouter_produit_au_stockage', SubmitType::class,['label'=>'Ajouter produit au stockage']);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GestionStockBundle\Entity\Stockage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gestionstockbundle_stockage';
    }


}
