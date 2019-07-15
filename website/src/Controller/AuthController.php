<?php


namespace App\Controller;
use App\Entity\User;
use App\Service\AuthService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
/**
 * Class AuthController
 * @package App\Controller
 * @Route("/api/v1")
 */
class AuthController extends AbstractFOSRestController
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * AuthController constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Rest\Post("/auth")
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function auth(Request $request, ValidatorInterface $validator)
    {
        $user = new User();
        $user->setUsername($request->get('username'));
        $user->setEmail($request->get('email'));
        $plainPassword = $request->get('password');
        $user->setPassword($this->passwordEncoder->encodePassword($user, $plainPassword));
        $user->setFirstName('first_name');
        $user->setSecondName('second_name');
        $user->setExpiresAt($user->getExpiredDateTime("+10 days"));
        $user->setStatus(true);

        $user->setToken($user->generateToken());

        $errors = $validator->validate($user);

        if($errors->count() > 0)
        {
            $errorsString = (string) $errors;
            return new JsonResponse( 'errors:'. $errorsString, 400);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new JsonResponse("user token: {$user->getToken()}", 200);

    }

    /**
     * @param $credentials
     * @param UserInterface $user
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    public function getCredentials(Request $request)
    {
        $credentials = [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
        ];

        return $credentials;
    }



    /**
     * @Rest\Post("/login")
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $this->getCredentials($request);

        // check if user exists
        $userRepo = $this->getDoctrine()->getManager()->getRepository(User::class);
        $user = $userRepo->findOneBy(['email' => $credentials['email']]);

        if(!$user)
        {
            return new JsonResponse("Can't find requested user", 400);
        }

        if(!$this->checkCredentials($credentials, $user))
        {
            return new JsonResponse("Invalid password", 400);
        }

        if($user->isExpired())
        {
            $em = $this->getDoctrine()->getManager();
            $user->setToken($user->generateToken());
            $user->setExpiresAt($user->getExpiredDateTime("+10 days"));
            $em->merge($user);
            $em->flush();
        }


        return new JsonResponse("user token: {$user->getToken()}", 200);
    }

    /**
     * @param Request $request
     * @param AuthService $authService
     * @return JsonResponse
     * @Rest\Post("/resource")
     */
    public function getSecuredData(Request $request, AuthService $authService)
    {
        // handle request by AuthService
        if(!$authService->supports($request))
        {
            return new JsonResponse("invalid token", Response::HTTP_UNAUTHORIZED);
        }

        $data = [1, 2, 3];

        return new JsonResponse($data, Response::HTTP_OK);
    }
}