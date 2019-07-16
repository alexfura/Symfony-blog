<?php


namespace App\Controller;

use App\Controller\Interfaces\TokenControllerInterface;
use App\Service\AuthService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use http\Env\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;


/**
 * Class PostApiController
 * @package App\Controller
 * API class for post entity
 * @Route("/api/v2/posts")
 */

class PostApiController extends AbstractFOSRestController implements TokenControllerInterface
{
    private $em;
    private $authService;

    public function __construct(EntityManagerInterface $em, AuthService $authService)
    {
        $this->em = $em;
        $this->authService = $authService;
    }

    /**
     * @Rest\Get("/")
     */
    public function getPosts()
    {
//        $postRepo = $this->em->getRepository(Post::class);
//        $posts = $postRepo->findAll();

        return new JsonResponse("post collection", Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/{id}")
     */
    public function getPost()
    {

    }

    /**
     * @Rest\Post("/create")
     */
    public function createPost()
    {

    }

    /**
     * @Rest\Pust("/{id}/update")
     */
    public function updatePost()
    {

    }
}