<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ProfileController
 * @package App\Controller
 * @Route("/user")
 */
class ProfileController extends AbstractController
{
    /**
     * @param User $user
     * @return Response
     * @Route("/{id}", name="user")
     */
    public function getUserProfile(User $user)
    {
        return $this->render('user/index.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/user/{id}/edit", name="user_edit", methods={"PUT", "GET"})
     */
    public function putUserAction(Request $request, User $user)
    {
        $this->denyAccessUnlessGranted('user_edit', $user);


        return new Response($user->getId());
    }


    public function getUserData()
    {

    }

    public function setUserData()
    {

    }
}


