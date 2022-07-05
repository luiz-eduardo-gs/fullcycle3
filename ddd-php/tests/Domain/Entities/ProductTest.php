<?php

declare(strict_types=1);

use App\Domain\Entities\Address;
use App\Domain\Entities\Customer;
use App\Domain\Entities\Product;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    public function testShouldThrowExceptionWhenIdIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Product('', 'Product 1', 10);
    }

    public function testShouldThrowExceptionWhenNameIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Product('123', '', 10);
    }

    public function testShouldThrowExceptionWhenPriceIsLessOrEqualsToZero(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Product('123', 'Product 1', -1);
    }

    public function testShouldChangeName(): void
    {
        $newName = 'Prod 1';
        $product = new Product('123', 'Product 1', 10);
        $product->changeName($newName);

        $this->assertEquals($newName, $product->name());
    }

    public function testShouldChangePrice(): void
    {
        $product = new Product('123', 'Product 1', 10);
        $product->changePrice(20);

        $this->assertEquals(20, $product->price());
    }
}
