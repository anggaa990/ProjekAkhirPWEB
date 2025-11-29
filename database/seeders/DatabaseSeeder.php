<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Menu;
use App\Models\RestaurantTable;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create(['name'=>'Admin','email'=>'admin@example.com','password'=>bcrypt('password'),'role'=>'admin']);
        User::create(['name'=>'Karyawan','email'=>'staff@example.com','password'=>bcrypt('password'),'role'=>'employee']);

        Category::insert([
            ['name'=>'Seafood','description'=>null],
            ['name'=>'Junkfood','description'=>null],
            ['name'=>'Juice','description'=>null],
            ['name'=>'Softdrink','description'=>null]
        ]);

        Menu::create(['name'=>'Nasi Goreng','price'=>20000,'stock'=>50,'category_id'=>2]);
        Menu::create(['name'=>'Udang Goreng','price'=>50000,'stock'=>20,'category_id'=>1]);
        Menu::create(['name'=>'Jus Alpukat','price'=>25000,'stock'=>30,'category_id'=>3]);

        for($i=1;$i<=10;$i++){
            RestaurantTable::create(['name'=>'Meja ' . $i,'capacity'=>4]);
        }
    }
}
