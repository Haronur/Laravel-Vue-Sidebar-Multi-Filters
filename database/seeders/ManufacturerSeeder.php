<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(\App\Models\Manufacturer::class, 5)->create(); // < Laravel Verssion 8
        \App\Models\Manufacturer::factory()->count(5)->create();
    }
}
