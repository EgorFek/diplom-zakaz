<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['status' => 'На удержании'],
            ['status' => 'Доставлен'],
            ['status' => 'Оплачен'],
            ['status' => 'Отменен'],
        ];

        foreach ($statuses as $status) {
            OrderStatus::create($status);
        }
    }
}
