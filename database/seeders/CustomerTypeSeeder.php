<?php

namespace Database\Seeders;

use App\Models\CustomerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerType::firstOrCreate(
            ['name' => 'Enterprise'], 
            ['description' => 'Enterprise customer']
        );

        CustomerType::firstOrCreate(
            ['name' => 'Physical'], 
            ['description' => 'Physical customer']
        );
    }
}
