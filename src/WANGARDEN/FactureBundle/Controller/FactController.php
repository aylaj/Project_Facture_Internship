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

class FactController extends Controller
{


public function indexAction() {


    $content = $this->render('WANGARDENFactureBundle:Facture:index.html.twig');
   return new Response($content);

  }





}


 ?>
