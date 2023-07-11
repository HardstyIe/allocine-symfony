<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Form\PaysType;
use App\Repository\PaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pays')]
class PaysController extends AbstractController
{
    #[Route('/', name: 'app_pays_index', methods: ['GET'])]
    public function index(PaysRepository $paysRepository): Response
    {
        return $this->render('pays/index.html.twig', [
            'pays' => $paysRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pays_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PaysRepository $paysRepository): Response
    {
        $pays = new Pays();
        $form = $this->createForm(PaysType::class, $pays);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paysRepository->save($pays, true);

            return $this->redirectToRoute('app_pays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pays/new.html.twig', [
            'pays' => $pays,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_pays_show', methods: ['GET'])]
    public function show(Pays $pays): Response
    {
        return $this->render('pays/show.html.twig', [
            'pays' => $pays,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pays_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pays $pays, PaysRepository $paysRepository): Response
    {
        $form = $this->createForm(PaysType::class, $pays);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paysRepository->save($pays, true);

            return $this->redirectToRoute('app_pays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pays/edit.html.twig', [
            'pays' => $pays,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_pays_delete', methods: ['POST'])]
    public function delete(Request $request, Pays $pays, PaysRepository $paysRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pays->getId(), $request->request->get('_token'))) {
            $paysRepository->remove($pays, true);
        }

        return $this->redirectToRoute('app_pays_index', [], Response::HTTP_SEE_OTHER);
    }
}
