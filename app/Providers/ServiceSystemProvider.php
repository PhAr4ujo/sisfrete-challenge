<?php

namespace App\Providers;

use App\Services\Interfaces\IOrderService;
use App\Services\Interfaces\IProductService;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class ServiceSystemProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IOrderService::class, OrderService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
