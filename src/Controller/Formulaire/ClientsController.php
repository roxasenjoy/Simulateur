<?php

namespace App\Controller\Formulaire;

use App\Entity\Clients;
use App\Form\ClientsType;
use App\Repository\ClientsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client")
 */
class ClientsController extends AbstractController
{

//    /**
//     * @Route("/index", name="clients_index", methods={"GET"})
//     */
//    public function index(ClientsRepository $clientsRepository): Response
//    {
//        return $this->redirectToRoute('home');/* Page de résultat */
//    }

    /**
     * @Route("/", name="clients_new", methods={"GET","POST"})
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function new(Request $request, SessionInterface $session): Response
    {
        if($session->has('client')){
            $client = $session->get('client');
        }else{
            return $this->redirectToRoute("situations_new");
        }

        //Formulaire client
        $form = $this->createForm(ClientsType::class, $client, ['step' => 5, 'validation_groups' => ['clients']]);

        if($request->isMethod('POST')){
            $data = $request->request->all();
            $form->submit($data, false); // ClearMissing -> Entity manquantes = vidé
            if ($form->isSubmitted() && $form->isValid()) {
                if($request->request->get('verificationCode') === null){
                    if ( $request->request->get('telephonePays') ) {

                        $authy_api = new \Authy\AuthyApi( getenv('TWILIO_AUTHY_API_KEY') ); // Récupère l'API
                        $user      = $authy_api->registerUser($request->request->get('email'), $request->request->get('telephone'), $request->request->get('telephonePays') ); // Récupère les valeurs où envoyer un message.

                        if ( $user->ok() ) {
                            // ERREURS POSSIBLES :
                            //      - Trop d'essaie pour l'application donc refuser directement
                            //      - Le montant quotidient est fini :D

                            $sms = $authy_api->requestSms( $user->id(), [ "force" => "true" ] );
                            # dd($sms);  // ( "DoS protection: User has requested too many tokens in the last hour.")
                            if ( $sms->ok() ) {
                                $this->addFlash(
                                    'success',
                                    'Votre code de vérification vient d\'être envoyé'
                                );
                            }

                            $user_params = [
                                'prenom' => $request->request->get('prenom'),
                                'email' => $request->request->get('email'),
                                'nom' => $request->request->get('nom'),
                                'codePostal' => $request->request->get('codePostal'),
                                'telephone' => $request->request->get('telephone'),
                                'authy_id' => $user->id(),
                            ];

                            $session->set('user', $user_params);

                        }
                    }
                    return $this->redirectToRoute('verify_page');

                }else{
                    return $this->redirectToRoute('validationClient');
                }

            }else{
                $this->addFlash('error', 'Vous n\'avez pas répondu correctement à tous les champs, merci de bien vouloir vérifier.');
            }


        }

        return $this->render('clients/new.html.twig', [
            'form' => $form->createView(),
        ]);

    }

//    /**
//     * @Route("/{id}", name="clients_show", methods={"GET"})
//     */
//    public function show(Clients $client): Response
//    {
//        return $this->render('clients/show.html.twig', [
//            'client' => $client,
//        ]);
//    }
//
//    /**
//     * @Route("/{id}/edit", name="clients_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, Clients $client): Response
//    {
//        $form = $this->createForm(ClientsType::class, $client);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('clients_index');
//        }
//
//        return $this->render('clients/edit.html.twig', [
//            'client' => $client,
//            'form' => $form->createView(),
//        ]);
//    }
//
//    /**
//     * @Route("/{id}", name="clients_delete", methods={"DELETE"})
//     */
//    public function delete(Request $request, Clients $client): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($client);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('clients_index');
//    }
}
