<?php

namespace GestionAchatBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle_commande')
            ->add('description_commande')
            ->add('quantite_commande')

            ->add('produit',EntityType::class,array(
                'class'=>'GestionStockBundle:produit',
                'choice_label'=>'libelle',
                'multiple'=>false,
                'expanded' => false,))

            ->add('fournisseur',EntityType::class,array(
                'class'=>'GestionAchatBundle:fournisseur',
                'choice_label'=>'nom',
                'multiple'=>false,
                'expanded' => false,))
            ->add('date', DateType::class, [
                'placeholder' => array(
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'
                ),
                'years' => range(date('Y'), date('Y')+5),
            ]  ) ->add('commander',SubmitType::class,[
                'attr' => ['formnovalidate ' => 'formnovalidate']
            ])


      ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GestionAchatBundle\Entity\Commande'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gestionachatbundle_commande';
    }


}
