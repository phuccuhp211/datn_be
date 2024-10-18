<?php

namespace App\Repositories;

use App\Models\ProductSpice;
use Illuminate\Support\Collection;

class ProductSpiceRepository implements ProductSpiceRepositoryInterface
{
    public function getAll()
    {
        return ProductSpice::all();
    }

    public function getById(int $id)
    {
        return ProductSpice::find($id);
    }

    public function getByProductId(int $id)
    {
        return ProductSpice::with('product')->where('product_id', $id)->get();
    }

    public function insert(array $data)
    {
        return ProductSpice::create($data);
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