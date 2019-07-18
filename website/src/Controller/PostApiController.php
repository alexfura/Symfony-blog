<?php


namespace App\Controller;
use App\Entity\Image;
use App\Entity\Post;
use App\Entity\Topic;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;



/**
 * Class PostApiController
 * @package App\Controller
 * API class for post entity
 * @Route("/api/v2/posts")
 */
class PostApiController extends  AbstractFOSRestController
{
    protected $em;
    protected $serializer;
    protected $validator;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * @Rest\Get("/")
     */
    public function getPosts()
    {
        $posts = $this->em->getRepository(Post::class)->findAll();
        $post_json = $this->serializer->serialize($posts, 'json', ['groups' => 'read']);

        return new JsonResponse($post_json, Response::HTTP_OK);
    }

    /**
     * @param Post $post
     * @return JsonResponse
     * @Rest\Get("/{id}")
     */
    public function getPost(Post $post)
    {
        $post_json = $this->serializer->serialize($post, 'json', ['groups' => 'read']);
        return new JsonResponse($post_json, Response::HTTP_OK);
    }


    public function createPost(Request $request)
    {
        
    }
}