<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/entreprise', name: 'app_entreprise_')]
class EntrepriseController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntrepriseRepository $entrepriseRepository): Response
    {
        $entreprises = $entrepriseRepository->findAll();
        return $this->render('entreprise/index.html.twig', [
            'controller_name' => 'EntrepriseController',
            'entreprises' => $entreprises
        ]);
    }

    #[Route('/add', name: 'add')]
    public function addEntreprise()
    {

        return $this->render('entreprise/add.html.twig');
    }

    #[Route('/add/new', name: 'add_new', methods: 'POST')]
    public function addNewEntreprise(EntrepriseRepository $entrepriseRepository)
    {
//        dd($_POST);
        $entreprise = new Entreprise();
        $entreprise->setName($_POST['name']);
        $entrepriseRepository->save($entreprise, true);
        return $this->redirectToRoute('app_entreprise_index');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function deleteEntreprise(Entreprise $entreprise, EntrepriseRepository $entrepriseRepository)
    {
        $entrepriseRepository->remove($entreprise, true);
        return $this->redirectToRoute('app_entreprise_index');
    }
}
