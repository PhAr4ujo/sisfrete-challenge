<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = CustomerType::all();

        foreach ($types as $type) {
            Customer::firstOrCreate(
                ['email' => strtolower($type->name).'@example.com'], 
                [
                    'name' => $type->name.' Customer',
                    'password' => Hash::make('password123'),
                    'national_identification' => 'ID'.$type->id.'001',
                    'customer_type_id' => $type->id,
                ]
            );
        }
    }
}
