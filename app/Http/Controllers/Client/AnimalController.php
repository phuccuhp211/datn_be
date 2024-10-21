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
        $animals = $this->animalRepository->getAll();
        $result = $this->formatAnimals($animals);
        return response()->json($result);
    }

    public function show($id)
    {
        $animal = $this->animalRepository->getById($id);
        $result = $this->formatAnimals(collect([$animal]));
        return response()->json($result[0]);
    }

    public function store(Request $request)
    {
        $animal = $this->animalRepository->create($request->all());
        return response()->json($animal, 201);
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
    private function formatAnimals($animals)
    {
        return $animals->map(function ($animal) {
            return [
                'id' => $animal->id,
                'name' => $animal->name,
                'description' => $animal->description,
                'type' => $animal->type,
                'health_info' => json_decode($animal->health_info),
                'images' => $animal->images->pluck('url'),
            ];
        });
    }
}
