<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductPriceRepositoryInterface;
use App\Repositories\ProductOptionRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $productRepository;
    protected $productPriceRepository;
    protected $productOptionRepository;
    protected $imageRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductPriceRepositoryInterface $productPriceRepository,
        ProductOptionRepositoryInterface $productOptionRepository,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productPriceRepository = $productPriceRepository;
        $this->productOptionRepository = $productOptionRepository;
        $this->imageRepository = $imageRepository;
    }
    
    public function getAll()
    {
        try {
            $products = Product::with(['prices.options', 'images'])->get();
            $data = $this->formatProducts($products);
            if ($data) {
                $this->response['data'] = $data;
                $this->response['status'] = true;
            }
            return response()->json($this->response);
        } catch(Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function getById($id)
    {
        try {
            $data = Product::with(['prices.options', 'images'])->find($id);

            if ($data) {
                $this->response['data'] = $this->formatProducts(collect([$data]))[0];
                $this->response['status'] = true;
                return response()->json($this->response);
            }
            else {
                $this->response['message'] = 'Product not found!';
                return response()->json($this->response, 404);
            }
        } catch(Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    private function formatProducts($products)
    {
        try {
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
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}