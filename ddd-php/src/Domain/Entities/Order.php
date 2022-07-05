<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use InvalidArgumentException;

class Order
{
    public function __construct(
        private string $id,
        private string $customerId,
        private array $items = [],
    ) {
        $this->total = $this->total();
        $this->validate();
    }

    private function validate()
    {
        if (strlen($this->id) === 0) {
            throw new InvalidArgumentException('Id is required');
        }
        
        if (strlen($this->customerId) === 0) {
            throw new InvalidArgumentException('CustomerID is required');
        }

        if (count($this->items) === 0) {
            throw new InvalidArgumentException('Item quantity must be greater than zero');
        }
    }

    public function total(): float
    {
        return array_reduce($this->items, function ($acc, $item) {
            return $acc + $item->price(); 
        }, 0);
    }
}
