<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class HomeController extends AbstractController
{
    public function __construct(private readonly CategoryRepository $categoryRepository,
        private readonly NewsRepository $newsRepository
    ) {}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('main.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/news', name: 'app_news')]
    public function news(Request $request): Response
    {
        $categoryId = $request->query->get('category');

        if ($categoryId === null) {
            $news = $this->newsRepository->findAll();
        } else {
            $news = $this->newsRepository->findBy(['categoryId' => $categoryId]);
        }

        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController',
            'news' => $news,
        ]);
    }

    #[Route('/category', name: 'app_category')]
    public function category(): Response
    {
        $categories = $this->categoryRepository->findAll();

        return $this->render('category.html.twig', [
            'controller_name' => 'HomeController',
            'categories' => $categories,
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
