<?php

namespace App\Twig\Components;

use App\Repository\ProjectRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Navbar
{
    public function __construct(
        private ProjectRepository $projectRepository
    ) {
    }

    public function getProjects(): array
    {
        return $this->projectRepository->findBy([], ['name' => 'ASC']);
    }
}
