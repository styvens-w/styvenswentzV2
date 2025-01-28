<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/contact', name: 'contact')]
class ContactController extends AbstractController
{
    #[Route('/', name: '_index', methods: ['GET', 'POST'])]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new Email())
                ->from($this->getParameter('mailer_formulaire'))
                ->to($this->getParameter('mailer_user'))
                ->subject('Formulaire de contact : ' . $contact->subject)
                ->html($this->renderView('contact/newEmail.html.twig', ['contact' => $contact]));

            $mailer->send($email);

            $email2 = (new Email())
                ->from($this->getParameter('mailer_noreply'))
                ->to($contact->email)
                ->subject('Message envoyé : ' . $contact->subject)
                ->html($this->renderView('contact/autoEmail.html.twig', ['contact' => $contact]));

            $mailer->send($email2);

            $this->addFlash('success', 'Votre message a été envoyé avec succès ! Une réponse vous sera apportée sous 48h (jours ouvrables).');

            return $this->redirectToRoute('app_index');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form,
        ]);
    }
}
