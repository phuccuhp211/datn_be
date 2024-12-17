<?php

namespace App\Http\Controllers\Client;

use App\Repositories\StoryRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoryController extends Controller
{
    protected $storyRepository;

    public function __construct(StoryRepositoryInterface $storyRepository)
    {
        $this->storyRepository = $storyRepository;
    }

    public function getAll()
    {
        try {
            $data = $this->storyRepository->getAll();
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
            $data = $this->storyRepository->getById($id);
            if ($data) {
                $this->response['data'] = $data;
                $this->response['status'] = true;
                return response()->json($this->response);
            } 
            else {
                $this->response['message'] = 'Story not found!';
                return response()->json($this->response, 404);
            }
        } catch(Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }
    
    public function getByCategoryId($categoryId)
    {
        try {
            $data = $this->storyRepository->getByCategoryId($categoryId);
            if (!$data->isEmpty()) {
                $this->response['data'] = $data;
                $this->response['status'] = true;
                return response()->json($this->response);
            } 
            else {
                $this->response['message'] = 'No stories found in this category!';
                return response()->json($this->response, 404);
            }
        } catch(Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }
}