<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact/', name: 'contact_index')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'website' => 'Contact',
        ]);
    }
}
