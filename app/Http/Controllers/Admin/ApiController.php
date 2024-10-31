<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\AnimalRepositoryInterface;
use App\Repositories\AnimalCatalogRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductCatalogRepositoryInterface;
use App\Repositories\ProductPriceRepositoryInterface;
use App\Repositories\ProductOptionRepositoryInterface;
use App\Repositories\FormRequestRepositoryInterface;
use App\Repositories\InvoiceRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\SponsorRepositoryInterface;
use App\Repositories\StoryRepositoryInterface;
use App\Repositories\StoryCatalogRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class ApiController extends Controller
{
    protected $animalRepository;
    protected $animalCatalogRepository;
    protected $productRepository;
    protected $productPriceRepository;
    protected $productCatalogRepository;
    protected $productOptionRepository;
    protected $formRequestRepository;
    protected $invoiceRepository;
    protected $imageRepository;
    protected $sponsorRepository;
    protected $storyRepository;
    protected $storyCatalogRepository;
    protected $userRepository;
    protected $response;

    public function __construct(
        AnimalRepositoryInterface $animalRepository,
        AnimalCatalogRepositoryInterface $animalCatalogRepository,
        ProductRepositoryInterface $productRepository,
        ProductPriceRepositoryInterface $productPriceRepository,
        ProductCatalogRepositoryInterface $productCatalogRepository,
        ProductOptionRepositoryInterface $productOptionRepository,
        FormRequestRepositoryInterface $formRequestRepository,
        InvoiceRepositoryInterface $invoiceRepository,
        ImageRepositoryInterface $imageRepository,
        SponsorRepositoryInterface $sponsorRepository,
        StoryRepositoryInterface $storyRepository,
        StoryCatalogRepositoryInterface $storyCatalogRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->animalRepository = $animalRepository;
        $this->animalCatalogRepository = $animalCatalogRepository;
        $this->productRepository = $productRepository;
        $this->productPriceRepository = $productPriceRepository;
        $this->productCatalogRepository = $productCatalogRepository;
        $this->productOptionRepository = $productOptionRepository;
        $this->formRequestRepository = $formRequestRepository;
        $this->invoiceRepository = $invoiceRepository;
        $this->imageRepository = $imageRepository;
        $this->sponsorRepository = $sponsorRepository;
        $this->storyRepository = $storyRepository;
        $this->storyCatalogRepository = $storyCatalogRepository;
        $this->userRepository = $userRepository;
        $this->response = ['status' => false, 'message'=> ''];
    }
    public function showProduct(Request $request)
    {
        try {
            $products = $this->productRepository->getAll();

            return response()->json([
                'status' => true,
                'data' => $products,
                'message' => 'Danh sách sản phẩm đã được lấy thành công.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể lấy danh sách sản phẩm: ' . $e->getMessage()
            ], 500);
        }
    }
    public function showAnimal(Request $request)
    {
        try {
            $animal = $this->animalRepository->getAll();

            return response()->json([
                'status' => true,
                'data' => $animal,
                'message' => 'Danh sách thú cưng đã được lấy thành công.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể lấy danh sách thú cưng: ' . $e->getMessage()
            ], 500);
        }
    }
    public function showUsers(Request $request)
    {
        try {
            $users = $this->userRepository->getAll();

            return response()->json([
                'status' => true,
                'data' => $users,
                'message' => 'Danh sách tngười dùng đã được lấy thành công.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể lấy danh sách người dùng: ' . $e->getMessage()
            ], 500);
        }
    }
    public function showStories(Request $request)
    {
        try {
            $stories = $this->storyRepository->getAll();

            return response()->json([
                'status' => true,
                'data' => $stories,
                'message' => 'Danh sách Tin Tức đã được lấy thành công.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể lấy danh sách tin tức: ' . $e->getMessage()
            ], 500);
        }
    }
    public function showStoryCatalog(Request $request)
    {
        try {
            $storyCatalog = $this->storyCatalogRepository->getAll();

            return response()->json([
                'status' => true,
                'data' => $storyCatalog,
                'message' => 'Danh mục Tin Tức đã được lấy thành công.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể lấy danh mục tin tức: ' . $e->getMessage()
            ], 500);
        }
    }
}
