<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\ProductRepositoryInterface;
use App\Infrastructure\Db\Product as ProductModel;
use App\Infrastructure\Helpers\EntityManagerFactory;

class ProductRepository implements ProductRepositoryInterface
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = EntityManagerFactory::getEntityManager();
    }

    public function create($entity): void
    {
        $product = new ProductModel();
        $product->setId($entity->id())
            ->setName($entity->name())
            ->setPrice($entity->price());

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function update($entity): void
    {
        //
    }

    public function find(string $id): mixed
    {
        return $this->entityManager
            ->getRepository(ProductModel::class)
            ->find($id);
    }

    public function findAll(): array
    {
        return [];
    }
}
