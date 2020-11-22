<?php

namespace App\Controller;

use App\Entity\Klasa;
use App\Form\KlasaType;
use App\Repository\KlasaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/klasa")
 */
class KlasaController extends AbstractController
{
    /**
     * @Route("/", name="klasa_index", methods={"GET"})
     */
    public function index(KlasaRepository $klasaRepository): Response
    {
        return $this->render('klasa/index.html.twig', [
            'klasas' => $klasaRepository->findAll(),
        ]);
    }

    /** 
     * @Route("/new", name="klasa_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $klasa = new Klasa();
        $form = $this->createForm(KlasaType::class, $klasa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($klasa);
            $entityManager->flush();

            return $this->redirectToRoute('klasa_index');
        }

        return $this->render('klasa/new.html.twig', [
            'klasa' => $klasa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="klasa_show", methods={"GET"})
     */
    public function show(Klasa $klasa): Response
    {
        return $this->render('klasa/show.html.twig', [
            'klasa' => $klasa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="klasa_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Klasa $klasa): Response
    {
        $form = $this->createForm(KlasaType::class, $klasa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('klasa_index');
        }

        return $this->render('klasa/edit.html.twig', [
            'klasa' => $klasa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="klasa_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Klasa $klasa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$klasa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($klasa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('klasa_index');
    }
}
