<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

interface RepositoryInterface
{
    public function create($entity): void;
    public function update($entity): void;
    public function find(string $id): mixed;
    public function findAll(): array;
}
