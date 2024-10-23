<?php

namespace App\Repositories;

use Exception;
use App\Models\ProductPrice;

class ProductPriceRepository implements ProductPriceRepositoryInterface
{
    public function newModel()
    {
        return new ProductPrice;
    }

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

    public function insertMany(string $table, int $id, array $data)
    {
        try {
            $oldRecord = ProductPrice::where(["table" => $table, "id_reference" => $id])->pluck('id')->toArray();
            if (ProductPrice::destroy($oldRecord) && ProductPrice::insert($data)) return true;
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