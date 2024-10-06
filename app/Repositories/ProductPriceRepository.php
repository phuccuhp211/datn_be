<?php

namespace App\Repositories;

use App\Models\ProductPrice;
use Illuminate\Support\Collection;

class ProductPriceRepository implements ProductPriceRepositoryInterface
{
    /**
     * Select All ProductPrices
     *
     * @return mixed
     */
    public function getAll()
    {
        return ProductPrice::all();
    }

    /**
     * Select ProductPrice by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return ProductPrice::find($id);
    }

    /**
     * Inser ProductPrice
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return ProductPrice::create($data);
    }

    /**
     * Update ProductPrice
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $ProductPrice = ProductPrice::find($id);
        if ($ProductPrice) {
            $ProductPrice->update($data);
            return $ProductPrice;
        }

        return null;
    }

    /**
     * Delete ProductPrice Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $ProductPrice = ProductPrice::find($id);
        if ($ProductPrice) {
            return $ProductPrice->delete();
        }

        return false;
    }
}
