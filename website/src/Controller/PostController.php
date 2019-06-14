<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Topic;
use App\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


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
            'topics' =>  $topics
        ]);
    }

    /**
     * @Route("/{slug}", name="post_show_slug")
     */
    public function showTopicPostsBySlug(Request $request, Topic $topic, PaginatorInterface $paginator)
    {
        $posts = $topic->getPosts();

        $pagination = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1),
            2
        );

        return $this->render('post/topic.html.twig', ['topic' => $topic, 'pagination' => $pagination]);
    }

    /**
     * @param Topic $topic
     * @param Post $post
     * @Route("/{slug}/{post_id}", name="post_show_id")
     * @ParamConverter("post", options={"id" = "post_id"})
     */

    public function showPostById(Topic $topic, Post $post)
    {
        if($topic->getPosts()->contains($post))
        {
            return $this->render('post/post.html.twig', ['post' => $post, 'topic' => $topic]);
        }
        else
        {
            throw $this->createNotFoundException('Not found');
        }
    }
}
