<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\Facades\DB;

class ProductFilterTestSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('product_product_type')->truncate();
        Product::truncate();
        ProductType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $electronics = ProductType::create(['name' => 'Electronics', 'description' => 'Devices and gadgets']);
        $furniture   = ProductType::create(['name' => 'Furniture', 'description' => 'Home and office furniture']);
        $clothing    = ProductType::create(['name' => 'Clothing', 'description' => 'Apparel and accessories']);

        $products = [
            ['name' => 'Smartphone',  'description' => 'Latest model smartphone', 'price' => 999.99],
            ['name' => 'Laptop',      'description' => 'Powerful gaming laptop',  'price' => 1499.99],
            ['name' => 'Desk',        'description' => 'Wooden office desk',      'price' => 249.99],
            ['name' => 'Chair',       'description' => 'Ergonomic office chair',  'price' => 199.99],
            ['name' => 'T-Shirt',     'description' => 'Cotton t-shirt',          'price' => 19.99],
            ['name' => 'Jeans',       'description' => 'Blue denim jeans',        'price' => 49.99],
            ['name' => 'Headphones',  'description' => 'Noise cancelling',        'price' => 299.99],
            ['name' => 'Sofa',        'description' => 'Comfortable 3-seat sofa', 'price' => 799.99],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }

        Product::where('name', 'Smartphone')->first()->productTypes()->attach($electronics->id);
        Product::where('name', 'Laptop')->first()->productTypes()->attach($electronics->id);
        Product::where('name', 'Headphones')->first()->productTypes()->attach($electronics->id);

        Product::where('name', 'Desk')->first()->productTypes()->attach($furniture->id);
        Product::where('name', 'Chair')->first()->productTypes()->attach($furniture->id);
        Product::where('name', 'Sofa')->first()->productTypes()->attach($furniture->id);

        Product::where('name', 'T-Shirt')->first()->productTypes()->attach($clothing->id);
        Product::where('name', 'Jeans')->first()->productTypes()->attach($clothing->id);

        $multiTypeProduct = Product::create([
            'name' => 'Smartwatch',
            'description' => 'Wearable tech device',
            'price' => 499.99
        ]);
        $multiTypeProduct->productTypes()->attach([$electronics->id, $clothing->id]);
    }
}
