<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Exception;
use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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

class CrudController extends Controller
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
    private $validteRules;
    private $validteMessages;

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

    public function validateData($request)
    {   
        try {
            $this->validteRules = [
                'name' => 'required|string|max:40',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            ];
            $this->validteMessages = [
                'name' => 'Vui lòng nhập tên',
                'images' => 'Vui lòng chọn ảnh'
            ];
            
            $filteredRules = [];
            $filteredMessages = [];
            foreach ($this->validteRules as $field => $rule) {
                if ($request->has($field) || $field == 'images.*') {
                    $filteredRules[$field] = $rule;
                    if (isset($this->validteMessages[$field])) {
                        $filteredMessages[$field] = $this->validteMessages[$field];
                    }
                }
            }

            $errorsList = [];
            $validation = Validator::make($request->all(), $filteredRules, $filteredMessages);
            if ($validation->fails()) {
                $errors = $validation->errors();
                foreach ($errors->all() as $error) {
                    $errorsList[] = $error;
                }
            }

            return $errorsList;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function processData($data, $instance)
    {   
        try {
            $object = $this->$instance->newModel();
            $object->fill($data);
            return $object->toArray();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function processImages($images, $path, $table, $id)
    {   
        try {
            $data = [];
            foreach ($images as $image) {
                $imagePath = $image->store($path, 'public');
                $data[] = ['table' => $table, 'id' => $id, 'url' => $imagePath];
            }
            return $this->imageRepository->insertMany($table, $id, $data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    // ------------------ CRUD FUNCTION BELOW ------------------

    public function animalManager(Request $request, String $type)
    {
        try {
            DB::beginTransaction();

            if ($type == 'delete') {
                if ($this->animalRepository->delete($request->id)) {
                    $this->response['status'] = true;
                    $this->response['message'] = 'Delete Complete';
                }
            } 
            else {
                $validationResponse = $this->validateData($request);
                if (!empty($validationResponse)) {
                    throw new Exception(json_encode($validationResponse, JSON_UNESCAPED_UNICODE));
                }

                if ($type == 'insert') {
                    $data = $this->processData($request->all(), 'animalRepository');
                    $target = $this->animalRepository->create($data);
                    $imgs = $this->processImages($request->file('images'), 'animal', 'animals', $target['id']);

                    if ($target || $imgs) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Insert Complete';
                    }
                } else if ($type == 'update') {
                    $data = $this->processData($request->all(), 'animalRepository');
                    $target = $this->animalRepository->update($request['id'],$data);
                    $imgs = $this->processImages($request->file('images'), 'animal', 'animals', $target['id']);

                    if ($target || $imgs) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Update Complete';
                    }
                }
            }
            
            DB::commit();
            return response()->json($this->response);
        } catch (Exception $e) {
            DB::rollBack();
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
            
    }

    public function animalCatalogManager(Request $request, String $type)
    {
        try {
            DB::beginTransaction();

            if ($type == 'delete') {
                if ($this->animalCatalogRepository->delete($request->id)) {
                    $this->response['status'] = true;
                    $this->response['message'] = 'Delete Complete';
                }
            } 
            else {
                $validationResponse = $this->validateData($request);
                if (!empty($validationResponse)) {
                    throw new Exception(json_encode($validationResponse, JSON_UNESCAPED_UNICODE));
                }

                if ($type == 'insert') {
                    $data = $this->processData($request->all(), 'animalCatalogRepository');
                    $target = $this->animalCatalogRepository->create($data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Insert Complete';
                    }
                } else if ($type == 'update') {
                    $data = $this->processData($request->all(), 'animalCatalogRepository');
                    $target = $this->animalCatalogRepository->update($request['id'],$data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Update Complete';
                    }
                }
            }
            
            DB::commit();
            return response()->json($this->response);
        } catch (Exception $e) {
            DB::rollBack();
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
            
    }

    public function formRequestManager(Request $request, String $type)
    {
        try {
            DB::beginTransaction();

            if ($type == 'delete') {
                if ($this->formRequestRepository->delete($request->id)) {
                    $this->response['status'] = true;
                    $this->response['message'] = 'Delete Complete';
                }
            } 
            else {
                $validationResponse = $this->validateData($request);
                if (!empty($validationResponse)) {
                    throw new Exception(json_encode($validationResponse, JSON_UNESCAPED_UNICODE));
                }

                if ($type == 'insert') {
                    $data = $this->processData($request->all(), 'formRequestRepository');
                    $target = $this->formRequestRepository->create($data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Insert Complete';
                    }
                } else if ($type == 'update') {
                    $data = $this->processData($request->all(), 'formRequestRepository');
                    $target = $this->formRequestRepository->update($request['id'],$data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Update Complete';
                    }
                }
            }
            
            DB::commit();
            return response()->json($this->response);
        } catch (Exception $e) {
            DB::rollBack();
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
            
    }

    public function invoiceManager(Request $request, String $type)
    {
        try {
            DB::beginTransaction();

            if ($type == 'delete') {
                if ($this->invoiceRepository->delete($request->id)) {
                    $this->response['status'] = true;
                    $this->response['message'] = 'Delete Complete';
                }
            } 
            else {
                $validationResponse = $this->validateData($request);
                if (!empty($validationResponse)) {
                    throw new Exception(json_encode($validationResponse, JSON_UNESCAPED_UNICODE));
                }

                if ($type == 'insert') {
                    $data = $this->processData($request->all(), 'invoiceRepository');
                    $target = $this->invoiceRepository->create($data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Insert Complete';
                    }
                } else if ($type == 'update') {
                    $data = $this->processData($request->all(), 'invoiceRepository');
                    $target = $this->invoiceRepository->update($request['id'],$data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Update Complete';
                    }
                }
            }
            
            DB::commit();
            return response()->json($this->response);
        } catch (Exception $e) {
            DB::rollBack();
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
            
    }

    public function productManager(Request $request, String $type)
    {
        try {
            DB::beginTransaction();

            if ($type == 'delete') {
                if ($this->productRepository->delete($request->id)) {
                    $this->response['status'] = true;
                    $this->response['message'] = 'Delete Complete';
                }
            } 
            else {
                $validationResponse = $this->validateData($request);
                if (!empty($validationResponse)) {
                    throw new Exception(json_encode($validationResponse, JSON_UNESCAPED_UNICODE));
                }

                if ($type == 'insert') {
                    $data = $this->processData($request->all(), 'productRepository');
                    $target = $this->productRepository->create($data);
                    $imgs = $this->processImages($request->file('images'), 'product', 'products', $target['id']);
                    $this->productPriceRepository->insertMany($target['id'], $request['prices']);
                    $this->productOptionRepository->insertMany($target['id'], $request['options']);

                    if ($target || $imgs) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Insert Complete';
                    }
                } else if ($type == 'update') {
                    $data = $this->processData($request->all(), 'productRepository');
                    $target = $this->productRepository->update($request['id'],$data);
                    $imgs = $this->processImages($request->file('images'), 'product', 'products', $target['id']);
                    $this->productPriceRepository->insertMany($target['id'], $request['prices']);
                    $this->productOptionRepository->insertMany($target['id'], $request['options']);

                    if ($target || $imgs) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Update Complete';
                    }
                }
            }
            
            DB::commit();
            return response()->json($this->response);
        } catch (Exception $e) {
            DB::rollBack();
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
            
    }

    public function productCatalogManager(Request $request, String $type)
    {
        try {
            DB::beginTransaction();

            if ($type == 'delete') {
                if ($this->productCatalogRepository->delete($request->id)) {
                    $this->response['status'] = true;
                    $this->response['message'] = 'Delete Complete';
                }
            } 
            else {
                $validationResponse = $this->validateData($request);
                if (!empty($validationResponse)) {
                    throw new Exception(json_encode($validationResponse, JSON_UNESCAPED_UNICODE));
                }

                if ($type == 'insert') {
                    $data = $this->processData($request->all(), 'productCatalogRepository');
                    $target = $this->productCatalogRepository->create($data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Insert Complete';
                    }
                } else if ($type == 'update') {
                    $data = $this->processData($request->all(), 'productCatalogRepository');
                    $target = $this->productCatalogRepository->update($request['id'],$data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Update Complete';
                    }
                }
            }
            
            DB::commit();
            return response()->json($this->response);
        } catch (Exception $e) {
            DB::rollBack();
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
            
    }

    public function sponsorManager(Request $request, String $type)
    {
        try {
            DB::beginTransaction();

            if ($type == 'delete') {
                if ($this->sponsorRepository->delete($request->id)) {
                    $this->response['status'] = true;
                    $this->response['message'] = 'Delete Complete';
                }
            } 
            else {
                $validationResponse = $this->validateData($request);
                if (!empty($validationResponse)) {
                    throw new Exception(json_encode($validationResponse, JSON_UNESCAPED_UNICODE));
                }

                if ($type == 'insert') {
                    $data = $this->processData($request->all(), 'sponsorRepository');
                    $target = $this->sponsorRepository->create($data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Insert Complete';
                    }
                } else if ($type == 'update') {
                    $data = $this->processData($request->all(), 'sponsorRepository');
                    $target = $this->sponsorRepository->update($request['id'],$data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Update Complete';
                    }
                }
            }
            
            DB::commit();
            return response()->json($this->response);
        } catch (Exception $e) {
            DB::rollBack();
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
            
    }

    public function storyManager(Request $request, String $type)
    {
        try {
            DB::beginTransaction();

            if ($type == 'delete') {
                if ($this->storyRepository->delete($request->id)) {
                    $this->response['status'] = true;
                    $this->response['message'] = 'Delete Complete';
                }
            } 
            else {
                $validationResponse = $this->validateData($request);
                if (!empty($validationResponse)) {
                    throw new Exception(json_encode($validationResponse, JSON_UNESCAPED_UNICODE));
                }

                if ($type == 'insert') {
                    $data = $this->processData($request->all(), 'storyRepository');
                    $target = $this->storyRepository->create($data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Insert Complete';
                    }
                } else if ($type == 'update') {
                    $data = $this->processData($request->all(), 'storyRepository');
                    $target = $this->storyRepository->update($request['id'],$data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Update Complete';
                    }
                }
            }
            
            DB::commit();
            return response()->json($this->response);
        } catch (Exception $e) {
            DB::rollBack();
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
            
    }

    public function storyCatalogManager(Request $request, String $type)
    {
        try {
            DB::beginTransaction();

            if ($type == 'delete') {
                if ($this->storyCatalogRepository->delete($request->id)) {
                    $this->response['status'] = true;
                    $this->response['message'] = 'Delete Complete';
                }
            } 
            else {
                $validationResponse = $this->validateData($request);
                if (!empty($validationResponse)) {
                    throw new Exception(json_encode($validationResponse, JSON_UNESCAPED_UNICODE));
                }

                if ($type == 'insert') {
                    $data = $this->processData($request->all(), 'storyCatalogRepository');
                    $target = $this->storyCatalogRepository->create($data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Insert Complete';
                    }
                } else if ($type == 'update') {
                    $data = $this->processData($request->all(), 'storyCatalogRepository');
                    $target = $this->storyCatalogRepository->update($request['id'],$data);

                    if ($target) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Update Complete';
                    }
                }
            }
            
            DB::commit();
            return response()->json($this->response);
        } catch (Exception $e) {
            DB::rollBack();
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
            
    }

    public function userManager(Request $request, String $type)
    {
        try {
            DB::beginTransaction();

            if ($type == 'delete') {
                if ($this->userRepository->delete($request->id)) {
                    $this->response['status'] = true;
                    $this->response['message'] = 'Delete Complete';
                }
            } 
            else {
                $validationResponse = $this->validateData($request);
                if (!empty($validationResponse)) {
                    throw new Exception(json_encode($validationResponse, JSON_UNESCAPED_UNICODE));
                }

                if ($type == 'insert') {
                    $data = $this->processData($request->all(), 'userRepository');
                    $target = $this->userRepository->create($data);
                    $imgs = $this->processImages($request->file('images'), 'user', 'users', $target['id']);

                    if ($target || $imgs) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Insert Complete';
                    }
                } else if ($type == 'update') {
                    $data = $this->processData($request->all(), 'userRepository');
                    $target = $this->userRepository->update($request['id'],$data);
                    $imgs = $this->processImages($request->file('images'), 'user', 'users', $target['id']);

                    if ($target || $imgs) {
                        $this->response['status'] = true;
                        $this->response['message'] = 'Update Complete';
                    }
                }
            }
            
            DB::commit();
            return response()->json($this->response);
        } catch (Exception $e) {
            DB::rollBack();
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
            
    }
}
