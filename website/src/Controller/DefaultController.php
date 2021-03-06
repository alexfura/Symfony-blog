<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Topic;
use App\Entity\Post;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="home")
     */
    public function index()
    {
        $message = "Random message";
        return $this->render(
            'home.html.twig', ['message' => $message]
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
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
}