<?php
namespace WANGARDEN\FactureBundle\Controller;

use WANGARDEN\FactureBundle\Entity\Client;
use WANGARDEN\FactureBundle\Entity\Produit;
use WANGARDEN\FactureBundle\Entity\Facture;
use WANGARDEN\FactureBundle\Entity\FactureProduit;
use WANGARDEN\FactureBundle\Form\ClientType;
use WANGARDEN\FactureBundle\Form\FactureType;
use WANGARDEN\FactureBundle\Form\FactureProduitType;
use WANGARDEN\FactureBundle\Form\ProduitClient\Produitclient;
use WANGARDEN\FactureBundle\Form\Recherche\Recherchefacture;
use Symfony\Bundle\FrameworkBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class FactureController extends Controller
{
    /**
     * @Security("has_role('ROLE_ADMIN')")
     */

    public function viewAction(Request $request, $id)
    {
        $entityManager=$this->getDoctrine()->getManager();

        $facture =$entityManager->getRepository(Facture::class)
            ->find($id);

        $client =$facture->getClient()->getNom();


        $produitsFacture = $entityManager->getRepository(FactureProduit::class)
            ->findBy(array('Facture'=>$id));

        foreach ($produitsFacture as $facture) {

           $facture->getFacture()->getClient()->getNom();
        }
        $facture=$produitsFacture->getProduit();




        return $this->render(
            'WANGARDENFactureBundle:Facture/Factures:facture.html.twig',
            array('facture'=>$facture,
                'client'=>$client,
                'produits'=>$produitsFacture)
        );
    }


    public function indexAction(Request $request)
    {
        $formListeFacture=$this->createForm(Recherchefacture::class);
        $formListeFactureView=$formListeFacture->CreateView();
        $formListeFacture->handleRequest($request);
        if ($request->isMethod('Post')&& $formListeFacture->isValid()) {
            $data=$formListeFacture->getData();
        } else {
            $data=array();
        }
        $entityManager=$this->getDoctrine()->getManager();
        $facture= $entityManager->getRepository(Facture::class)
            ->findFactureBy($data);
        $prenom=array();
        $prenoms=array();
        foreach ($facture as $key=>$value)
            {
            $prenom=$value->getClient()->getPrenom();
            if(is_array($prenoms) )
            $prenoms[]=$prenom;
        }
        var_dump(($prenoms));


        return $this->render('WANGARDENFactureBundle:Facture/Factures:listefactures.html.twig', array(
        'facture'=>$facture,'formListeFacture'=>$formListeFactureView
      ));
    }

    public function SelectProduitClientAction(Request $request)
    {
        // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux admins.');
        }

        $em = $this->getDoctrine()->getManager();

        $facture=new Facture();
        $client=new Client;

        $formClient = $this->createForm(ClientType::class, $client);
        $formViewClient = $formClient->createView();

        $formClient->handleRequest($request);
        if ($formClient->isSubmitted() && $formClient->isValid()) {
            $em->persist($client);
            $em->flush();
        }

        $formFacture=$this->createForm(FactureType::class, $facture);
        $formViewFacture = $formFacture->createView();

        $formFacture->handleRequest($request);
        if ($formFacture->isSubmitted() && $formFacture->isValid()) {
            $montant = 0;
            $listeProduitFacture =$facture->getFacturesptoduits();
            foreach ($listeProduitFacture as $key => $produitFacture) {
                $montant += $produitFacture->getMontant();
                $produitFacture->setFacture($facture);
            }

            $facture->setMontant($montant);
            $facture->setDate(new \DateTime);

            $em->persist($facture);
            $em->flush();


            return $this->redirectToRoute('wangarden_facture_client_index');
        }

        return $this->render(
            'WANGARDENFactureBundle:Facture/Client:facture.html.twig',
        array('formClient'=>$formViewClient,'formFacture'=>$formViewFacture
  )
        );
    }
}
