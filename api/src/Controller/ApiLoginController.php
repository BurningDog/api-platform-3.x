<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    /**
     * @see \App\OpenApi\OpenApiFactory for OpenApi documentation.
     */
    #[Route('/login-json', name: 'app_api_login')]
    public function index(#[CurrentUser] ?User $user): JsonResponse
    {
        if (null === $user) {
            return $this->json([
                'message' => 'Incorrect credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json(
            [
                'id' => $user ? $user->getId() : null,
            ]
        );
    }

    /**
     * Debugging to check if the session cookie is working.
     *
     * @see \App\OpenApi\OpenApiFactory for OpenApi documentation.
     */
    #[Route(path: '/loggedin', name: 'app_logged_in')]
    public function loginCheck(#[CurrentUser] ?User $user): JsonResponse
    {
        if (null === $user) {
            return $this->json([
                'message' => 'Not logged in',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json($user);
    }
}
