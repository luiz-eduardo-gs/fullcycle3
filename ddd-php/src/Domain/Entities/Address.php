<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use InvalidArgumentException;

class Address
{
    public function __construct(
        private string $street,
        private int $number,
        private string $zip,
        private string $city,
    ) {
        $this->validate();
    }

    private function validate()
    {
        if (strlen($this->street) === 0) {
            throw new InvalidArgumentException('Street is required');
        }
        if ($this->number === 0) {
            throw new InvalidArgumentException('Number is required');
        }
        if (strlen($this->zip) === 0) {
            throw new InvalidArgumentException('Zip code is required');
        }
        if (strlen($this->city) === 0) {
            throw new InvalidArgumentException('City is required');
        }
    }

    public function __toString()
    {
        return "{$this->street}, {$this->number}, {$this->city}, {$this->zip}";
    }
}
