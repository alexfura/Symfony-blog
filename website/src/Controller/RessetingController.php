<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\NewPasswordType;
use App\Form\PassResetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\PasswordResetRequest;
use Swift_Mailer;
use Swift_Message;
use DateTime;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\AuthService;

class RessetingController extends AbstractController
{
    private $mailer;
    private $encoder;
    private $entityManager;

    public function __construct(Swift_Mailer $mailer, UserPasswordEncoderInterface $passwordEncoder,
                                EntityManagerInterface $entityManager)
    {
        $this->mailer = $mailer;
        $this->encoder = $passwordEncoder;
        $this->entityManager = $entityManager;
    }

    /**
     * @param User $user
     * @return PasswordResetRequest
     * @throws \Exception
     */
    private function createResetRequest(User $user)
    {

        if($user->getResetToken())
        {
            $this->entityManager->remove($user->getResetToken());
            $this->entityManager->flush();
        }

        $reset_request = new PasswordResetRequest();
        // set data
        $reset_request->setEmail($user->getEmail());
        $reset_request->setUserId($user);
        $date = new DateTime("now");
        $date->modify("+1 day");
        $reset_request->setExpires($date);
        $reset_request->setToken($user->generateToken());
        $user->setResetToken($reset_request);
        $this->entityManager->persist($user);
        $this->entityManager->persist($reset_request);
        $this->entityManager->flush();

        return $reset_request;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     * @Route("/resseting", name="resseting")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(PassResetType::class);
        $form->handleRequest($request);

        // check if form is valid
        if ($form->isSubmitted() && $form->isValid()) {
            // check if user exists
            $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $form->get('email')->getData()]);
            if ($user) {
                $resetRequest = $this->createResetRequest($user);
                $this->sendResetEmail($resetRequest);
            }


        }

        return $this->render('resetting/index.html.twig', [
            'resetting_form' => $form->createView(),
        ]);
    }


    private function sendResetEmail(PasswordResetRequest $request)
    {
        $message = (new Swift_Message('Resetting password:'))
            ->setFrom('alexfuraog@gmail.com')
            ->setTo($request->getEmail())
            ->setBody($this->renderView('emails/reset.html.twig', [
                'email' => $request->getEmail(),
                'token' => $request->getToken()]), 'text/html');

        $this->mailer->send($message);
    }

    /**
     * @Route("resseting/{token}", name="confirm_resetting")
     * @return Response
     */
    public function confirmAction($token, Request $request)
    {
        $reset_repo = $this->entityManager->getRepository(PasswordResetRequest::class);
        $reset_request = $reset_repo->findOneBy(['token' => $token]);
        if(!$reset_request)
        {
            return new Response("invalid link");
        }

        if($reset_request->isExpired())
        {
            $this->entityManager->remove($reset_request);
            $this->entityManager->flush();
            return new Response("This link is not valid");
        }

        $form = $this->createForm(NewPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $reset_request->getUserId()->getId()]);
            $user->setPassword(
                $this->encoder->encodePassword($user, $form->get('password')->getData())
            );
            $this->entityManager->merge($user);
            $this->entityManager->remove($reset_request);
            $this->entityManager->flush();

            return $this->redirectToRoute('home');
        }


        return $this->render('resetting/new_password.html.twig', ['form' => $form->createView()]);
    }
}
