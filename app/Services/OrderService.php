<?php

namespace App\Services;

use App\Repositories\Interfaces\IOrderRepository;
use App\Services\Interfaces\IOrderService;

class OrderService extends Service implements IOrderService
{
    public function __construct(IOrderRepository $repository)
    {
        parent::__construct($repository);
    }
}