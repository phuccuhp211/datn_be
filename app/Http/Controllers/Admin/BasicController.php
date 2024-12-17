<?php

namespace App\Http\Controllers\Admin;

use Exception;
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

class BasicController extends Controller
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
    ) {
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
    }

    public function showProduct()
    {
        try {
            $data = $this->productRepository->getAll();
            $this->response['status'] = true;
            $this->response['data'] = $data;

            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function showAnimal()
    {
        try {
            $data = $this->animalRepository->getAll();
            $this->response['status'] = true;
            $this->response['data'] = $data;

            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function showUsers()
    {
        try {
            $data = $this->userRepository->getAll();
            $this->response['status'] = true;
            $this->response['data'] = $data;

            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function showStories()
    {
        try {
            $data = $this->storyRepository->getAll();
            $this->response['status'] = true;
            $this->response['data'] = $data;

            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function showStoryCatalog()
    {
        try {
            $data = $this->storyCatalogRepository->getAll();
            $this->response['status'] = true;
            $this->response['data'] = $data;

            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }
    public function showAnimalCatalog(Request $request)
    {
        try {
            $animalCatalog = $this->animalCatalogRepository->getAll();

            return response()->json([
                'status' => true,
                'data' => $animalCatalog,
                'message' => 'Danh mục thú cưng đã được lấy thành công.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể lấy danh mục đọng vật: ' . $e->getMessage()
            ], 500);
        }
    }
    public function showSponsor(Request $request)
    {
        try {
            $sponsors = $this->sponsorRepository->getAll();

            return response()->json([
                'status' => true,
                'data' => $sponsors,
                'message' => 'Danh sách ủng hộ đã được lấy thành công.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể lấy danh sách ủng hộ: ' . $e->getMessage()
            ], 500);
        }
    }
    public function showProductCatalog(Request $request)
    {
        try {
            $productCatalog = $this->productCatalogRepository->getAll();

            return response()->json([
                'status' => true,
                'data' => $productCatalog,
                'message' => 'Danh mục sản phẩm đã được lấy thành công.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể lấy danh mục sản phẩm : ' . $e->getMessage()
            ], 500);
        }
    }
}