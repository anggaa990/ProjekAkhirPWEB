<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RestaurantTable;

class RestaurantTableSeeder extends Seeder
{
    public function run(): void
    {
        $tables = [
            ['name' => 'Meja 1', 'capacity' => 2, 'status' => 'available'],
            ['name' => 'Meja 2', 'capacity' => 2, 'status' => 'available'],
            ['name' => 'Meja 3', 'capacity' => 4, 'status' => 'available'],
            ['name' => 'Meja 4', 'capacity' => 4, 'status' => 'available'],
            ['name' => 'Meja 5', 'capacity' => 6, 'status' => 'available'],
            ['name' => 'Meja 6', 'capacity' => 6, 'status' => 'available'],
            ['name' => 'Meja 7', 'capacity' => 8, 'status' => 'available'],
            ['name' => 'Meja 8', 'capacity' => 4, 'status' => 'available'],
            ['name' => 'Meja VIP 1', 'capacity' => 10, 'status' => 'available'],
            ['name' => 'Meja VIP 2', 'capacity' => 10, 'status' => 'available'],
        ];

        foreach ($tables as $table) {
            RestaurantTable::create($table);
        }
    }
}