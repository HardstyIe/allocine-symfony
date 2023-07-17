<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie')]
class MovieController extends AbstractController
{
  #[Route('/', name: 'app_movie_index', methods: ['GET'])]
  public function index(MovieRepository $movieRepository): Response
  {
    return $this->render('movie/index.html.twig', [
      'movies' => $movieRepository->findAll(),
    ]);
  }

  #[Route('/new', name: 'app_movie_new', methods: ['GET', 'POST'])]
  public function createMovie(Request $request, MovieRepository $movieRepository): Response
  {
    $movie = new Movie();
    $form = $this->createForm(MovieType::class, $movie);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      // Récupérez les données du formulaire pour le film
      $movieData = $form->getData();

      // Récupérez les acteurs, réalisateurs et catégories associés au film (vous pouvez les ajouter via le formulaire)
      $actors = $movieData->getActors();
      $realisators = $movieData->getRealisators();
      $categories = $movieData->getCategories();

      // Ajoutez chaque acteur, réalisateur et catégorie au film
      foreach ($actors as $actor) {
        $movie->addActor($actor);
      }

      foreach ($realisators as $realisator) {
        $movie->addRealisator($realisator);
      }

      foreach ($categories as $category) {
        $movie->addCategory($category);
      }

      // Enregistrez le film et les entités liées en base de données
      $movieRepository->save($movie, true);

      // Redirigez ou affichez un message de succès
      return $this->redirectToRoute('app_movie_index');
    }

    return $this->render('movie/new.html.twig', [
      'form' => $form->createView(),
    ]);
  }


  #[Route('/{id}', name: 'app_movie_show', methods: ['GET'])]
  public function show(Movie $movie): Response
  {
    return $this->render('movie/show.html.twig', [
      'movie' => $movie,
    ]);
  }

  #[Route('/{id}/edit', name: 'app_movie_edit', methods: ['GET', 'POST'])]
  public function edit(Request $request, Movie $movie, MovieRepository $movieRepository): Response
  {
    $form = $this->createForm(MovieType::class, $movie);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $movieRepository->save($movie, true);

      return $this->redirectToRoute('app_movie_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('movie/edit.html.twig', [
      'movie' => $movie,
      'form' => $form,
    ]);
  }

  #[Route('/{id}', name: 'app_movie_delete', methods: ['POST'])]
  public function delete(Request $request, Movie $movie, MovieRepository $movieRepository): Response
  {
    if ($this->isCsrfTokenValid('delete' . $movie->getId(), $request->request->get('_token'))) {
      $movieRepository->remove($movie, true);
    }

    return $this->redirectToRoute('app_movie_index', [], Response::HTTP_SEE_OTHER);
  }
}
