<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class CustomerClassTest extends TestCase
{
    /** @dataProvider customerClassProvider */
    public function test_customer_class_uses_order_count_thresholds(int $orders, string $expected): void
    {
        $user = (new \ReflectionClass(User::class))->newInstanceWithoutConstructor();
        $user->setRawAttributes(['orders_count' => $orders]);

        $this->assertSame($expected, $user->customer_class);
    }

    public function customerClassProvider(): array
    {
        return [
            '25 is regular' => [25, 'Regular Customer'],
            '26 is silver' => [26, 'Silver Customer'],
            '35 is silver' => [35, 'Silver Customer'],
            '36 is gold' => [36, 'Gold Customer'],
            '60 is gold' => [60, 'Gold Customer'],
            '61 is black' => [61, 'Black Customer'],
            '100 is black' => [100, 'Black Customer'],
            '101 is platinum' => [101, 'Platinum Customer'],
        ];
    }
}
