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

    public function showProduct()
    {
        try {
            $data = $this->productRepository->getAll();
            $this->response['status'] = true;
            $this->response['data'] = $data;
 
            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response,500);
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
            return response()->json($this->response,500);
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
            return response()->json($this->response,500);
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
            return response()->json($this->response,500);
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
            return response()->json($this->response,500);
        }
    }
}
