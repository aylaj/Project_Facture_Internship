<?php
namespace WANGARDEN\FactureBundle\Controller;

use WANGARDEN\FactureBundle\Entity\Client;
use WANGARDEN\FactureBundle\Entity\Produit;
use WANGARDEN\FactureBundle\Entity\Facture;
use WANGARDEN\FactureBundle\Entity\FactureProduit;
use WANGARDEN\FactureBundle\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProduitController extends Controller
{
    public function createAction(Request $request)
    {

  //creer le produit
        $produit= new Produit;
        //recuperer le formulaire
        $form = $this->createForm(ProduitType::class, $produit);

        if ($form->handleRequest($request)->isValid()) {
            if ($form->isSubmitted()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($produit);
                $em->flush();

                //return new Response('produit ajouté!');
                return $this->redirectToRoute('wangarden_facture_produit_index');
            }
        }
        // generer le html
        $formView = $form->CreateView();
        //rendre la vue
        return $this->render(
      'WANGARDENFactureBundle:Facture/Produit:addproduit.html.twig',
  array('form'=>$formView)
  );
    }

    public function indexAction()
    {
        $produit=$this->getDoctrine()->getRepository('WANGARDENFactureBundle:Produit')->findAll();
        return $this->render('WANGARDENFactureBundle:Facture/Produit:listeproduit.html.twig', array('produit'=>$produit));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('WANGARDENFactureBundle:Client')->find($id);
        if (null === $produit) {
            throw new NotFoundHttpException("Produit d'id ".$id." n'existe pas.");
        }
        $form = $this->get('form.factory')->create(ClientType::class, $produit);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag();
            return $this->redirectToRoute('wangarden_facture_produit_index');
        }

        return $this->render('WANGARDENFactureBundle:Facture/Produit:editproduit.html.twig', array(
  'produit' => $produit,
  'form'   => $form->createView()
));
    }

    public function deleteAction($id, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository('WANGARDENFactureBundle:Produit')->find($id);
        if (null===$produit) {
            throw new NotFoundHttpException("Le produit d". $id. "n_existe pas");
        }
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form=$this->get('form.factory')->create();
        if ($request->isMethod('post') && $form->handleRequest($request)->isValid()) {
            $em->remove($produit);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', 'le produit a bien été supprimé');
            return $this->redirectToRoute('wangarden_facture_produit_index');
        }

        return $this->render('WANGARDENFactureBundle:Facture/Produit:deleteproduit.html.twig', array(
    'produit' => $produit, 'form'   => $form->createView(),
  ));
    }
}
