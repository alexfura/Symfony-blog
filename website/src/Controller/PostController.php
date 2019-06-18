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
     * @Route("/", name="topics")
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
     * @Route("/{slug}", name="posts_by_topic", requirements={"slug"="^[a-z]+(?:-[a-z]+)*$"})
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
     * @Route("/{slug}/{post_id}", name="post_by_topic")
     * @ParamConverter("post", options={"id" = "post_id"})
     * @return mixed
     */

    public function showPostByTopic(Topic $topic, Post $post)
    {
        if($topic->getPosts()->contains($post))
        {
            return $this->render('post/post.html.twig', ['post' => $post]);
        }
        else
        {
            throw $this->createNotFoundException('Not found');
        }
    }

    /**
     * @Route("/{post_id}", name="post_by_id", requirements={"id"="\d+"})
     * @ParamConverter("post", options={"id" = "post_id"})
     */
    public function getPostById(Post $post)
    {
        return $this->render('post/post.html.twig', ['post' => $post]);
    }
}
