<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/portfolio', name: 'portfolio_')]
class PortfolioController extends AbstractController
{
    #[Route('/', name: 'index')]
    #[Route('/{activityId<\d+>?}', name: 'index_with_activity')]
    public function index(?int $activityId, ProjectRepository $projectRepository): Response
    {
        if ($activityId) {
            $projects = $projectRepository->findByActivityId($activityId);
        } else {
            $projects = $projectRepository->findAll();
        }

        return $this->render('portfolio/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route('/project/{id<\d+>}', name: 'show')]
    public function show(Project $project): Response
    {
        return $this->render('portfolio/show.html.twig', [
            'project' => $project,
        ]);
    }
}
