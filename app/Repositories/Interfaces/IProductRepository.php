<?php

namespace App\Repositories\Interfaces;

interface IProductRepository
{
    public function listRecords(array $filters, $paginationAmount = 15);
}