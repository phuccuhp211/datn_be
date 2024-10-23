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
        $products = $this->productRepository->getAll();
        $result = $this->formatProducts($products);
        return response()->json($result);
    }

    public function show($id)
    {
        $product = $this->productRepository->getById($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $result = $this->formatProducts(collect([$product]));
        return response()->json($result[0]);
    }

    public function store(Request $request)
    {
        $product = $this->productRepository->create($request->all());
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = $this->productRepository->update($id, $request->all());
        return response()->json($product);
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
        return response()->json($products);
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
                'purpose' => $product->purpose,
                'type' => $product->type,
                'images' => $product->images->pluck('url'),
                'sizes' => $product->prices->map(function ($size) use ($product) {
                    return [
                        'id' => $size->id,
                        'price' => $size->price,
                        'sale' => $size->sale,
                        'size_name' => $size->size_name,
                        'options' => $size->options->map(function ($option) use ($product) {
                            if ($product->type == 1) {
                                return [
                                    'flavor' => $option->flavor,
                                    'quantity' => $option->quantity,
                                ];
                            } else {
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
