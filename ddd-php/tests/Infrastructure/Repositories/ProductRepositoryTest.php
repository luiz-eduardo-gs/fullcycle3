<?php

declare(strict_types=1);

use App\Domain\Entities\Product;
use App\Infrastructure\Repositories\ProductRepository;
use PHPUnit\Framework\TestCase;

final class ProductRepositoryTest extends TestCase
{
    public function testShouldCreateAProduct():void
    {
        $productRepository = new ProductRepository();
        // $product = new Product('2', 'Product 1', 1000);
        // $productRepository->create($product);

        $productModel = $productRepository->find('1');

        var_dump($productModel);
    }
}