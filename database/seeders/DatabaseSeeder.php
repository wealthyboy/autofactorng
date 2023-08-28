<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Wallet::factory(50)->create();
        // $this->call([
        //     BidsClassSeeder::class,
        //     WalletSeeder::class,
        // ]);

        // User::truncate();


        // foreach ($users as $k => $vs) {


        $user = new User;
        $user->name = 'JAcob';
        $user->last_name = 'Atam';
        $user->email = 'jacob.atam@gmail.com';
        $user->phone_number =  '08069389886';
        $user->address = '15 daranijo street';
        $user->state_id = '2';
        $user->city = 'lagos';
        $user->landmark = 'landmark';
        $user->username = 'username';
        $user->password = bcrypt('password');
        $user->is_verified =  1;
        $user->created_at = now();
        $user->is_old = 0;
        $user->type =  'Admin';
        $user->save();
        // }
    }
}
