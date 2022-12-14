<?php

namespace App\Controller;

use App\Repository\ComputerListByUserRepository;
use App\Repository\ComputerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(ComputerRepository $computerRepo, ComputerListByUserRepository $computerListByUserRepository): Response
    {
        $user = $this->getUser();
        return $this->render('profil/index.html.twig', [
            'computers' => $computerRepo->findBy([
                'auteur' => $user,
            ]),
            'computersFav' => $computerListByUserRepository->findBy([
                'users' => $user
            ])
        ]);
    }
}
