<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductPriceRepositoryInterface;
use App\Repositories\ProductOptionRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $productRepo;
    protected $productPriceRepo;
    protected $productOptionRepo;
    protected $imageRepo;

    public function __construct(
        ProductRepositoryInterface $productRepo,
        ProductPriceRepositoryInterface $productPriceRepo,
        ProductOptionRepositoryInterface $productOptionRepo,
        ImageRepositoryInterface $imageRepo
    ) {
        $this->productRepo = $productRepo;
        $this->productPriceRepo = $productPriceRepo;
        $this->productOptionRepo = $productOptionRepo;
        $this->imageRepo = $imageRepo;
    }
    
    public function index()
    {
        $products = Product::with(['prices.options', 'images'])->get();
        return response()->json($this->formatProducts($products));
    }

    public function show($id)
    {
        $product = Product::with(['prices.options', 'images'])->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($this->formatProducts(collect([$product]))[0]);
    }

    private function formatProducts($products)
    {
        return $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'purpose' => $product->purpose,
                'type' => $product->type,
                'images' => $product->images->pluck('url')->toArray(),
                'prices' => $product->prices->map(function ($price) {
                    return [
                        'id' => $price->id,
                        'name' => $price->name,
                        'price' => $price->price,
                        'sale' => $price->sale,
                        'options' => $price->options->map(function ($option) use ($price) {

                            return ['name' => $option->name, 'quantity' => $option->quantity];
                        })->toArray(),
                    ];
                })->toArray(),
            ];
        });
    }
}