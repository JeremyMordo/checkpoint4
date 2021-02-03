<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\ContactType;
use App\Service\ContactEmail;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, ContactEmail $mail): Response
    {

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $mail->send(
                "Nouvel email de contact",
                $data['email'],
                "emailorators@gmail.com",
                "home/template/contact.html.twig",
                [
                "name" => $data['name'],
                "email" => $data['email'],
                "message" => $data['message'],
                ],
            );
            return $this->redirectToRoute('home');
        }
        return $this->render('home/contact.html.twig', ['form' => $form->createView()]);
    }
}
