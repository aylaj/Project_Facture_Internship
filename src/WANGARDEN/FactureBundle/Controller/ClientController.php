<?php
namespace WANGARDEN\FactureBundle\Controller;

use WANGARDEN\FactureBundle\Entity\Client;
use WANGARDEN\FactureBundle\Entity\Produit;
use WANGARDEN\FactureBundle\Entity\Facture;
use WANGARDEN\FactureBundle\FactureProduit;
use WANGARDEN\FactureBundle\Form\ClientType;
use WANGARDEN\FactureBundle\Form\ClientEditType;
use WANGARDEN\FactureBundle\Form\ProduitClient\Produitclient;
use WANGARDEN\FactureBundle\Form\Recherche\Rechercheclient;
use Symfony\Bundle\FrameworkBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;

class ClientController extends Controller
{
    public function createAction(Request $request)
    {
        $client= new Client;
        //recuperer le formulaire
        $form = $this->createForm(ClientType::class, $client);

        if ($form->handleRequest($request)->isValid()) {
            if ($form->isSubmitted()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($client);
                $em->flush();
                //return new Response('Client ajouté!');
                return $this->redirectToRoute('wangarden_facture_client_index');
            }
        }

        // generer le html
        $formView = $form->CreateView();
        //rendre la vue
        return $this->render(
            'WANGARDENFactureBundle:Facture/Client:addclient.html.twig',
            array('form'=>$formView)
            );
    }

    public function indexAction(Request $request)
    {
        $form=$this->createForm(Rechercheclient::class);
        $formView = $form->CreateView();

        $form->handleRequest($request);
        /*var_dump($form);
        exit();*/
        if ($request->isMethod('POST')&& $form->isValid()) {
            $data = $form->getData();
        } else {
            $data = array();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $clients = $entityManager->getRepository(Client::class)
            ->findClientBy($data);

        return $this->render(
            'WANGARDENFactureBundle:Facture/Client:listeclient.html.twig',
            array('client'=>$clients,'form'=>$formView)
            );
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('WANGARDENFactureBundle:Client')->find($id);
        if (null === $client) {
            throw new NotFoundHttpException("Client d'id ".$id." n'existe pas.");
        }
        $form = $this->get('form.factory')->create(ClientType::class, $client);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag();
            return $this->redirectToRoute('wangarden_facture_client_index');
        }

        return $this->render(
            'WANGARDENFactureBundle:Facture/Client:editclient.html.twig',
          array('client' => $client,'form'   => $form->createView()
          )
        );
    }

    public function deleteAction($id, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $client=$em->getRepository('WANGARDENFactureBundle:Client')->find($id);
        if (null===$client) {
            throw new NotFoundHttpException("Le client d". $id. "n_existe pas");
        }
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form=$this->get('form.factory')->create();
        if ($request->isMethod('post') && $form->handleRequest($request)->isValid()) {
            $em->remove($client);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', 'le client a bien été supprimé');
            return $this->redirectToRoute('wangarden_facture_client_index');
        }

        return $this->render(
            'WANGARDENFactureBundle:Facture/Client:deleteclient.html.twig',
         array(
    'client' => $client, 'form'   => $form->createView(),
  )
        );
    }

    public function produitClientAction(Request $request)
    {
        $forms=$this->createForm(Produitclient::class);
        $formsView=$forms->createView();
        $client= new Client();
        $form=$this->createForm(ClientType::class, $client);
        if ($form->handleRequest($request)->isValid()) {
            if ($form->isSubmitted()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($client);
                $em->flush();
                //rederiger vers la page d'ajout
                return $this->redirectToRoute('wangarden_facture_client_produitclient');
            }
        }
        $formView=$form->createView();

        return $this->render('WANGARDENFactureBundle:Facture/Client:produitclient.html.twig', array('form'=>$formView, 'forms'=>$formsView
      ));
    }

    public function addClientAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
        }
    }
}
