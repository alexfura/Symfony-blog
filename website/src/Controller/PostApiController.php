<?php


namespace App\Controller;
use App\Controller\Interfaces\TokenControllerInterface;
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
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        return new JsonResponse($posts, Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/create")
     */
    public function createPost(Request $request)
    {
        $post = new Post();
        $this->setEntityFromRequest($request, $post);
        $errors = $this->validator->validate($post);
        if(count($errors) > 0)
        {
            throw  new HttpException( Response::HTTP_UNPROCESSABLE_ENTITY, (string)$errors);
        }
        $this->em->persist($post);
        $this->em->flush();

        return new JsonResponse("created new post", Response::HTTP_CREATED);
    }

    /**
     * @param Post $post
     * @return JsonResponse
     * @Rest\Get("/{id}", requirements={"id"="\d+"})
     */
    public function getPost(Post $post)
    {
        return new JsonResponse($post, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param Post $post
     * @Rest\Put("/{id}/edit", requirements={"id"="\d+"})
     */
    public function editPost(Request $request, Post $post)
    {
        $this->setEntityFromRequest($request, $post);
        $errors = $this->validator->validate($post);
        if(count($errors) > 0)
        {
            throw  new HttpException( Response::HTTP_UNPROCESSABLE_ENTITY, (string)$errors);
        }

        $this->em->merge($post);
        $this->em->flush();

        return new JsonResponse("updated post", Response::HTTP_OK);
    }

    private function setEntityFromRequest(Request $request, Post $post)
    {
        $data = json_decode($request->getContent());
        $post->setTitle($data->title);
        $post->setTextField($data->textField);
        $post->setTopic($this->em->getRepository(Topic::class)->findOneBy(['id' =>$data->topic]));
        $post->setAuthor($this->em->getRepository(User::class)->findOneBy(['id' =>$data->author]));
    }
}