<?php

use App\Domains\Order\Models\Order;
use App\Domains\User\Models\User;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = Order::create([
            'user_id' => User::first()->id
        ]);


    }
}
