<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use App\Repository\ComputerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ComputerRepository $computerRepository, BrandRepository $brandRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'computers' => $computerRepository->findBy([
                'is_visible' => true
            ]),
            'brands' => $brandRepository->findAll(),
        ]);
    }

    #[Route('/tab/{id}', name: 'app_tab', methods: ['GET'])]
    public function tab(Brand $brand, BrandRepository $brandRepository, ComputerRepository $computerRepository): Response
    {
        return $this->render('tab.html.twig', [
            'brand' => $brand,
            'brands' => $brandRepository->findAll(),
            'computers' => $computerRepository->findAll(),
        ]);
    }
}
