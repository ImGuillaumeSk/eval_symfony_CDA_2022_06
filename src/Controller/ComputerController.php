<?php

namespace App\Controller;

use App\Entity\Computer;
use App\Form\ComputerType;
use App\Repository\ComputerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/computer')]
class ComputerController extends AbstractController
{
    #[Route('/', name: 'app_computer_index', methods: ['GET'])]
    public function index(ComputerRepository $computerRepository): Response
    {
        return $this->render('computer/index.html.twig', [
            'computers' => $computerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_computer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ComputerRepository $computerRepository): Response
    {
        $auteur = $this->getUser();
        $computer = new Computer();
        $form = $this->createForm(ComputerType::class, $computer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lettres = range('A', 'Z');
            shuffle($lettres);
            $lettre = array_shift($lettres);
            shuffle($lettres);
            $lettre .= array_shift($lettres);
            shuffle($lettres);
            $lettre .= array_shift($lettres);
            $nombre = mt_rand(10, 99);

            $numeroSerie = $lettre . $nombre;

            $computer->setAuteur($auteur);
            $computer->setIsVisible(true);
            $computer->setNumeroSerie($numeroSerie);
  
            $computerRepository->save($computer, true);

            return $this->redirectToRoute('app_computer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('computer/new.html.twig', [
            'computer' => $computer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_computer_show', methods: ['GET'])]
    public function show(Computer $computer): Response
    {
        return $this->render('computer/show.html.twig', [
            'computer' => $computer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_computer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Computer $computer, ComputerRepository $computerRepository): Response
    {
        $form = $this->createForm(ComputerType::class, $computer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $computerRepository->save($computer, true);

            return $this->redirectToRoute('app_computer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('computer/edit.html.twig', [
            'computer' => $computer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_computer_delete', methods: ['POST'])]
    public function delete(Request $request, Computer $computer, ComputerRepository $computerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$computer->getId(), $request->request->get('_token'))) {
            $computerRepository->remove($computer, true);
        }

        return $this->redirectToRoute('app_computer_index', [], Response::HTTP_SEE_OTHER);
    }
}
