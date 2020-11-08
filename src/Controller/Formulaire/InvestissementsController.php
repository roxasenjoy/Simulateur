<?php

namespace App\Controller\Formulaire;

use App\Entity\Investissements;
use App\Form\InvestissementsType;
use App\Repository\InvestissementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/investissements")
 */
class InvestissementsController extends AbstractController
{
    /**
     * @Route("/", name="investissements_index", methods={"GET"})
     */
    public function index(InvestissementsRepository $investissementsRepository): Response
    {
        return $this->render('investissements/index.html.twig', [
            'investissements' => $investissementsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="investissements_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $investissement = new Investissements();
        $form = $this->createForm(InvestissementsType::class, $investissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($investissement);
            $entityManager->flush();

            return $this->redirectToRoute('investissements_index');
        }

        return $this->render('investissements/new.html.twig', [
            'investissement' => $investissement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="investissements_show", methods={"GET"})
     */
    public function show(Investissements $investissement): Response
    {
        return $this->render('investissements/show.html.twig', [
            'investissement' => $investissement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="investissements_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Investissements $investissement): Response
    {
        $form = $this->createForm(InvestissementsType::class, $investissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('investissements_index');
        }

        return $this->render('investissements/edit.html.twig', [
            'investissement' => $investissement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="investissements_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Investissements $investissement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$investissement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($investissement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('investissements_index');
    }
}
