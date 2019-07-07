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
     * @Route("/", name="home")
     */
    public function index()
    {
        // get home page
        $message = "Random message";
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->getLastPosts();

        return $this->render(
            'home.html.twig', ['message' => $message, 'posts' =>  $posts]
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