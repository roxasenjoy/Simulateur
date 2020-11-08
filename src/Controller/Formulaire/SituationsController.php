<?php

namespace App\Controller\Formulaire;

use App\Entity\Clients;
use App\Entity\Investissements;
use App\Entity\Situations;
use App\Form\SituationsType;
use App\Repository\SituationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ClientsType;


/**
 * @Route("/situations")
 */
class SituationsController extends AbstractController
{

//    /**
//     * @Route("/index", name="situations_index", methods={"GET"})
//     */
//
//    public function index(SituationsRepository $situationsRepository): Response
//    {
//
//        return $this->redirectToRoute('patrimoines_new');
//    }

    /**
     * @Route("/", name="situations_new", methods={"GET","POST"})
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function new(Request $request, SessionInterface $session): Response
    {

        if($session->has('client')){
            $client = $session->get('client');

        }else{
            $client = new Clients();
        }

        $form = $this->createForm(ClientsType::class, $client, ['step' => 1, 'validation_groups' => ['situations']]); /*Créer le formulaire */

        if($request->isMethod("POST")){
            $data = $request->request->all();
            $form->submit($data, false); // ClearMissing -> Entity manquantes = vidé
            if ($form->isSubmitted() && $form->isValid()) { /* Vérifie si il est valide*/
                $session->set('client', $client);
                return $this->redirectToRoute('patrimoines_new');
            }else{
                $this->addFlash('error', 'Vous n\'avez pas répondu correctement à toutes les questions, veuillez vérifier.');
            }
        }





        return $this->render('situations/new.html.twig', [
            'form' => $form->createView(),
        ]);

    }

//    /**
//     * @Route("/{id}", name="situations_show", methods={"GET"})
//     */
//    public function show(Situations $situation): Response
//    {
//        return $this->render('situations/show.html.twig', [
//            'situation' => $situation,
//        ]);
//    }
//
//    /**
//     * @Route("/{id}/edit", name="situations_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, Situations $situation): Response
//    {
//        $form = $this->createForm(SituationsType::class, $situation);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('situations_index');
//        }
//
//        return $this->render('situations/edit.html.twig', [
//            'situation' => $situation,
//            'form' => $form->createView(),
//        ]);
//    }
//
//    /**
//     * @Route("/{id}", name="situations_delete", methods={"DELETE"})
//     */
//    public function delete(Request $request, Situations $situation): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$situation->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($situation);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('situations_index');
//    }
}
