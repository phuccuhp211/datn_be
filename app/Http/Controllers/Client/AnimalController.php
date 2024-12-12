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
}