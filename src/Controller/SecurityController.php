<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(
        Request $request,
        UserPasswordHasherInterface $hasher,
        UserRepository $userRepository,
        JWTTokenManagerInterface $JWTManager
    ) {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $password = $data['password'];

        $user = $userRepository->findOneByEmail($email);  // Assurez-vous que la méthode findOneByEmail existe

        if ($user && $hasher->isPasswordValid($user, $password)) {
            $jwt = $JWTManager->create($user);
            return new JsonResponse(['token' => $jwt]);
        }

        return new JsonResponse(['error' => 'Invalid credentials'], 401);
    }
}
