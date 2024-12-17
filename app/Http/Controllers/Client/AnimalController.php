<?php

namespace App\Http\Controllers\Client;

use App\Repositories\AnimalRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnimalController extends Controller
{
    protected $animalRepository;

    public function __construct(AnimalRepositoryInterface $animalRepository)
    {
        $this->animalRepository = $animalRepository;
    }

    public function getAll()
    {
        try {
            $data = $this->animalRepository->getAll();
            if ($data) {
                $this->response['data'] = $this->formatData($data);
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
            $data = $this->animalRepository->getById($id);
            if ($data) {
                $this->response['data'] = $this->formatData(collect([$data]));
                $this->response['status'] = true;
                return response()->json($this->response);
            } 
            else {
                $this->response['message'] = 'Animal not found!';
                return response()->json($this->response, 404);
            }
        } catch(Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }
    
    private function formatData($animals)
    {   
        try {
            return $animals->map(function ($animal) {
                return [
                    'id' => $animal->id,
                    'name' => $animal->name,
                    'description' => $animal->description,
                    'type' => $animal->type,
                    'health_info' => json_decode($animal->health_info),
                    'images' => $animal->images->pluck('url'),
                    'age' => $animal->age,
                    'gender' => $animal->gender,
                    'colors' => $animal->colors,
                    'weight' => $animal->weight,
                    'genitive' => $animal->genitive,
                ];
            });
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}