<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CurriculumController extends AbstractController
{
    #[Route('/cv/', name: 'cv_index')]
    public function index(): Response
    {
        return $this->render('curriculum/index.html.twig', [
            'website' => 'Curriculum',
        ]);
    }
}
