<?php

declare(strict_types=1);

use App\Domain\Entities\Order;
use App\Domain\Entities\OrderItem;
use PHPUnit\Framework\TestCase;

final class OrderTest extends TestCase
{
    public function testShouldThrowExceptionWhenIdIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $order = new Order('', '123', []);
    }

    public function testShouldThrowExceptionWhenCustomerIdIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $order = new Order('123', '', []);
    }

    public function testShouldThrowExceptionWhenItemsAreEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $order = new Order('123', '123', []);
    }

    public function testShouldCalculateTotal(): void
    {

        $items = [
            new OrderItem('1', 'p1', 'Item 1', 200, 1),
        ];

        $order = new Order('123', '123', $items);

        $this->assertEquals(200, $order->total());

        $items = [
            new OrderItem('1', 'p1', 'Item 1', 100, 2),
            new OrderItem('2', 'p2', 'Item 2', 200, 2),
        ];

        $newOrder = new Order('321', '321', $items);

        $this->assertEquals(600, $newOrder->total());
    }
}
