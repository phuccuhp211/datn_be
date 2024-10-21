<?php

namespace App\Repositories;

use App\Models\ProductPrice;

class ProductPriceRepository implements ProductPriceRepositoryInterface
{
    public function getAll()
    {
        return ProductPrice::all();
    }

    public function getById(int $id)
    {
        return ProductPrice::find($id);
    }

    public function getByProductId(int $id)
    {
        return ProductPrice::with('product')->where('product_id', $id)->get();
    }

    public function create(array $data)
    {
        return ProductPrice::create($data) ?? false;
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