<?php

namespace App\Controller\Formulaire;

use App\Entity\Investissements;
use App\Entity\Patrimoines;
use App\Form\ClientsType;
use App\Form\PatrimoinesType;
use App\Repository\PatrimoinesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/patrimoines")
 */
class PatrimoinesController extends AbstractController
{
//    /**
//     * @Route("/index", name="patrimoines_index", methods={"GET"})
//     */
//    public function index(PatrimoinesRepository $patrimoinesRepository): Response
//    {
//        return $this->redirectToRoute('epargnes_new');
//    }

    /**
     * @Route("/", name="patrimoines_new", methods={"GET","POST"})
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function new(Request $request, SessionInterface $session): Response /* L'utilisateur arrive ici après la validation de son formulaire Situation*/
    {

        if($session->has('client')){
            $client = $session->get('client');
        }else{
            return $this->redirectToRoute('situations_new');
        }

        $form = $this->createForm(ClientsType::class, $client, ['step' => 2, 'validation_groups' => ['patrimoines']]); /* Créer le formulaire PATRIMOINE*/

        if($request->isMethod("POST")){
            $data = $request->request->all();
            $form->submit($data, false); // ClearMissing -> Entity manquantes = vidé

            if ($form->isSubmitted() && $form->isValid()) {
                $session->set('client', $client);
                return $this->redirectToRoute('epargnes_new');
            }else{
                $this->addFlash('error', 'Vous n\'avez pas répondu correctement à toutes les questions, veuillez vérifier.');
            }

        }

        return $this->render('patrimoines/new.html.twig', [
            'form' => $form->createView(),
        ]);

    }

//    /**
//     * @Route("/{id}", name="patrimoines_show", methods={"GET"})
//     */
//    public function show(Patrimoines $patrimoine): Response
//    {
//        return $this->render('patrimoines/show.html.twig', [
//            'patrimoine' => $patrimoine,
//        ]);
//    }
//
//    /**
//     * @Route("/{id}/edit", name="patrimoines_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, Patrimoines $patrimoine): Response
//    {
//        $form = $this->createForm(PatrimoinesType::class, $patrimoine);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('patrimoines_index');
//        }
//
//        return $this->render('patrimoines/edit.html.twig', [
//            'patrimoine' => $patrimoine,
//            'form' => $form->createView(),
//        ]);
//    }
//
//    /**
//     * @Route("/{id}", name="patrimoines_delete", methods={"DELETE"})
//     */
//    public function delete(Request $request, Patrimoines $patrimoine): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$patrimoine->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($patrimoine);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('patrimoines_index');
//    }
}
