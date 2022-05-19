<?php

namespace App\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Trait\ResponseTrait;
use App\Error;

#[Route('/api/product', name: 'app_product_get', methods: ['GET'])]
class GetProductController extends AbstractController
{
    use ResponseTrait;

    public function __construct(
        private ProductRepository $productRepository
    ) {}

    public function __invoke(Request $request): Response
    {
        if ($id = $request->get('id')) 
        {            
            $product = $this->productRepository->find($id);

            if (!$product) {
                return $this->error(new Error\Product\NotFoundError());
            }

            return $this->success($product);
        }
        else
        {
            $page = $request->get('page') ?? 1;
            $size = $request->get('size') ?? 10;

            $products = $this->productRepository->getPaginated($page, $size);

            return $this->success($products);
        }
    }
}
