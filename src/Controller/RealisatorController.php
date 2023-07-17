<?php

namespace App\Controller;

use App\Entity\Realisator;
use App\Form\RealisatorType;
use App\Repository\RealisatorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/realisator')]
class RealisatorController extends AbstractController
{
    #[Route('/', name: 'app_realisator_index', methods: ['GET'])]
    public function index(RealisatorRepository $realisatorRepository): Response
    {
        return $this->render('realisator/index.html.twig', [
            'realisators' => $realisatorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_realisator_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RealisatorRepository $realisatorRepository): Response
    {
        $realisator = new Realisator();
        $form = $this->createForm(RealisatorType::class, $realisator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $realisatorRepository->save($realisator, true);

            return $this->redirectToRoute('app_realisator_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('realisator/new.html.twig', [
            'realisator' => $realisator,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_realisator_show', methods: ['GET'])]
    public function show(Realisator $realisator): Response
    {
        return $this->render('realisator/show.html.twig', [
            'realisator' => $realisator,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_realisator_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Realisator $realisator, RealisatorRepository $realisatorRepository): Response
    {
        $form = $this->createForm(RealisatorType::class, $realisator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $realisatorRepository->save($realisator, true);

            return $this->redirectToRoute('app_realisator_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('realisator/edit.html.twig', [
            'realisator' => $realisator,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_realisator_delete', methods: ['POST'])]
    public function delete(Request $request, Realisator $realisator, RealisatorRepository $realisatorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$realisator->getId(), $request->request->get('_token'))) {
            $realisatorRepository->remove($realisator, true);
        }

        return $this->redirectToRoute('app_realisator_index', [], Response::HTTP_SEE_OTHER);
    }
}
