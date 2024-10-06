<?php

namespace App\Repositories;

use App\Models\ProductCatalog;
use Illuminate\Support\Collection;

class ProductCatalogRepository implements ProductCatalogRepositoryInterface
{
    /**
     * Select All ProductCatalogs
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return ProductCatalog::all();
    }

    /**
     * Select ProductCatalog by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return ProductCatalog::find($id);
    }

    /**
     * Inser ProductCatalog
     *
     * @param array $ProductCatalogData
     * @return mixed
     */
    public function insert(array $ProductCatalogData)
    {
        return ProductCatalog::create($ProductCatalogData);
    }

    /**
     * Update ProductCatalog
     *
     * @param int $id
     * @param array $ProductCatalogData
     * @return mixed
     */
    public function update(int $id, array $ProductCatalogData)
    {
        $ProductCatalog = ProductCatalog::find($id);
        if ($ProductCatalog) {
            $ProductCatalog->update($ProductCatalogData);
            return $ProductCatalog;
        }

        return null;
    }

    /**
     * Delete ProductCatalog Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $ProductCatalog = ProductCatalog::find($id);
        if ($ProductCatalog) {
            return $ProductCatalog->delete();
        }

        return false;
    }
}
