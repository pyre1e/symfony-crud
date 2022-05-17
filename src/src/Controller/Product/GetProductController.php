<?php

namespace App\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\DTO\ProductDTO;
use App\DTO\ProductCollectionDTO;
use App\Traits\ResponseTrait;
use App\Errors;

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
                return $this->error(new Errors\Product\NotFoundError());
            }
            
            $dto = new ProductDTO($product);

            return $this->success($dto->toJson());
        }
        else
        {
            $page = $request->get('page') ?? 1;
            $size = $request->get('size') ?? 10;

            $products = $this->productRepository->getPaginated($page, $size);

            $dto = new ProductCollectionDTO($products);

            return $this->success($dto->toJson());
        }
    }
}
