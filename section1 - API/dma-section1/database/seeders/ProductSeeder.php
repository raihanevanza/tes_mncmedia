<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_schema')->insert([
            'item_name' => 'Joni',
            'quantity' => 1,
            'totalcostofgoods_sold' => 5000,
            'totalprice_sold' => 2000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
