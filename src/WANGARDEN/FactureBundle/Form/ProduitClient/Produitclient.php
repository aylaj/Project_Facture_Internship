<?php
namespace WANGARDEN\FactureBundle\Form\ProduitClient;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Form\Type\FactureType;
use Symfony\Bridge\Doctrine\Form\Type\ProduitFactureType;
use WANGARDEN\FactureBundle\Entity\Client;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Produitclient extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Client_Enregistres', EntityType::class, array(
          'class' => 'WANGARDEN\FactureBundle\Entity\Client',
          'label' => 'facture.entity.client',
          'choice_label' => function ($client) {
              return $client->getNom().' '.$client->getPrenom();
          },
            'multiple'  => false
          ))
          ->add('produits', CollectionType::class, array(
            'entry_type'=>ProduitFactureType::class,
            'allow_add'=>true,
            'allow_delete'=>true,
            'prototype' => true,

          ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(

            'data_class' => null
        ));
    }
}
