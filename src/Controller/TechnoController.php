<?php

namespace App\Controller;

use App\Entity\Techno;
use App\Form\TechnoType;
use App\Repository\TechnoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('admin/techno')]
final class TechnoController extends AbstractController
{
    #[Route(name: 'app_techno_index', methods: ['GET'])]
    public function index(TechnoRepository $technoRepository): Response
    {
        return $this->render('admin/techno/index.html.twig', [
            'technos' => $technoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_techno_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $techno = new Techno();
        $form = $this->createForm(TechnoType::class, $techno);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $slug = $slugger->slug($techno->getName());
            $techno->setSlug($slug);

            if ($form->isValid()) {
                $entityManager->persist($techno);
                $entityManager->flush();

                $this->addFlash('success', 'La technologie a bien été ajoutée.');

                return $this->redirectToRoute('app_techno_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('admin/techno/new.html.twig', [
            'techno' => $techno,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_techno_show', methods: ['GET'])]
    public function show(Techno $techno): Response
    {
        return $this->render('admin/techno/show.html.twig', [
            'techno' => $techno,
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_techno_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Techno $techno, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(TechnoType::class, $techno);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $slug = $slugger->slug($techno->getName());
            $techno->setSlug($slug);

            if ($form->isValid()) {
                $entityManager->flush();

                $this->addFlash('success', 'La technologie a bien été modifiée.');

                return $this->redirectToRoute('app_techno_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('admin/techno/edit.html.twig', [
            'techno' => $techno,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_techno_delete', methods: ['POST'])]
    public function delete(Request $request, Techno $techno, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $techno->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($techno);
            $entityManager->flush();

            $this->addFlash('danger', 'La technologie a bien été supprimée.');
        }

        return $this->redirectToRoute('app_techno_index', [], Response::HTTP_SEE_OTHER);
    }
}
