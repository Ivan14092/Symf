<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/news', name: 'app_news')]
    public function news(): Response
    {
        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/category', name: 'app_category')]
    public function category(): Response
    {
        return $this->render('category.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/subscription', name: 'app_subscription')]
    public function subscription(): Response
    {
        return $this->render('subscription.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
