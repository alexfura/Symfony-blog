<?php

namespace App\Controller;

use App\Entity\Brands;
use App\Form\BrandsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/brands")
 */
class BrandsController extends AbstractController
{
    /**
     * @Route("/", name="brands_index", methods={"GET"})
     */
    public function index(): Response
    {
        $brands = $this->getDoctrine()
            ->getRepository(Brands::class)
            ->findAll();

        return $this->render('brands/index.html.twig', [
            'brands' => $brands,
        ]);
    }

    /**
     * @Route("/new", name="brands_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $brand = new Brands();
        $form = $this->createForm(BrandsType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($brand);
            $entityManager->flush();

            return $this->redirectToRoute('brands_index');
        }

        return $this->render('brands/new.html.twig', [
            'brand' => $brand,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{brandId}", name="brands_show", methods={"GET"})
     */
    public function show(Brands $brand): Response
    {
        return $this->render('brands/show.html.twig', [
            'brand' => $brand,
        ]);
    }

    /**
     * @Route("/{brandId}/edit", name="brands_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Brands $brand): Response
    {
        $form = $this->createForm(BrandsType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('brands_index');
        }

        return $this->render('brands/edit.html.twig', [
            'brand' => $brand,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{brandId}", name="brands_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Brands $brand): Response
    {
        if ($this->isCsrfTokenValid('delete'.$brand->getBrandId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($brand);
            $entityManager->flush();
        }

        return $this->redirectToRoute('brands_index');
    }
}
