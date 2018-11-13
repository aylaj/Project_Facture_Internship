<?php

namespace WANGARDEN\FactureBundle\Controller;

use WANGARDEN\FactureBundle\Entity\Client;
use WANGARDEN\FactureBundle\Entity\Produit;
use WANGARDEN\FactureBundle\Entity\Facture;
use WANGARDEN\FactureBundle\FactureProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class FactController extends Controller
{
  /**
   * @Security("has_role('ROLE_ADMIN')")
   */

public function indexAction() {

//  var_dump($this->getUser());
//  var_dump($this->getUser()->isCredentialsNonExpired());

    return $this->render('WANGARDENFactureBundle:Facture:index.html.twig');
  }

}


 ?>
