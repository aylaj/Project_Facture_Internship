<?php

namespace WANGARDEN\FactureBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientEditType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {



    }

    public function getParent()

  {
    return ClientType::class;
  }

}
