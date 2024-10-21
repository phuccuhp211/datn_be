<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function newModel()
    {
        return new Product;
    }

    public function getAll()
    {
        return Product::with(['variants.options'])->get();
    }
    public function getById(int $id)
    {
        return Product::with(['variants.options'])->find($id);
    }

    public function create(array $data)
    {
        return Product::create($data) ?? false;
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

    public function productsByCatalog(int $catalogId)
    {
        return Product::where('product_catalog_id', $catalogId)->with(['variants.options'])->get();
    }

    public function getProductForCart(int $id)
    {
        return Product::select('id', 'name')->find($id);
    }
    
    public function filter(string $action, string $data, int $order, int $page, int $limit)
    {
        $query = Product::query();
        $query->where('out_of_stock', '=', 0);

        if ($action == 'catalog') $query->where('type', '=', $data);
        else if ($action == 'search') $query->where('name', 'like', '%' . $data . '%');

        if ($order) {
            if ($order == 1) $query->orderBy('id', 'ASC');
            else if ($order == 2) $query->orderBy('id', 'DESC');
            else if ($order == 3) $query->orderBy('name', 'ASC');
            else if ($order == 4) $query->orderBy('name', 'DESC');
            else if ($order == 3) $query->orderBy('price', 'ASC');
            else if ($order == 4) $query->orderBy('price', 'DESC');
        }

        return $query->offset(($page * $limit) - $limit)->limit($limit)->get();
    }
}