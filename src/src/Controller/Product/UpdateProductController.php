<?php

namespace App\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Trait\ResponseTrait;
use App\Error;

#[Route('/api/product', name: 'app_product_update', methods: ['PUT'])]
class UpdateProductController extends AbstractController
{
    use ResponseTrait;

    public function __construct(
        private ProductRepository $productRepository,
        private ValidatorInterface $validator
    ) {}

    public function __invoke(Request $request): Response
    {
        $errors = $this->validator->validate($data = $request->toArray(), new Constraints\Collection([
            'id' => [
                new Constraints\Type('int')
            ],
            'name' => [
                new Constraints\Type('string'),
                new Constraints\NotBlank(),
            ],
            'price' => [
                new Constraints\Type('int'),
                new Constraints\PositiveOrZero()
            ]
        ]));

        if (count($errors) > 0) {
            return $this->error(new Error\InvalidRequest($errors));
        }

        $product = $this->productRepository->find($data['id']);

        if (!$product) {
            return $this->error(new Error\Product\NotFoundError());
        }

        $product->setName($data['name']);
        $product->setPrice($data['price']);

        $this->productRepository->flush();

        return $this->success();
    }
}
