<?php

namespace App\Repositories;

use App\Models\ProductOption;

class ProductOptionRepository implements ProductOptionRepositoryInterface
{
    public function getAll()
    {
        return ProductOption::all();
    }

    public function getById(int $id)
    {
        return ProductOption::find($id);
    }

    public function getByProductId(int $id)
    {
        return ProductOption::with('product')->where('product_id', $id)->get();
    }

    public function create(array $data)
    {
        return ProductOption::create($data);
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