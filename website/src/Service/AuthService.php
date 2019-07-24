<?php


namespace App\Service;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * Class AuthService
 * @package App\Service
 */
class AuthService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    private $passwordEncoder;
    /**
     * AuthService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->em = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param $token
     * @return User|object|null
     * Get by token or null
     */
    private function getUser($token)
    {
        $userRepo = $this->em->getRepository(User::class);
        $user = $userRepo->findOneBy(['token' => $token]);

        return $user;
    }

    /**
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request)
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
        return $user;
    }

    /**
     * @param $token_string
     * @return mixed|null
     * Parse token
     */
    private function getToken($token_string)
    {
        if(!empty($token_string))
        {
            if(preg_match('/Bearer\s(\S+)/', $token_string, $matches))
            {
                return $matches[1];
            }
        }

        return null;
    }

    public function updateToken()
    {

    }

    /**
     * @param Request $request
     * @return User|object|null
     *  if current request supports authorization token returns User
     *  else null
     */
    public function supports(Request $request)
    {
        $header_list = $request->headers;
        // check if request headed has Authorization
        if(!$header_list->has('Authorization'))
        {
            return null;
        }
        $token = $this->getToken($header_list->get('Authorization'));
        return $this->getUser($token);
    }
}