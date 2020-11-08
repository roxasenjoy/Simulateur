<?php

namespace App\Controller\Formulaire;

use App\Entity\Objectifs;
use App\Form\ClientsType;
use App\Form\ObjectifsType;
use App\Repository\ObjectifsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/objectifs")
 */
class ObjectifsController extends AbstractController
{
//    /**
//     * @Route("/index", name="objectifs_index", methods={"GET"})
//     */
//    public function index(ObjectifsRepository $objectifsRepository): Response
//    {
//        return $this->redirectToRoute('clients_new');
//    }

    /**
     * @Route("/", name="objectifs_new", methods={"GET","POST"})
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function new(Request $request, SessionInterface $session): Response
    {
        if($session->has('client')){
            $client = $session->get('client');
        }else{
            return $this->redirectToRoute('situations_new');
        }
        $form = $this->createForm(ClientsType::class, $client, ["step" => 4, 'validation_groups' => ['objectifs']]);


        if($request->isMethod('POST')){
            $data = $request->request->all();
            $form->submit($data, false); // ClearMissing -> Entity manquantes = vidé
            if ($form->isSubmitted() && $form->isValid()) {
                $session->set('client', $client);
                return $this->redirectToRoute('clients_new');
            }else{
                $this->addFlash('error', 'Vous n\'avez pas répondu correctement à toutes les questions, veuillez vérifier.');
            }
        }


        return $this->render('objectifs/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="objectifs_show", methods={"GET"})
//     */
//    public function show(Objectifs $objectif): Response
//    {
//        return $this->render('objectifs/show.html.twig', [
//            'objectif' => $objectif,
//        ]);
//    }
//
//    /**
//     * @Route("/{id}/edit", name="objectifs_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, Objectifs $objectif): Response
//    {
//        $form = $this->createForm(ObjectifsType::class, $objectif);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('objectifs_index');
//        }
//
//        return $this->render('objectifs/edit.html.twig', [
//            'objectif' => $objectif,
//            'form' => $form->createView(),
//        ]);
//    }
//
//    /**
//     * @Route("/{id}", name="objectifs_delete", methods={"DELETE"})
//     */
//    public function delete(Request $request, Objectifs $objectif): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$objectif->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($objectif);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('objectifs_index');
//    }
}
