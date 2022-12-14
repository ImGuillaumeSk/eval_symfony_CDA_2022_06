<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Computer;
use App\Entity\ComputerListByUser;
use App\Form\BrandType;
use App\Repository\BrandRepository;
use App\Repository\ComputerListByUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/brand')]
class BrandController extends AbstractController
{
    #[Route('/', name: 'app_brand_index', methods: ['GET'])]
    public function index(BrandRepository $brandRepository): Response
    {
        return $this->render('brand/index.html.twig', [
            'brands' => $brandRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_brand_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BrandRepository $brandRepository): Response
    {
        $brand = new Brand();
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brandRepository->save($brand, true);

            return $this->redirectToRoute('app_brand_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('brand/new.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_brand_show', methods: ['GET'])]
    public function show(Brand $brand): Response
    {
        return $this->render('brand/show.html.twig', [
            'brand' => $brand,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_brand_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Brand $brand, BrandRepository $brandRepository): Response
    {
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brandRepository->save($brand, true);

            return $this->redirectToRoute('app_brand_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('brand/edit.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_brand_delete', methods: ['POST'])]
    public function delete(Request $request, Brand $brand, BrandRepository $brandRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$brand->getId(), $request->request->get('_token'))) {
            $brandRepository->remove($brand, true);
        }

        return $this->redirectToRoute('app_brand_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/fav', name: 'app_computer_fav', methods: ['GET', 'POST'])]
    public function favUserAnnonce(Computer $computer, ComputerListByUserRepository $computerListByUserRepository): Response
    {
        $user = $this->getUser();
        if (!$user) return $this->redirectToRoute('app_login');

        if ($computer->isUserfav($user)) {
            $signedUp = $computerListByUserRepository->findOneBy([
                'computers' => $computer,
                'users' => $user
            ]);
            $computerListByUserRepository->remove($signedUp);
            $this->addFlash('Erreur', "Cette annonce n'est plus dans vos favoris.");
            return $this->redirectToRoute('home');
        }

        $newFav = new ComputerListByUser();
        $newFav->setComputers($computer)
            ->setUsers($user);

        $computerListByUserRepository->save($newFav);
        $this->addFlash('Succès', "Cette annonce est désormais dans vos favoris.");

        return $this->redirectToRoute('home');
    }

}
