<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Topic;
use App\Entity\Post;

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
            'topics' =>  $topics,
        ]);
    }
//
    /**
     * @Route("/{slug}", name="post_show_slug")
     */
    public function showTopicPostsBySlug(Topic $topic)
    {
        return $this->render('post/index.html.twig', ['topic' => $topic]);
    }

    /**
     * @param Topic $topic
     * @param Post $post
     * @Route("/{slug}/{id}", name="post_show_id")
     */

    public function showPostById(Topic $topic, $id)
    {
        $post = $topic->getProducts()->get($id);
        return $this->render('post/post.html.twig', ['post' => $post]);
    }
}
