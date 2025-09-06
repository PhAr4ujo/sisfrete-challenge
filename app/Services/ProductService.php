<?php

namespace App\Services;

use App\Repositories\Interfaces\IProductRepository;
use App\Services\Interfaces\IProductService;

class ProductService extends Service implements IProductService
{
    public function __construct(IProductRepository $repository)
    {
        parent::__construct($repository);
    }
}