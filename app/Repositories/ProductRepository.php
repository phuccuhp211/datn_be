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
        return Product::with(['prices.options', 'images'])->get();
    }
    public function getById(int $id)
    {
        return Product::with(['prices.options', 'images'])->find($id);
    }

    public function create(array $data)
    {
        $product = Product::create([
            'name' => $data['name'],
            'purpose' => $data['purpose'],
            'type' => $data['type'],
        ]);

        if ($product) {
            if (isset($data['images'])) {
                foreach ($data['images'] as $image) {
                    $product->images()->create([
                        'url' => $image,
                        'reference_id' => $product->id,
                        'table' => 'products'
                    ]);
                }
            }

            foreach ($data['sizes'] as $sizeData) {
                $size = $product->prices()->create([
                    'size_name' => $sizeData['size_name'],
                    'price' => $sizeData['price'],
                    'sale' => $sizeData['sale'] ?? null,
                ]);

                foreach ($sizeData['options'] as $optionData) {
                    $size->options()->create([
                        'flavor' => $optionData['flavor'] ?? null,
                        'color' => $optionData['color'] ?? null,
                        'quantity' => $optionData['quantity'],
                    ]);
                }
            }

            return $product->load(['images', 'prices.options']);
        }

        return false;
    }

    public function update($id, array $data)
    {
        $product = Product::findOrFail($id);
        $updated = $product->update($data['product']);

        if ($updated) {
            if (isset($data['images'])) {
                $product->images()->delete();
                foreach ($data['images'] as $image) {
                    $product->images()->create(['url' => $image]);
                }
            }

            if (isset($data['sizes'])) {
                $product->prices()->delete();
                foreach ($data['sizes'] as $sizeData) {
                    $size = $product->prices()->create([
                        'size_name' => $sizeData['size_name'],
                        'price' => $sizeData['price'],
                        'sale' => $sizeData['sale'],
                    ]);

                    foreach ($sizeData['options'] as $option) {
                        $size->options()->create([
                            'flavor' => $option['flavor'] ?? null,
                            'color' => $option['color'] ?? null,
                            'quantity' => $option['quantity'],
                        ]);
                    }
                }
            }

            return $product->load(['prices.options', 'images']);
        }

        return false;
    }

    public function delete(int $id)
    {
        $target = $this->getById($id);

        return $target ? $target->delete() : false;
    }

    public function productsByCatalog(int $catalogId)
    {
        return Product::where('product_catalog_id', $catalogId)->with(['prices.options'])->get();
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
