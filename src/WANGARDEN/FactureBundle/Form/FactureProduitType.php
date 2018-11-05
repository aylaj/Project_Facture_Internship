<?php

namespace WANGARDEN\FactureBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use WANGARDEN\FactureBundle\Form\ProduitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use WANGARDEN\FactureBundle\Form\FactureProduitType;
use WANGARDEN\FactureBundle\Entity\Produit;

class FactureProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('produit', EntityType::class, array(
          'class'=>'WANGARDEN\FactureBundle\Entity\Produit',
          'label'=>'Libelle',
          'choice_label' =>function ($produit) {
              return $produit->getLibelle();
          },
          'choice_attr' => function ($produit) {
              return array('prix'=>$produit->getPrix());
          }
        ))

      //  ->add('produit', ProduitType::class)
        ->add('quantite', TextType::class)
        ->add('montant', TextType::class)
      
      ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WANGARDEN\FactureBundle\Entity\FactureProduit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'wangarden_facturebundle_factureproduit';
    }
}
