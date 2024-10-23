<?php

namespace App\Http\Controllers\Client;

use App\Repositories\AnimalRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnimalController extends Controller
{
    protected $animalRepository;

    public function __construct(AnimalRepositoryInterface $animalRepository)
    {
        $this->animalRepository = $animalRepository;
    }

    public function index()
    {
        return response()->json($this->animalRepository->getAll());
    }

    public function show($id)
    {
        return response()->json($this->animalRepository->getById($id));
    }

    public function store(Request $request)
    {
        try {
            $animal = $this->animalRepository->create($request->all());
            return response()->json($animal, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }

    }

    public function update(Request $request, $id)
    {
        $animal = $this->animalRepository->update($id, $request->all());
        return response()->json($animal);
    }

    public function destroy($id)
    {
        $animal = $this->animalRepository->delete($id);
        return response()->json(null, 204);
    }
}