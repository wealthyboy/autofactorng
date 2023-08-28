<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address_id' => Address::all()->random()->id,
            'order_type' => 'User',
            'status' => 'Pending',
            'total' => 50000,
            'user_id' => User::all()->random()->id
        ];
    }
}
