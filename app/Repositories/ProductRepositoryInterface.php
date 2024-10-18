<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function getAll();

    public function getById(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function productsByCatalog(int $catalogId);

    public function getProductForCart(int $id);
    
    public function filter(string $action, string $data, int $order, int $page, int $limit);
}