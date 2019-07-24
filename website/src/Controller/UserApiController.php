<?php


namespace App\Controller;


use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * Class UserController
 * @package App\Controller
 * @Route("/api/v2/users")
 */
class UserApiController extends AbstractFOSRestController
{
    private $em;
    private $serializer;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    /**
     * @Rest\Get("/{id}", requirements={"id"="\d+"})
     */
    public function getUserResource(User $user)
    {
        $json_user = $this->serializer->serialize($user, 'json', ['groups' => 'get']);


        return new Response($json_user);
    }

    public function getUsers()
    {

    }

    public function updateUser()
    {

    }
}