<?php

namespace App\Controller;

use App\DTO\UserDto;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    public function __construct(private readonly UserService $userService) {}

    #[Route('/login', name: 'login', methods: ['GET'])]
    public function getLoginPage(): Response
    {
        return $this->render('pages/login.html.twig');
    }

    #[Route(path: "/login", name: 'app_login', methods: 'POST')]
    public function login(): JsonResponse
    {
        return new JsonResponse('login success 123');
    }

    #[Route('/register', name: 'register', methods: ['GET'])]
    public function getRegisterPage(): Response
    {
        return $this->render('pages/register.html.twig');
    }

    #[Route('/register', name: 'post_register', methods: ['POST'])]
    public function register(Request $request): Response
    {
        try {
            $data = $request->request->all();
            $this->userService->create(
                new UserDto(
                    $data['email'],
                    $data['password'],
                    $data['name'],
                    $data['lastname'],
                    $data['phone'] ?? null,
                ),
            );
        } catch (\Throwable $exception) {
            return $this->redirectToRoute('register');
        }
        return $this->redirectToRoute('login');
    }
}
