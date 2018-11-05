<?php


namespace WANGARDEN\FactureBundle\Controller;

use WANGARDEN\FactureBundle\Entity\Client;
use WANGARDEN\FactureBundle\Entity\Produit;
use WANGARDEN\FactureBundle\Entity\Facture;
use WANGARDEN\FactureBundle\Entity\FactureProduit;
use WANGARDEN\FactureBundle\Form\FactureProduitType;
use Symfony\Bundle\FrameworkBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FactureproduitController extends Controller
{
    public function editerAction(Request $request)
    {

  //creer le client
        $fp= new FactureProduit;
        //recuperer le formulaire
        $form = $this->createForm(FactureProduitType::class, $fp);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fp);
            $em->persist($produit->getProduit());
            $em->flush();

            return new Response('REPONSE FACTURE');
            //return $this->redirectToRoute('wangarden_facture_client_index');
        }

        // generer le html
        $formView = $form->CreateView();
        //rendre la vue

        return $this->render(
      'WANGARDENFactureBundle:Facture/Factureproduit:Editerfacture.html.twig',
  array('form'=>$formView)
  );
    }

    public function indexAction()
    {
    }

    public function editAction()
    {
    }
    public function deleteAction()
    {
    }
}
