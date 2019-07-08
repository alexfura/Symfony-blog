<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormTypeInterface;
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
     * @Route("/{id}/edit", name="user_edit", methods={"PUT", "GET"})
     */
    public function putUserAction(Request $request, User $user)
    {
        $this->denyAccessUnlessGranted('user_edit', $user);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
//            $this->setUserData($form, $user);
            $user->setFirstName($form->get('first_name'));
            $user->setSecondName($form->get('second_name'));
            $em->merge($user);
            $em->flush();
        }

        return $this->render('user/edit.html.twig', ['form' => $form->createView()]);
    }


    public function setUserData(FormTypeInterface $form, User &$user)
    {

    }
}


