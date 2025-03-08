<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = \App\Models\Order::all();
        foreach ($orders as $order) {
            $orderDetails = \App\Models\OrderDetail::factory()
                ->withOrder($order->id)
                ->count(5)->create();
            $order->total_price = $orderDetails->sum('total');
            $order->save();
        }
    }
}
