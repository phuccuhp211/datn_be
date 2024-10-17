<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductCatalogRepositoryInterface;
use Illuminate\Http\Request;

class ProductCatalogController extends Controller
{
    protected $productCatalogRepository;

    public function __construct(ProductCatalogRepositoryInterface $productCatalogRepository)
    {
        $this->productCatalogRepository = $productCatalogRepository;
    }

    // Lấy tất cả danh mục sản phẩm
    public function index()
    {
        $catalogs = $this->productCatalogRepository->all();
        return response()->json($catalogs);
    }

    // Lấy danh mục sản phẩm theo ID
    public function show($id)
    {
        $catalog = $this->productCatalogRepository->findById($id);
        return response()->json($catalog);
    }

    // Tạo danh mục sản phẩm mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:product_catalogs',
            'index' => 'required|integer',
        ]);

        $catalog = $this->productCatalogRepository->create($validatedData);
        return response()->json($catalog, 201);
    }

    // Cập nhật danh mục sản phẩm
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:product_catalogs,slug,' . $id,
            'index' => 'sometimes|required|integer',
        ]);

        $catalog = $this->productCatalogRepository->update($id, $validatedData);
        return response()->json($catalog);
    }

    // Xóa danh mục sản phẩm
    public function destroy($id)
    {
        $this->productCatalogRepository->delete($id);
        return response()->json(null, 204);
    }
}