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



  #[Route('/movie/search', name: 'app_search_movie')]
  public function search(Request $request, MovieRepository $movieRepository, ActorRepository $actorRepository, RealisatorRepository $realisatorRepository, CategoryRepository $categoryRepository)
  {
    $query = $request->query->get('query');
    $actorIdsString = $request->query->get('actorIds');
    $realisatorIdsString = $request->query->get('realisatorIds');
    $categoryIdsString = $request->query->get('categoryIds');

    // Convertir les strings en tableaux
    $actorIds = $actorIdsString ? explode(',', $actorIdsString) : [];
    $realisatorIds = $realisatorIdsString ? explode(',', $realisatorIdsString) : [];
    $categoryIds = $categoryIdsString ? explode(',', $categoryIdsString) : [];

    // Faire la recherche en fonction des critères spécifiés
    $movies = $movieRepository->search($query, $actorIds, $realisatorIds, $categoryIds);

    // Passer les données au template (la vue)
    return $this->render('home/afterSearchIndex.html.twig', [
      'movies' => $movies,
      'allActors' => $actorRepository->findAll(),
      'allRealisators' => $realisatorRepository->findAll(),
      'allCategories' => $categoryRepository->findAll(),
    ]);
  }
}
