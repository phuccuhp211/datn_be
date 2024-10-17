<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(): Collection
    {
        return Product::with(['variants.options'])->get();
    }
    public function find($id)
    {
        return Product::with(['variants.options'])->find($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }
    public function delete($id)
    {
        $product = $this->find($id);
        return $product ? $product->delete() : null;
    }
    public function productsByCatalog($catalogId)
    {
        return Product::where('product_catalog_id', $catalogId)->with(['variants.options'])->get();
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