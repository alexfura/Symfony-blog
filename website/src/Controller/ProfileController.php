<?php


namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


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
     * @param Request $request
     * @param User $user
     * @return Response
     * @Route("/{id}/edit", name="user_edit")
     */
    public function editUser(User $user, Request $request)
    {
        $this->denyAccessUnlessGranted('user_edit', $user);

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->merge($user);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('user/edit.html.twig', ['form' => $form->createView()]);
    }
}


