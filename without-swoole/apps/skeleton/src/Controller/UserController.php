<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users", methods={"GET"})
     */
    public function list(): Response
    {
        return new JsonResponse(array_map(
            fn(User $user) => ['id' => $user->getId(), 'email' => $user->getEmail()],
            $this->getDoctrine()->getRepository(User::class)->findAll()
        ));
    }

    /**
     * @Route("/users/{id}", methods={"GET"})
     */
    public function read(int $id): Response
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        return new JsonResponse([
            'id' => $user->getId(),
            'email' => $user->getEmail()
        ]);
    }

    /**
     * @Route("/users", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setEmail($request->get('email'));
        $manager->persist($user);
        $manager->flush();

        return new JsonResponse([
            'id' => $user->getId(),
            'email' => $user->getEmail()
        ]);
    }
}
