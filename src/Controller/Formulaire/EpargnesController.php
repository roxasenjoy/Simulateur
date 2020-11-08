<?php

namespace App\Controller\Formulaire;

use App\Entity\Epargnes;
use App\Form\ClientsType;
use App\Form\EpargnesType;
use App\Repository\EpargnesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/epargnes")
 */
class EpargnesController extends AbstractController
{
//    /**
//     * @Route("/index", name="epargnes_index", methods={"GET"})
//     */
//    public function index(EpargnesRepository $epargnesRepository): Response
//    {
//        return $this->redirectToRoute('objectifs_new');
//    }

    /**
     * @Route("/", name="epargnes_new", methods={"GET","POST"})
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
        $form = $this->createForm(ClientsType::class, $client, ['step' => 3, 'validation_groups' => ['epargnes']]);

        if($request->isMethod("POST")){
            $data = $request->request->all();
            $form->submit($data, false); // ClearMissing -> Entity manquantes = vidé
            if ($form->isSubmitted() && $form->isValid()) {
                $session->set('client', $client);
                return $this->redirectToRoute('objectifs_new');
            }else{
                $this->addFlash('error', 'Vous n\'avez pas répondu correctement à toutes les questions, veuillez vérifier.');
            }
        }
        return $this->render('epargnes/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="epargnes_show", methods={"GET"})
//     */
//    public function show(Epargnes $epargne): Response
//    {
//        return $this->render('epargnes/show.html.twig', [
//            'epargne' => $epargne,
//        ]);
//    }
//
//    /**
//     * @Route("/{id}/edit", name="epargnes_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, Epargnes $epargne): Response
//    {
//        $form = $this->createForm(EpargnesType::class, $epargne);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('epargnes_index');
//        }
//
//        return $this->render('epargnes/edit.html.twig', [
//            'epargne' => $epargne,
//            'form' => $form->createView(),
//        ]);
//    }
//
//    /**
//     * @Route("/{id}", name="epargnes_delete", methods={"DELETE"})
//     */
//    public function delete(Request $request, Epargnes $epargne): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$epargne->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($epargne);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('epargnes_index');
//    }
}
