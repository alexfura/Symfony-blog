<?php
//

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Topic;
use App\Entity\Post;


class DefaultController extends AbstractController
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
        $message = "Message in the bottle";

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
        $about_message = "About:";
        return $this->render(
            'about.html.twig', ['message' => $about_message]
        );
    }

    public function showSideBar()
    {
        $topics = $this->getDoctrine()->getRepository(Topic::class)->findAll();

        return $this->render('layouts/sidebar.html.twig', ['topics' => $topics]);
    }
}