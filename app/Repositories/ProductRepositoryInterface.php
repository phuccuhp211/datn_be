<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function all(): Collection;
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function productsByCatalog($catalogId);
    public function filter(string $action, string $data, int $order, int $page, int $limit);
}