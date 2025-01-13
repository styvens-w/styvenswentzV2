<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\Picture;
use App\Entity\Project;
use App\Entity\Techno;
use App\Form\ActivityType;
use App\Form\PictureType;
use App\Form\ProjectType;
use App\Form\TechnoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'website' => 'Administration',
        ]);
    }

    #[Route('/newActivity', name: 'newActivity')]
    public function newActivity(Request $request, EntityManagerInterface $entityManager): Response
    {
        $activity = new Activity();

        $form = $this->createForm(ActivityType::class, $activity);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->persist($activity);
            $entityManager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/new.html.twig', [
            'form' => $form,
            'title' => 'Ajouter une activité',
        ]);
    }

    #[Route('/newProject', name: 'newProject')]
    public function newProject(Request $request, EntityManagerInterface $entityManager): Response
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/new.html.twig', [
            'form' => $form,
            'title' => 'Ajouter un projet',
        ]);
    }

    #[Route('/newPicture', name: 'newPicture')]
    public function newPicture(Request $request, EntityManagerInterface $entityManager): Response
    {
        $picture = new Picture();

        $form = $this->createForm(PictureType::class, $picture);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->persist($picture);
            $entityManager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/new.html.twig', [
            'form' => $form,
            'title' => 'Ajouter une image à un projet',
        ]);
    }

    #[Route('/newTechno', name: 'newTechno')]
    public function newTechno(Request $request, EntityManagerInterface $entityManager): Response
    {
        $techno = new Techno();

        $form = $this->createForm(TechnoType::class, $techno);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->persist($techno);
            $entityManager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/new.html.twig', [
            'form' => $form,
            'title' => 'Ajouter une technologie',
        ]);
    }
}
