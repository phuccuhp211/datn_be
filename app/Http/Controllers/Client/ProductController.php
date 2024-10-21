<?php

namespace App\Http\Controllers\Client;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->all();
        $result = $this->formatProducts($products);
        return response()->json($result);
    }

    public function show($id)
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $result = $this->formatProducts(collect([$product])); // Chuyển đổi sang collection
        return response()->json($result[0]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|integer',
            'images' => 'nullable|json',
        ]);

        $product = $this->productRepository->create($data);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|integer',
            'images' => 'nullable|json',
        ]);

        $updatedProduct = $this->productRepository->update($id, $data);
        if (!$updatedProduct) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $result = $this->formatProducts(collect([$updatedProduct])); // Chuyển đổi sang collection
        return response()->json($result[0]);
    }

    public function destroy($id)
    {
        $deleted = $this->productRepository->delete($id);
        if (!$deleted) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function productsByCatalog($catalogId)
    {
        $products = $this->productRepository->productsByCatalog($catalogId);
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found in this catalog.'], 404);
        }
        $result = $this->formatProducts($products);
        return response()->json($result);
    }

    public function filterProducts(Request $request)
    {
        $data = $request->validate([
            'action' => 'required|string',
            'data' => 'required|string',
            'order' => 'required|integer',
            'page' => 'required|integer',
            'limit' => 'required|integer',
        ]);

        $products = $this->productRepository->filter($data['action'], $data['data'], $data['order'], $data['page'], $data['limit']);

        return response()->json($products);
    }

    private function formatProducts($products)
    {
        return $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'type' => $product->type,
                'images' => $product->images->pluck('url'),
                'sizes' => $product->sizes->map(function ($size) use ($product) {
                    return [
                        'id' => $size->id,
                        'price' => $size->price,
                        'discount_price' => $size->discount_price,
                        'size' => $size->size,
                        'options' => $size->options->map(function ($option) use ($product) {
                            if ($product->type == 1) {
                                // Nếu là sản phẩm thức ăn (type == 1)
                                return [
                                    'flavor' => $option->flavor,
                                    'quantity' => $option->quantity,
                                ];
                            } else {
                                // Nếu là các sản phẩm khác (ví dụ: quần áo)
                                return [
                                    'color' => $option->color,
                                    'quantity' => $option->quantity,
                                ];
                            }
                        }),
                    ];
                }),
            ];
        });
    }
}
