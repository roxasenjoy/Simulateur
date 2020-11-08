<?php

namespace App\Controller\Formulaire;

use App\Entity\Credits;
use App\Form\CreditsType;
use App\Repository\CreditsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/credits")
 */
class CreditsController extends AbstractController
{
    /**
     * @Route("/", name="credits_index", methods={"GET"})
     */
    public function index(CreditsRepository $creditsRepository): Response
    {
        return $this->render('credits/index.html.twig', [
            'credits' => $creditsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="credits_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $credit = new Credits();
        $form = $this->createForm(CreditsType::class, $credit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($credit);
            $entityManager->flush();

            return $this->redirectToRoute('credits_index');
        }

        return $this->render('credits/new.html.twig', [
            'credit' => $credit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="credits_show", methods={"GET"})
     */
    public function show(Credits $credit): Response
    {
        return $this->render('credits/show.html.twig', [
            'credit' => $credit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="credits_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Credits $credit): Response
    {
        $form = $this->createForm(CreditsType::class, $credit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('credits_index');
        }

        return $this->render('credits/edit.html.twig', [
            'credit' => $credit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="credits_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Credits $credit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$credit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($credit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('credits_index');
    }
}
