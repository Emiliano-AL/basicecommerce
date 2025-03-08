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
                ->withOrderId($order->id)
                ->count(5)->create();
            $order->amount = $orderDetails->sum('total');
            $order->save();
        }
    }
}
