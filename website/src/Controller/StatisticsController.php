<?php


namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductsType;
use App\Repository\ProductRepository;
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

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @Route("/")
     */
    public function index()
    {
        $products = $this->productRepository->findAllProductsWithExpiryDateLessThanWeek();

        return $this->render('statistic/index.html.twig', ['products' => $products]);
    }
}