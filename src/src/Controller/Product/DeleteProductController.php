<?php

namespace App\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Entity\Product;
use App\Traits\ResponseTrait;
use App\Errors;

#[Route('/api/product', name: 'app_product_delete', methods: ['DELETE'])]
class DeleteProductController extends AbstractController
{
    use ResponseTrait;

    public function __construct(
        private ProductRepository $productRepository,
        private ValidatorInterface $validator
    ) {}

    public function __invoke(Request $request): Response
    {
        $product = $this->productRepository->find((int)$request->get('id'));

        if (!$product) {
            return $this->error(new Errors\Product\NotFoundError());
        }

        $this->productRepository->remove($product, true);

        return $this->success();
    }
}
