<?php

namespace App\Controller;

use App\Entity\Osoba;
use App\Form\OsobaType;
use App\Repository\OsobaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/osoba")
 */
class OsobaController extends AbstractController
{
    /**
     * @Route("/", name="osoba_index", methods={"GET"})
     */
    public function index(OsobaRepository $osobaRepository): Response
    {
        return $this->render('osoba/index.html.twig', [
            'osobas' => $osobaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="osoba_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $osoba = new Osoba();
        $form = $this->createForm(OsobaType::class, $osoba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($osoba);
            $entityManager->flush();

            return $this->redirectToRoute('osoba_index');
        }

        return $this->render('osoba/new.html.twig', [
            'osoba' => $osoba,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="osoba_show", methods={"GET"})
     */
    public function show(Osoba $osoba): Response
    {
        return $this->render('osoba/show.html.twig', [
            'osoba' => $osoba,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="osoba_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Osoba $osoba): Response
    {
        $form = $this->createForm(OsobaType::class, $osoba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('osoba_index');
        }

        return $this->render('osoba/edit.html.twig', [
            'osoba' => $osoba,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="osoba_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Osoba $osoba): Response
    {
        if ($this->isCsrfTokenValid('delete'.$osoba->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($osoba);
            $entityManager->flush();
        }

        return $this->redirectToRoute('osoba_index');
    }
}
