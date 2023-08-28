<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\User;



class BidsClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bids')->insert([
            'amount' => rand(10000, 30000),
            'service_id' => Service::where('type', 'auction')->first()->id,
            'price' => rand(10000, 30000),
            'user_id' => User::all()->random()->id
        ]);
    }
}
