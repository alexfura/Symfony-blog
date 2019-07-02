<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\NewPasswordType;
use App\Form\PassResetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\PasswordResetRequest;
use Swift_Mailer;
use Swift_Message;
use DateTime;

class RessetingController extends AbstractController
{
    private $mailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
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
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            // check if user exists
            $user = $em->getRepository(User::class)->findOneBy(['email' => $form->get('email')->getData()]);
            if($user)
            {
                $resetting = new PasswordResetRequest();
                $resetting->setEmail($user->getEmail());

                $date = new DateTime("now");
                $date->modify("+1 day");
                //
                $resetting->setExpires($date);
                $resetting->setToken(User::generateToken());

                $em->persist($resetting);
                $em->flush();

                $this->sendResetEmail($resetting);
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
     * @param PasswordResetRequest $resetting
     * @return Response
     */
    public function confirmAction(PasswordResetRequest $resetting)
    {
        $form = $form = $this->createForm(NewPasswordType::class);
        $em = $this->getDoctrine()->getManager();

        if(!$resetting->isExpired())
        {
            if($form->isSubmitted() && $form->isValid())
            {
                $user = $em->getRepository(User::class)->findOneBy(['email' => $resetting->getEmail()]);

                $user->setPassword($form->get('password'));

                $em->merge($user);
                $em->remove($resetting);
                $em->flush();
            }
            return $this->render('resetting/new_password.html.twig', [
            'password_form' => $form->createView(),
            ]);
        }

        $em->remove($resetting);
        $em->flush();
        return new Response("This link is not valid");
    }
}
