<?php

namespace WANGARDEN\FactureBundle\Form;

use WANGARDEN\FactureBundle\Form\FactureProduitType;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Form\Type\FactureType as Factrue;
use Symfony\Bridge\Doctrine\Form\Type\ProduitFactureType;
use WANGARDEN\FactureBundle\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FactureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

          ->add('Client', EntityType::class, array(
          'class' => 'WANGARDEN\FactureBundle\Entity\Client',
          'label' => 'facture.entity.client',
          'choice_label' => function ($client) {
              return $client->getNom().' '.$client->getPrenom();
          },
            'multiple'  => false
            ))

          ->add('facturesptoduits', CollectionType::class, array(
            'entry_type'   => FactureProduitType::class,
            'allow_add'    => true,
            'allow_delete' => true,
            ))
        //->add('save', SubmitType::class)
          ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WANGARDEN\FactureBundle\Entity\Facture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'wangarden_facturebundle_facture';
    }
}
