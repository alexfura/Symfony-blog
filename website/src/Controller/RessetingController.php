<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RessetingController extends AbstractController
{
    /**
     * @Route("/resseting", name="resseting")
     */
    public function index()
    {
        return $this->render('resseting/index.html.twig', [
            'controller_name' => 'RessetingController',
        ]);
    }

    private function sendResetEmail()
    {

    }

    private function confirmAction()
    {

    }
}
