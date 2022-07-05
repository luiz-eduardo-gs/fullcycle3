<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use InvalidArgumentException;

class Product
{
    public function __construct(
        private string $id,
        private string $name,
        private float $price
    ) {
        $this->validate();
    }

    private function validate()
    {
        if (strlen($this->name) === 0) {
            throw new InvalidArgumentException('Name should not be empty');
        }

        if (strlen($this->id) === 0) {
            throw new InvalidArgumentException('Id is required');
        }

        if ($this->price <= 0) {
            throw new InvalidArgumentException('Price must be greater than zero');
        }
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
        $this->validate();
    }

    public function changePrice(float $price): void
    {
        $this->price = $price;
        $this->validate();
    }
}
