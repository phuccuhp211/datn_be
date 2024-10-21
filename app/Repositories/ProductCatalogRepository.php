<?php

namespace App\Repositories;

use App\Models\ProductCatalog;

class ProductCatalogRepository implements ProductCatalogRepositoryInterface
{
    public function newModel()
    {
        return new ProductCatalog;
    }

    public function getAll()
    {
        return ProductCatalog::all();
    }

    public function getById(int $id)
    {
        return ProductCatalog::find($id);
    }

    public function create(array $data)
    {
        return ProductCatalog::create($data) ?? false;
    }

    public function update(int $id, array $data)
    {
        $target = $this->getById($id);

        return $target ? $target->update($data) : false;
    }

    public function delete(int $id)
    {
        $target = $this->getById($id);

        return $target ? $target->delete() : false;
    }
}