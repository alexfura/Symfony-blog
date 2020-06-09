<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductsType;
use App\Repository\ContractRepository;
use App\Repository\ProductRepository;
use App\Repository\SupplierRepository;
use App\Repository\SupplyRepository;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @var ProductRepository
     */
    private $productRepository;

    private $supplyRepository;

    private $contractRepository;

    private $supplierRepository;

    public function __construct(
        ContractRepository $contractRepository,
        ProductRepository $productRepository,
        SupplyRepository $supplyRepository,
        SupplierRepository $supplierRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->supplierRepository = $supplierRepository;
        $this->contractRepository = $contractRepository;
        $this->supplyRepository = $supplyRepository;
    }

    /**
     * @Route("/", name="statistic_index", methods={"GET"})
     * @throws DBALException
     */
    public function index(): Response
    {
        $productsWithExpiredDate = $this->productRepository->findAllProductsWithExpiryDateLessThanWeek();
        $supplies = $this->supplyRepository->getSuppliesForEachProductPerMonth();
        $contracts = $this->contractRepository->getContractsWithExpiredSuppliesForLastNMonths(3);
        $suppliers = $this->supplierRepository->getSuppliersRatedByExpiredContractCount();

        return $this->render('statistic/index.html.twig', [
            'products' => $productsWithExpiredDate,
        ]);
    }
}