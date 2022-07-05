<?php

declare(strict_types=1);

use App\Domain\Entities\OrderItem;
use PHPUnit\Framework\TestCase;

final class OrderItemTest extends TestCase
{
    public function testShouldCheckIfItemsQuantityGreaterThanZero(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $item = new OrderItem('1', 'p1', 'Item 1', 10, -1);
    }
}
