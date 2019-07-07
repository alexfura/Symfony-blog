<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Swift_Mailer;
use Symfony\Component\Form\FormError;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
/**
 * Class RegistrationController
 * @package App\Controller
 * @Route("/register")
 *
 */
class RegistrationController extends AbstractController
{
    /**
     * @Route("/", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $authenticator
     * @param Swift_Mailer $mailer
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder,
                             GuardAuthenticatorHandler $guardHandler,
                             LoginFormAuthenticator $authenticator, Swift_Mailer $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            // save user to database
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($user);
            $entityManager->flush();

            // send confirmation email

            $message = (new \Swift_Message("Confirmation Email"))
                ->setFrom('alexfuraog@gmail.com')
                ->setTo($form->get('email')->getData())
                ->setBody(
                    $this->renderView('emails/registration/confirm.html.twig', ['user' => $user]),
                    'text/html'
                );

            // show error if message was not send
            if(!$mailer->send($message))
            {
                return new Response("Cannot send email");
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @param User $user
     * @return Response
     * @Route("/confirm/{email_token}", name="user_confirm")
     */
    public function confirmEmail(User $user)
    {
        // activate user by email random token
        // update status of user
        $user->setStatus(true);
        $user->setEmailToken(null);
        $em = $this->getDoctrine()->getManager();
        $em->merge($user);
        $em->flush();

        return $this->redirectToRoute('home');
    }
}

