<?php
// src/AppBundle/Form/RegistrationType.php

namespace WANGARDEN\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationType extends AbstractType
{
  //  private $roles =array(0=>'ROLE_USER',1=>'ROLE_ADMIN',2=>'ROLE_COMPTABLE');
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName')
                ->add('lastName')
                ->add('roles',ChoiceType::class,array('expanded'=>false, 'multiple' => true,'choices'=>array('user'=>'ROLE_USER','admin'=>'ROLE_ADMIN','comptable'=>'ROLE_COMPTABLE')));

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }







  /*  public function getName()
    {
        eturn $this->getBlockPrefix();
    }*/
}
