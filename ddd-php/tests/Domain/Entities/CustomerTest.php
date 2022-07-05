<?php

declare(strict_types=1);

use App\Domain\Entities\Address;
use App\Domain\Entities\Customer;
use PHPUnit\Framework\TestCase;

final class CustomerTest extends TestCase
{
    public function testShouldThrowExceptionWhenIdIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Customer('', 'Luiz Eduardo');
    }

    public function testShouldThrowExceptionWhenNameIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Customer('123', '');
    }

    public function testShouldThrowExceptionWhenNameChangedIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $customer = new Customer('123', 'Luiz Eduardo');
        $customer->changeName('');
    }

    public function testShouldChangeName(): void
    {
        $newName = 'Luiz Eduardo Gonçalves Silva';
        $customer = new Customer('123', 'Luiz Eduardo');
        $customer->changeName($newName);

        $this->assertEquals($newName, $customer->name());
    }

    public function testShouldActivateCustomer(): void
    {
        $address = new Address(
            'Antonio Brochado',
            465,
            '38610-000',
            'Unaí'
        );
        $customer = new Customer('123', 'Joel', $address);
        $customer->activate();

        $this->assertTrue($customer->isActive());
    }

    public function testShouldThrowExceptionWhenAddressIsEmptyOnCustomerActivation(): void
    {
        $customer = new Customer('123', 'Joel');
        $this->expectException(Exception::class);
        $customer->activate();

    }

    public function testShouldDeactivateCustomer(): void
    {
        $address = new Address(
            'Antonio Brochado',
            465,
            '38610-000',
            'Unaí'
        );

        $customer = new Customer('123', 'Jaine', $address);

        $customer->activate();
        $customer->deactivate();

        $this->assertFalse($customer->isActive());
    }

    public function testShouldAddRewardPoints(): void
    {
        $customer = new Customer('123', 'Maria');

        $this->assertEquals(0, $customer->rewardPoints());

        $customer->addRewardPoints(10);

        $this->assertEquals(10, $customer->rewardPoints());

        $customer->addRewardPoints(10);

        $this->assertEquals(20, $customer->rewardPoints());
    }
}
