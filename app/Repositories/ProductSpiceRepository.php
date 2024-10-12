<?php

namespace App\Repositories;

use App\Models\ProductSpice;
use Illuminate\Support\Collection;

class ProductSpiceRepository implements ProductSpiceRepositoryInterface
{
    /**
     * Select All ProductSpices
     *
     * @return mixed
     */
    public function getAll()
    {
        return ProductSpice::all();
    }

    /**
     * Select ProductSpice by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return ProductSpice::find($id);
    }

    /**
     * Select ProductSpice by Product Id
     *
     * @param int $id
     * @return mixed
     */
    public function getByProductId(int $id)
    {
        return ProductSpice::with('product')->where('product_id', $id)->get();
    }

    /**
     * Inser ProductSpice
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return ProductSpice::create($data);
    }

    /**
     * Update ProductSpice
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $ProductSpice = ProductSpice::find($id);
        if ($ProductSpice) {
            $ProductSpice->update($data);
            return $ProductSpice;
        }

        return null;
    }

    /**
     * Delete ProductSpice Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $ProductSpice = ProductSpice::find($id);
        if ($ProductSpice) {
            return $ProductSpice->delete();
        }

        return false;
    }
}
