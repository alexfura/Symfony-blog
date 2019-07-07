<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ProfileController
 * @package App\Controller
 */
class ProfileController extends AbstractFOSRestController
{
    /**
     * @param User $user
     * @return Response
     * @Route("/
     */
    public function getUserProfile(User $user)
    {

    }

    /**
     * @Route("/user/{id}/edit", name="edit_user", methods={"PUT", "GET"})
     */
    public function putUserAction(Request $request, User $user)
    {
//        $this->denyAccessUnlessGranted('edit_user');

    }

    public function getUserData()
    {

    }

    public function setUserData()
    {

    }
}


