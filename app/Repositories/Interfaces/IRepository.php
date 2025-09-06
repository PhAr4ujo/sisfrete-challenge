<?php

namespace App\Repositories\Interfaces;

interface IRepository
{
    public function listRecords(array $filters, int $paginationAmount);
    public function insert($data);
    public function edit($id, $data);
    public function delete($id);
}
