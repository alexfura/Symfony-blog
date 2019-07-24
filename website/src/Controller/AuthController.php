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
 * @Route("/api/v2")
 */
class AuthController extends AbstractFOSRestController
{
    private $passwordEncoder;
    private $authService;

    /**
     * AuthController constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param AuthService $authService
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, AuthService $authService)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->authService = $authService;
    }

    /**
     * @Rest\Post("/auth")
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function auth(Request $request, ValidatorInterface $validator)
    {
        $user = $this->authService->createUser($request);
        $errors = $validator->validate($user);

        if($errors->count() > 0)
        {
            $errorsString = (string) $errors;
            return new JsonResponse( 'errors:'. $errorsString, Response::HTTP_BAD_REQUEST);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $json_token = json_encode(['token' => $user->getToken()]);

        return new JsonResponse($json_token, Response::HTTP_OK);

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
            return new JsonResponse("Can't find requested user", Response::HTTP_BAD_REQUEST);
        }

        if(!$this->checkCredentials($credentials, $user))
        {
            return new JsonResponse("Invalid password", Response::HTTP_BAD_REQUEST);
        }

        if($user->isExpired())
        {
            $em = $this->getDoctrine()->getManager();
            $user->setToken($user->generateToken());
            $user->setExpiresAt($user->getExpiredDateTime("+10 days"));
            $em->merge($user);
            $em->flush();
        }

        $json_token = ['token' => $user->getToken()];

        return new JsonResponse($json_token, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Rest\Post("/resource")
     */
    public function getSecuredData(Request $request)
    {
        // handle request by AuthService
        if(!$this->authService->supports($request))
        {
            return new JsonResponse("invalid token", Response::HTTP_UNAUTHORIZED);
        }

        $data = [1, 2, 3];

        return new JsonResponse($data, Response::HTTP_OK);
    }
}