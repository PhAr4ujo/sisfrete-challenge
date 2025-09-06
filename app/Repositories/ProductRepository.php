<?php

namespace App\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Interfaces\IProductRepository;

class ProductRepository extends Repository implements IProductRepository
{
    public function model()
    {
        return Product::class;
    }

    public function listRecords(array $filters, $paginationAmount = 15)
    {
        $query = $this->model->query();

        foreach ($filters as $name => $value) {
            if ($value !== null) {
                if ($name === 'product_type') {
                    $query->whereHas('productTypes', function ($q) use ($value) {
                        if (is_array($value)) {
                            $q->whereIn('name', $value);
                        } else {
                            $q->where('name', 'LIKE', "%{$value}%");
                        }
                    });
                } elseif ($name === 'price') {
                    if (is_array($value) && isset($value['operator'], $value['value']) && $value['value'] !== null) {
                        $query->where('price', $value['operator'], $value['value']);
                    }
                }
                else {
                    $query->where($name, 'LIKE', "%{$value}%");
                }
            }
        }

        $records = $query->paginate($paginationAmount);

        $records->getCollection()->transform(fn($product) => new ProductResource($product));

        return $records;
    }
}