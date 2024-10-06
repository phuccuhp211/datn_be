<?php



namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    // Lấy tất cả sản phẩm
    public function index()
    {
        return response()->json($this->productRepository->all());
    }
    
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }

        return response()->json($product);
    }

    // Tạo sản phẩm mới
    public function store(Request $request)
    {
        $validatedData = $this->validateProduct($request);
        $product = $this->productRepository->create($validatedData);
        return response()->json($product, 201);
    }

    // Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateProduct($request);

        $product = $this->productRepository->update($id, $validatedData);

        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }

        return response()->json($product);
    }


    // Xóa sản phẩm
    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return response()->json(['message' => 'Sản phẩm đã được xóa thành công.']);
    }

    // Hàm validate dữ liệu
    private function validateProduct(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|integer',
            'purpose' => 'nullable|string',
            'language' => 'required|string|max:2',
            'sizes' => 'required|array',
            'sizes.*.size' => 'required|string|max:255',
            'sizes.*.price' => 'required|integer|min:0',
            'sizes.*.quantity' => 'required|integer|min:0',
            'sizes.*.spices' => 'nullable|array',
            'sizes.*.spices.*.name' => 'required|string|max:255',
            'sizes.*.spices.*.quantity' => 'required|integer|min:0'
        ]);
    }
}