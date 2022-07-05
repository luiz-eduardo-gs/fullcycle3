<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Exception;
use InvalidArgumentException;

class Customer
{
    public function __construct(
        private string $id,
        private string $name,
        private ?Address $address = null,
        private bool $active = false,
        private float $rewardPoints = 0
    ) {
        $this->validate();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function rewardPoints(): float
    {
        return $this->rewardPoints;
    }

    private function validate()
    {
        if (strlen($this->name) === 0) {
            throw new InvalidArgumentException('Name should not be empty');
        }

        if (strlen($this->id) === 0) {
            throw new InvalidArgumentException('Id is required');
        }
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
        $this->validate();
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function activate(): void
    {
        if (!isset($this->address)) {
            throw new Exception('Address should not be empty');
        }

        $this->active = true;
    }

    public function deactivate(): void
    {
        $this->active = false;
    }

    public function addRewardPoints(float $points): void
    {
        $this->rewardPoints += $points;
    }

    public function address(Address $address): void
    {
        $this->address = $address;
    }
}
