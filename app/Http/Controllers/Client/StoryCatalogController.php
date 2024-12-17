<?php

namespace App\Http\Controllers\Client;

use App\Repositories\StoryCatalogRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoryCatalogController extends Controller
{
    protected $storyCatalogRepository;

    public function __construct(StoryCatalogRepositoryInterface $storyCatalogRepository)
    {
        $this->storyCatalogRepository = $storyCatalogRepository;
    }

    public function getAll()
    {
        try {
            $data = $this->storyCatalogRepository->getAll();
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
            $data = $this->storyCatalogRepository->getById($id);
            if ($data) {
                $this->response['data'] = $data;
                $this->response['status'] = true;
                return response()->json($this->response);
            } 
            else {
                $this->response['message'] = 'Catalog not found!';
                return response()->json($this->response, 404);
            }
        } catch(Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }
}