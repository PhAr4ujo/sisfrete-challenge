<?php

namespace App\Repositories\Interfaces;

interface IOrderRepository
{
    public function insert(array $data);
    public function edit($id, $data);
}