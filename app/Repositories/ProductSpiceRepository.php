<?php

namespace App\Repositories;

use App\Models\ProductSpice;
use Illuminate\Support\Collection;

class ProductSpiceRepository implements ProductSpiceRepositoryInterface
{
    /**
     * Select All ProductSpices
     *
     * @return Collection
     */
    public function getAll(): Collection
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
     * Inser ProductSpice
     *
     * @param array $ProductSpiceData
     * @return mixed
     */
    public function insert(array $ProductSpiceData)
    {
        return ProductSpice::create($ProductSpiceData);
    }

    /**
     * Update ProductSpice
     *
     * @param int $id
     * @param array $ProductSpiceData
     * @return mixed
     */
    public function update(int $id, array $ProductSpiceData)
    {
        $ProductSpice = ProductSpice::find($id);
        if ($ProductSpice) {
            $ProductSpice->update($ProductSpiceData);
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
