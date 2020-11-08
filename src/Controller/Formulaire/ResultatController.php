<?php

namespace App\Controller\Formulaire;

use App\Service\Calculator2020;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ResultatController extends AbstractController
{
    
    /**
     * @Route("/resultat", name="resultat")
     * @param SessionInterface $session
     */
    public function index( SessionInterface $session)
    {
        if($session->has('client') && $session->get('client')->getVerificationCode(true)){
            $client = $session->get('client');
        }else{
            return $this->redirectToRoute("situations_new");
        }

        $calculator = new Calculator2020($client);

        return $this->render('resultat/resultat.html.twig', [
            'calculator' => $calculator
        ]);
    }




}
