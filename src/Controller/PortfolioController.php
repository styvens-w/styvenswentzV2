<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/portfolio', name: 'portfolio_')]
class PortfolioController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('portfolio/index.html.twig', [
            'website' => 'Portfolio',
        ]);
    }

    #[Route('/{id<\d+>}', name: 'show', methods: ['GET'])]
    public function show(int $id): Response
    {
        $portfolioItem = $id;

        return $this->render('portfolio/show.html.twig', [
            'portfolioItem' => $portfolioItem,
        ]);
    }
}
