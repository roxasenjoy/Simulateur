<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->CreateForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $userContact = $form->getData();
            $message = (new \Swift_Message('SUPINVEST | ' . $userContact['object']))
                ->setFrom($userContact['email'])
                ->setTo('andrew.mahe14@gmail.com') // Mettre l'email où l'endroit pour envoyer le message.
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig', compact('userContact')
                    ),
                    'text/html'
                )
            ;

            //Envoie du message
            $mailer->send($message);
            $this->addFlash('message', 'Le message a bien été envoyé');
            return $this->redirectToRoute('home'); /* Redirige vers la même page sans le formulaire */

        }

        return $this->render('home.html.twig', [
            'contactForm'    => $form->createView()
        ]);
    }
}
