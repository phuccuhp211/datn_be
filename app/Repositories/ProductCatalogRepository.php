<?php

namespace App\Repositories;

use App\Models\ProductCatalog;
use App\Interfaces\ProductCatalogRepositoryInterface;

class ProductCatalogRepository implements ProductCatalogRepositoryInterface
{
    public function all()
    {
        return ProductCatalog::all();
    }

    public function findById($id)
    {
        return ProductCatalog::findOrFail($id);
    }

    public function create(array $data)
    {
        return ProductCatalog::create($data);
    }

    public function update($id, array $data)
    {
        $catalog = $this->findById($id);
        $catalog->update($data);
        return $catalog;
    }

    public function delete($id)
    {
        $catalog = $this->findById($id);
        $catalog->delete();
    }
}
