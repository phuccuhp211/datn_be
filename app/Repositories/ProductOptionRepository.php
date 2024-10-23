<?php

namespace App\Repositories;

use Exception;
use App\Models\ProductOption;

class ProductOptionRepository implements ProductOptionRepositoryInterface
{
    public function newModel()
    {
        return new ProductOption;
    }

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
        return ProductOption::create($data) ?? false;
    }

    public function insertMany(int $id, array $data)
    {
        try {
            $oldRecord = ProductOption::where(["price_id" => $id])->pluck('id')->toArray();
            if (ProductOption::destroy($oldRecord) && ProductOption::insert($data)) return true;
            else return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
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