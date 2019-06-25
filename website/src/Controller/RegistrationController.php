<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Swift_Mailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

/**
 * Class RegistrationController
 * @package App\Controller
 * @Router("/register")
 */
class RegistrationController extends AbstractController
{
    /**
     * @Route("/", name="app_register")
     */
    public function register(Request $request,
                             UserPasswordEncoderInterface $passwordEncoder,
                             GuardAuthenticatorHandler $guardHandler,
                             LoginFormAuthenticator $authenticator, Swift_Mailer $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($user);
            $entityManager->flush();

            // send confirmation email

            $message = (new \Swift_Message())
                ->setFrom('alexfuraog@gmail.com')
                ->setTo($form->get('email')->getData())
                ->setBody(
                    $this->renderView('emails/registration/confirm.html.twig', ['user' => $user])
                );
            if($mailer->send($message))
            {
                return new Response("confirmation message was sent to {$form->get('email')->getData()}");
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

//    public function sendMail()
//    {
//
//    }

    /**
     * @param User $user
     * @return Response
     * @Route("/register/confirm/{email_token}", name="user_confirm")
     */
    public function confirmEmail(User $user)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_ANONYMOUSLY');
        // activate user by email random token

        // check if user already activated
        if($user->getStatus())
        {
            $this->redirect('home');
        }
        else
        {
            // update status of user
            $user->setStatus(true);
            $em = $this->getDoctrine()->getManager();
            $em->merge($user);
            $em->flush();
        }

        return $this->redirect('home');
    }
}

