<?php


namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract  class AbstractRestController extends AbstractFOSRestController
{
    protected $em;
    protected $entity;
    protected $entityRepo;
    protected $serializer;
    protected $validator;

    public function __construct($entity, EntityManagerInterface $em,
                                SerializerInterface $serializer,
                                ValidatorInterface $validator)
    {
        $this->entity = $entity;
        $this->em = $em;
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->setEntityRepo();

    }

    protected function setEntityRepo()
    {
        $this->entityRepo = $this->em->getRepository($this->entity);
    }

    protected function getEntityRepo() : EntityRepository
    {
        return $this->entityRepo;
    }

    protected function getEntityClass()
    {
        return $this->entity;
    }
}