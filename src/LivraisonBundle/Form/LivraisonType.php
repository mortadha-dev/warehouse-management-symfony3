<?php

namespace LivraisonBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LivraisonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ville')
            ->add('pays')
            ->add('adresse')
            ->add('dateliv')
            ->add('heurliv')
            ->add('etat',ChoiceType::class,
                array(
                'choices' => array(
                    'en cour'    => 'en cour',
                    'livrée' => 'livrée',
                    'prepare' => 'prepare',
                )))
            ->add('Livreure',EntityType::class, array(
            'class'=>'LivraisonBundle:Livreure',
            'choice_label'=>'nomliv',
            ))
            ->add('commande')
            ->add('client')
            ->add('save',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LivraisonBundle\Entity\Livraison'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'livraisonbundle_livraison';
    }


}
