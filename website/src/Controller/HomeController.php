<?php
//

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     *
     * Matches "/"
     *
     * @Route("/", name="main")
     */
    public function index()
    {
        // get home page
        $message = "";

        return $this->render(
            'home.html.twig', ['message' => $message]
        );

    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        // get about page
        $about_message = "Get info about this website";
        return $this->render(
            'about.html.twig', ['message' => $about_message]
        );
    }
}