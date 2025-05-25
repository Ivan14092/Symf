<?php

namespace App\Controller;

use App\Entity\QuizResult;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\NewsRepository;
use App\Repository\QuizResultRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class HomeController extends AbstractController
{
    public function __construct(private readonly CategoryRepository $categoryRepository,
        private readonly NewsRepository $newsRepository,
        private readonly QuizResultRepository $quizResultRepository,
        private readonly EntityManagerInterface $entityManager
    ) {}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        if ($this->getUser() === null) {
            return $this->redirectToRoute('login');
        }
        return $this->render('main.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/news', name: 'app_news')]
    public function news(Request $request): Response
    {
        $user = $this->getUser();
        $categoryId = $request->query->get('category');
        $quizResult = $this->quizResultRepository->findOneBy(['userId' => $user?->getId()], ['id' => 'DESC']);

        if ($categoryId !== null) {
            $news = $this->newsRepository->findBy(['categoryId' => $categoryId]);
        } else if ($quizResult !== null) {
            $news = $this->newsRepository->findBy(['categoryId' => $quizResult->getCategoryId()]);
        } else {
            $news = $this->newsRepository->findAll();
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

    #[Route('/api/save-quiz-result', name: 'save_quiz_result', methods: ['POST'])]
    public function saveQuizResult(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $categoryName = $data['categoryName'];
        $category = $this->categoryRepository->findOneBy(['name' => $categoryName]);
        $categoryId = $category->getId() ?? 0;

        $user = $this->getUser();
        $quizResult = new QuizResult();
        $quizResult->setUserId($user->getId());
        $quizResult->setCategoryId($categoryId);
        $this->entityManager->persist($quizResult);
        $this->entityManager->flush();

        return new JsonResponse('ok');
    }

    #[Route('/api/save-quiz-result/reset', name: 'save_quiz_result_reset', methods: ['GET'])]
    public function resetQuizResult(): JsonResponse
    {
        $user = $this->getUser();
        $quizResults = $this->quizResultRepository->findBy(['userId' => $user->getId()], ['id' => 'DESC']);
        foreach ($quizResults as $quizResult) {
            $this->entityManager->remove($quizResult);
        }
        $this->entityManager->flush();

        return new JsonResponse('ok');
    }


}
