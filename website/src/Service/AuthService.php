<?php


namespace App\Service;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * AuthService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
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