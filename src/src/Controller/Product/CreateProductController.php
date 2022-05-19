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
use App\Trait\ResponseTrait;
use App\Error;

#[Route('/api/product', name: 'app_product_add', methods: ['POST'])]
class CreateProductController extends AbstractController
{
    use ResponseTrait;

    public function __construct(
        private ProductRepository $productRepository,
        private ValidatorInterface $validator
    ) {}

    public function __invoke(Request $request): Response
    {
        $errors = $this->validator->validate($data = $request->toArray(), new Constraints\Collection([
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

        $product = new Product();
        $product->setName($data['name']);
        $product->setPrice($data['price']);

        $this->productRepository->add($product, true);

        return $this->success([
            'id' => $product->getId()
        ]);
    }
}
