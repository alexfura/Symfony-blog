<?php

namespace App\Controller;

use App\Entity\Supplies;
use App\Form\SuppliesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/supplies")
 */
class SuppliesController extends AbstractController
{
    /**
     * @Route("/", name="supplies_index", methods={"GET"})
     */
    public function index(): Response
    {
        $supplies = $this->getDoctrine()
            ->getRepository(Supplies::class)
            ->findAll();

        return $this->render('supplies/index.html.twig', [
            'supplies' => $supplies,
        ]);
    }

    /**
     * @Route("/new", name="supplies_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $supply = new Supplies();
        $form = $this->createForm(SuppliesType::class, $supply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($supply);
            $entityManager->flush();

            return $this->redirectToRoute('supplies_index');
        }

        return $this->render('supplies/new.html.twig', [
            'supply' => $supply,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{supplyId}", name="supplies_show", methods={"GET"})
     * @param Supplies $supply
     * @return Response
     */
    public function show(Supplies $supply): Response
    {
        return $this->render('supplies/show.html.twig', [
            'supply' => $supply,
        ]);
    }

    /**
     * @Route("/{supplyId}/edit", name="supplies_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Supplies $supply
     * @return Response
     */
    public function edit(Request $request, Supplies $supply): Response
    {
        $form = $this->createForm(SuppliesType::class, $supply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('supplies_index', [
                'supplyId' => $supply->getSupplyId(),
            ]);
        }

        return $this->render('supplies/edit.html.twig', [
            'supply' => $supply,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{supplyId}", name="supplies_delete", methods={"DELETE"})
     * @param Request $request
     * @param Supplies $supply
     * @return Response
     */
    public function delete(Request $request, Supplies $supply): Response
    {
        if ($this->isCsrfTokenValid('delete'.$supply->getSupplyId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($supply);
            $entityManager->flush();
        }

        return $this->redirectToRoute('supplies_index');
    }
}
