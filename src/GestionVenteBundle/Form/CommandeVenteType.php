<?php

namespace GestionVenteBundle\Form;

use GestionVenteBundle\Entity\Client;
use GestionVenteBundle\Repository\ClientRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeVenteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idClient', EntityType::class, [
            'class' => Client::class,
            'choice_label' => 'id'
        ])
                ->add("livree", CheckboxType::class)
                ->add('idLivraison')
                ->add('dateEnvoie')
                ->add('dateReception')
                ->add('selections');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GestionVenteBundle\Entity\CommandeVente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gestionventebundle_commandevente';
    }


}
