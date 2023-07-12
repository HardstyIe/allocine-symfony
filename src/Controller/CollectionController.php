<?php

namespace App\Controller;

use App\Entity\Console;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollectionController extends AbstractController
{
    #[Route('/collection/console/{id}', name: 'app_consoles_collection')]
    public function addConsolesToCollection(Console $console, UserRepository $repository): Response
    {
        $userConnected = $this->getUser();
        $user = $repository->find($userConnected->getId());
        $user->addConsole($console);
        $repository->save($user, true);
        return $this->redirectToRoute('app_console_index');
    }

    #[Route('/collection/game/{id}')]
    public function addGamesToCollection():Response
    {
        return $this->redirectToRoute('app_game_index');
    }

    #[Route('/collection/delete/console/{id}', name:'app_remove_console')]
    public function deleteConsolesToCollection(Console $console,UserRepository $repository):Response
    {
        $userConnected = $this->getUser();
        $user = $repository->find($userConnected->getId());
        $user->removeConsole($console);
        $repository->save($user, true);
        return $this->redirectToRoute('app_profile');
    }
}
