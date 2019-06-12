<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Entity\Topic;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/post", name="posts")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="post")
     * returns topics
     */
    public function index()
    {
        $topics = $this->getDoctrine()->getRepository(Topic::class)->findAll();
        return $this->render('post/index.html.twig', [
            'controller_name' =>  $topics,
        ]);
    }

    /**
     * @Route("/{slug}", name="article_show_slug")
     */
    public function showPostBySlug($slug)
    {
        return new Response($slug);
    }

//    /**
//     * @param string $slug
//     * @param int $id
//     * @Route("/{slug}/{id}", name="article_show_id", requirements={"slug"="^[a-z0-9]+(?:-[a-z0-9]+)*$"}", "id"="\d+"}
//     * show page of choosen topic by id
//     */
//    public function showPostById(string $slug, int $id)
//    {
//
//    }
}
