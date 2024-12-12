<?php

namespace App\Http\Controllers\Client;

use App\Repositories\StoryCatalogRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoryCatalogController extends Controller
{
    protected $storyRepository;

    public function __construct(StoryCatalogRepositoryInterface $storyRepository)
    {
        $this->storyRepository = $storyRepository;
    }
    public function index()
    {
        $stories = $this->storyRepository->getAll();
        return response()->json($stories);
    }
    public function show($id)
    {
        $story = $this->storyRepository->getById($id);
        if (!$story) {
            return response()->json(['message' => 'Story not found'], 404);
        }

        return response()->json($story);
    }
}