<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Select All Products
     *
     * @return mixed
     */
    public function getAll()
    {
        return Product::all();
    }

    /**
     * Select Product by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return Product::find($id);
    }

    /**
     * Inser Product
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return Product::create($data);
    }

    /**
     * Update Product
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $Product = Product::find($id);
        if ($Product) {
            $Product->update($data);
            return $Product;
        }

        return null;
    }

    /**
     * Delete Product Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $Product = Product::find($id);
        if ($Product) {
            return $Product->delete();
        }

        return false;
    }
}
