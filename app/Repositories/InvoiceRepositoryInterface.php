<?php

namespace App\Repositories;

interface InvoiceRepositoryInterface
{
    public function newModel();
    
    public function getAll();

    public function getById(int $id);

    public function getByUserId($userId);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}
