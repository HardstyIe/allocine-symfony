<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use App\Repository\CategoryRepository;
use App\Repository\MovieRepository;
use App\Repository\RealisatorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  #[Route('/', name: 'app_home')]
  public function index(ActorRepository $actorRepository, CategoryRepository $categoryRepository, MovieRepository $movieRepository, RealisatorRepository $realisatorRepository): Response
  {
    $actors = $actorRepository->findAll();
    $categories = $categoryRepository->findAll();
    $movies = $movieRepository->findAll();
    $realisators = $realisatorRepository->findAll();


    return $this->render('home/index.html.twig', [

      'controller_name' => 'HomeController',
      'actors' => $actors,
      'categories' => $categories,
      'movies' => $movies,
      'realisators' => $realisators,
    ]);
  }

  #[Route('/home/search', name: 'app_search_movie')]
  public function search(Request $request, MovieRepository $movieRepository, ActorRepository $actorRepository, RealisatorRepository $realisatorRepository, CategoryRepository $categoryRepository)
  {
    // Récupérer les critères de recherche à partir de la requête
    $query = $request->query->get('query');
    $actorIds = $request->query->get('actorIds');
    $realisatorIds = $request->query->get('realisatorIds');
    $categoryIds = $request->query->get('categoryIds');


    // Récupérer les acteurs, réalisateurs et catégories correspondants aux IDs
    $actors = $actorIds ? $actorRepository->findBy(['id' => $actorIds]) : [];
    $realisators = $realisatorIds ? $realisatorRepository->findBy(['id' => $realisatorIds]) : [];
    $categories = $categoryIds ? $categoryRepository->findBy(['id' => $categoryIds]) : [];

    // Faire la recherche en fonction des critères spécifiés
    $movies = $movieRepository->search($query, $actors, $realisators, $categories);

    // Passer les données au template (la vue)
    return $this->render('home/index.html.twig', [
      'movies' => $movies,
      'allActors' => $actorRepository->findAll(),
      'allRealisators' => $realisatorRepository->findAll(),
      'allCategories' => $categoryRepository->findAll(),
    ]);
  }
}
