<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentStatus::firstOrCreate([
            'name' => 'Approved',
        ]);

        PaymentStatus::firstOrCreate([
            'name' => 'Waiting for approval',
        ]);

        PaymentStatus::firstOrCreate([
            'name' => 'Denied',
        ]);
    }
}
