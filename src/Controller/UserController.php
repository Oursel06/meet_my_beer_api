<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{

    #[Route('/api/user/login', name: 'api_user_connection', methods: ['POST'])]
    public function actionConnection(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder): JsonResponse
    {
        $request = Request::createFromGlobals();
        $parameters = json_decode($request->getContent(), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo 'JSON decoding error: ' . json_last_error_msg();
        }
        if(
            !isset($parameters['email']) ||
            !isset($parameters['password'])
        ){
            return new JsonResponse([
                'error' => 'Missing parameters'
            ], Response::HTTP_BAD_REQUEST);
        }
        
        $repo = $entityManager->getRepository(User::class);

        $user = $repo->findOneBy(['email' => $parameters['email']]);
        if (!$user || !$passwordEncoder->isPasswordValid($user, $parameters['password'])) {
            return new JsonResponse([
                'error' => 'Wrong Account'
            ], Response::HTTP_NOT_FOUND);
        }
    
        // $token = $this->jwtTokenGenerator->generateToken($user);
        return new JsonResponse(json_encode(
            [
                'reponse' => 'connected',
            ]
        ),
          Response::HTTP_OK, ['accept' => 'json'], true);
    }


    #[Route('/api/user/register', name: 'api_user_register', methods: ['POST'])]
    public function actionRegister(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder): JsonResponse
    {
        $request = Request::createFromGlobals();
        $data = json_decode($request->getContent(), true);
        if (
            !isset($data['password']) ||
            !isset($data['email'])) {
            return new JsonResponse([
                'error' => 'Missing parameters'
            ], Response::HTTP_BAD_REQUEST);
        }
        $password = $data['password'];
        $email = $data['email'];


        $repoUser = $entityManager->getRepository(User::class);
        if(!is_null($repoUser->verifyByEmailAndPassword($data['email'], $data['password']))){
            return new JsonResponse([
                'error' => 'Account already exist'
            ], Response::HTTP_NOT_ACCEPTABLE);
        }


        $user = new User();
        $user->setEmail($email);
        $hashedPassword = $passwordEncoder->hashPassword($user, $password);
        $user->setPassword($hashedPassword);
        
        $entityManager->persist($user);

        $entityManager->flush();

        if (is_null($user)) {
            return new JsonResponse([
                'error' => 'Not Acceptable'
            ], Response::HTTP_NOT_ACCEPTABLE);
        }

        return new JsonResponse(
            json_encode(['message' => 'Création du compte réussie']),
            Response::HTTP_CREATED, ['accept' => 'json'],
            true
        );
    }
}