<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('main.html.twig', [
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
    public function subscription(#[CurrentUser] ?User $user): Response
    {
        if ($user === null) {
            return $this->redirectToRoute('login');
        }

        return $this->render('subscription.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
