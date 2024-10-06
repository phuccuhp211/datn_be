<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    // Lấy tất cả sản phẩm, bao gồm kích thước và gia vị
    public function all()
    {
        return $this->model->with(['sizes', 'sizes.spices'])->get();
    }

    // Tìm sản phẩm theo ID, bao gồm kích thước và gia vị
    public function find($id)
    {
        return $this->model->with(['sizes', 'sizes.spices'])->findOrFail($id);
    }

    // Tạo mới sản phẩm với kích thước và gia vị
    public function create(array $data)
    {
        // Tạo sản phẩm mới
        $product = $this->model->create($data);

        // Lưu sizes và spices
        foreach ($data['sizes'] as $sizeData) {
            $size = $product->sizes()->create([
                'size' => $sizeData['size'],
                'price' => $sizeData['price'],
                'quantity' => $sizeData['quantity'],
            ]);

            // Lưu spices
            foreach ($sizeData['spices'] as $spiceData) {
                $size->spices()->attach($spiceData['id'], [
                    'price' => $spiceData['price'],
                    'quantity' => $spiceData['quantity']
                ]);
            }
        }

        return $product->load('sizes.spices');
    }

    // Cập nhật sản phẩm
    public function update($id, array $data)
    {
        $product = $this->model->findOrFail($id);
        $product->update($data);

        // Cập nhật sizes và spices
        $product->sizes()->delete();  // Xóa kích thước cũ
        foreach ($data['sizes'] as $sizeData) {
            $size = $product->sizes()->create([
                'size' => $sizeData['size'],
                'price' => $sizeData['price'],
                'quantity' => $sizeData['quantity'],
            ]);

            // Cập nhật spices
            foreach ($sizeData['spices'] as $spiceData) {
                $size->spices()->attach($spiceData['id'], [
                    'price' => $spiceData['price'],
                    'quantity' => $spiceData['quantity']
                ]);
            }
        }

        return $product->load('sizes.spices');
    }

    // Xóa sản phẩm
    public function delete($id)
    {
        $product = $this->model->findOrFail($id);
        $product->sizes()->delete();  // Xóa các size trước khi xóa sản phẩm
        $product->delete();
        return true;
    }
}