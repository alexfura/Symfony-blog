<?php


namespace App\Service;
use Symfony\Component\HttpKernel\Exception\HttpException;

use App\Entity\Post;
use App\Entity\Topic;
use App\Entity\User;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class CircularReferenceHandler
{
    public function __invoke($object)
    {
    }
}