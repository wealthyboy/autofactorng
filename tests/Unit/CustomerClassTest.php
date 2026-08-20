<?php

namespace Tests\Unit;

use App\Models\User;
use Carbon\Carbon;
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
            'zero is silver' => [0, 'Silver Customer'],
            '19 is silver' => [19, 'Silver Customer'],
            '20 is silver' => [20, 'Silver Customer'],
            '30 is silver' => [30, 'Silver Customer'],
            '31 is gold' => [31, 'Gold Customer'],
            '50 is gold' => [50, 'Gold Customer'],
            '51 is black' => [51, 'Black Customer'],
            '80 is black' => [80, 'Black Customer'],
            '81 is platinum' => [81, 'Platinum Customer'],
        ];
    }

    public function test_customer_listing_includes_the_order_count(): void
    {
        $user = (new \ReflectionClass(User::class))->newInstanceWithoutConstructor();
        $user->setRawAttributes([
            'id' => 1,
            'name' => 'Ada',
            'last_name' => 'Okafor',
            'email' => 'ada@example.com',
            'phone_number' => '08000000000',
            'orders_count' => 12,
            'created_at' => Carbon::parse('2026-08-20'),
        ]);
        $user->setRelation('users_permission', null);
        $user->setRelation('wallet_balance', null);

        $row = $user->getListingData(collect([$user]))->first();

        $this->assertSame(12, $row['Orders']);
    }
}
