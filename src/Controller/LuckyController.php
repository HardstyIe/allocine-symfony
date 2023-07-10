<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lucky', name: 'app_lucky_')]
class LuckyController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('lucky/index.html.twig', [
            'controller_name' => 'LuckyController',
        ]);
    }

    #[Route('/number', name: 'number')]
    public function number(): Response
    {
        $number = random_int(0,100);
        return $this->render('lucky/number.html.twig',[
            'number'=>$number,
        ]);
    }
}
