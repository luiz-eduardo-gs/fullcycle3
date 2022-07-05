<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use InvalidArgumentException;

class OrderItem
{
    public function __construct(
        private string $id,
        private string $productId,
        private string $name,
        private float $price,
        private int $quantity
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if ($this->quantity <= 0) {
            throw new InvalidArgumentException('Quantity must be greater than zero');
        }
    }

    public function price(): float
    {
        return $this->price * $this->quantity;
    }
}
