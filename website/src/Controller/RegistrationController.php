<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Swift_Mailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
/**
 * Class RegistrationController
 * @package App\Controller
 * @Route("/register")
 *
 */
class RegistrationController extends AbstractController
{
    private $passwordEncoder;
    private $mailer;

    /**
     * RegistrationController constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param Swift_Mailer $mailer
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, Swift_Mailer $mailer)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
    }


    /**
     * @Route("/", name="app_register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $form = $this->createForm(RegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();
            // encode the plain password
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
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
            if(!$this->mailer->send($message))
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

