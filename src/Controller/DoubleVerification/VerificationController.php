<?php

namespace App\Controller\DoubleVerification;

use App\Entity\Clients;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class VerificationController extends AbstractController
{
    /**
     * @Route("/verification", name="verify_page", )
     */
    public function verifyCodePage()
    {
        return $this->render('verification/index.html.twig');
    }


    /**
     * @Route("/verify/code", name="verify_code")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function verifyCode(Request $request, UserPasswordEncoderInterface $encoder, SessionInterface $session)
    {

        /* Vérifie si le code est correct */
        try {
            // Get data from session
            $data = $session->get('user');

            $authy_api    = new \Authy\AuthyApi( getenv('TWILIO_AUTHY_API_KEY') );
            $verification = $authy_api->verifyToken( $data['authy_id'], $request->query->get('verify_code'));

            if ($verification->ok()){
                return $this->redirectToRoute('validationClient');
            }

            return $this->redirectToRoute('verify_page');



        } catch (\Exception $exception) {
            $this->addFlash(
                'error',
                'Votre code de vérification n\'est pas valide.'
            );
            return $this->redirectToRoute('verify_page');
        }
    }


    /**
     * @Route("/validation", name="validationClient")
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function saveUser(SessionInterface $session)
    {
        if($session->has('client')){
            $client = $session->get('client');
        }else{
            return $this->redirectToRoute("situations_new");
        }

        $this->addFlash(
            'success',
            'Votre code de vérification est valide. '
        );


        // save user
        $client->setVerificationCode(true);
        $session->set('client', $client);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($client);
        $entityManager->flush();


        return $this->redirectToRoute('resultat');
    }
}
