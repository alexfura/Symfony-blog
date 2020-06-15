<?php

namespace App\Controller;

use App\Repository\ContractRepository;
use App\Repository\ProductRepository;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class StatisticsController
 * @package App\Controller
 * @Route("/statistic")
 */
class StatisticsController extends AbstractController
{
    /**
     * @var ProductRepository $productRepository
     */
    private $productRepository;

    /**
     * @var ContractRepository $contractRepository
     */
    private $contractRepository;

    public function __construct(
        ContractRepository $contractRepository,
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
        $this->contractRepository = $contractRepository;
    }

    /**
     * @Route("/", name="statistic_index", methods={"GET"})
     * @throws DBALException
     */
    public function index(): Response
    {
        $productsWithExpiredDate = $this->productRepository->findAllProductsWithExpiryDateLessThanWeek();
        $contracts = $this->contractRepository->getContractsWithExpiredSuppliesForLast3Months();

        return $this->render('statistic/index.html.twig', [
            'products' => $productsWithExpiredDate,
            'contracts' => $contracts
        ]);
    }
}