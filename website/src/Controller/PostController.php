<?php

namespace App\Controller;

use App\Form\PostType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Topic;
use App\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * @Route("/posts", name="posts")
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
     * @param Post $post
     * @Route("/{id}", name="post_by_id", requirements={"id"="\d+"})
     */
    public function getPostById(Post $post)
    {
        return $this->render('post/post.html.twig', ['post' => $post]);
    }

    /**
     * @param Post $post
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/edit", name="post_edit")
     */
    public function editPost(Post $post, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('edit_post', $post);

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->merge($post);
            $em->flush();

            $this->redirectToRoute('postspost_by_id', ['post_id' => $post->getId()]);
        }

        return $this->render('post/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param Request $request
     * @throws \Exception
     * @Route("/create", name="post_create")
     * @return mixed
     */
    public function createPost(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $form = $this->createForm(PostType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $post = $form->getData();
            // set data from form
            $post->setAuthor($this->getUser());
            $post->setCreatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            // redirect action

            $this->redirectToRoute('postspost_by_id', ['post_id' => $post->getId()]);
        }

        return $this->render('post/create.html.twig', ['form' => $form->createView()]);
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
}
