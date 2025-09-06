<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProductFilterTestSeeder::class);
        $this->call(PaymentStatusSeeder::class);
        $this->call(CustomerTypeSeeder::class);
        $this->call(CustomerSeeder::class);
    }
}
