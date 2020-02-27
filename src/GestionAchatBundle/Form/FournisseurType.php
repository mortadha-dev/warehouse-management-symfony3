<?php

namespace GestionAchatBundle\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsFalseValidator;

class FournisseurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('code')
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('ville')
            ->add('pays')
            ->add('adresseEmail')
            ->add('rapidite', ChoiceType::class, [
                'choices'  => [
                    'rapide' => "rapide",
                    'normal' => "normal"
                ]])
            ->add('enregistrer',SubmitType::class,[
                'attr' => ['formnovalidate ' => 'formnovalidate']
            ])

        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GestionAchatBundle\Entity\Fournisseur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gestionachatbundle_fournisseur';
    }


}
