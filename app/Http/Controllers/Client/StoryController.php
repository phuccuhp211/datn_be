<?php

namespace App\Http\Controllers\Client;

use App\Repositories\StoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoryController extends Controller
{
    protected $storyRepository;

    public function __construct(StoryRepositoryInterface $storyRepository)
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
    
    public function getStoriesByCategory($categoryId)
    {
        $stories = $this->storyRepository->getByCategoryId($categoryId);

        if ($stories->isEmpty()) {
            return response()->json(['message' => 'No stories found in this category'], 404);
        }

        return response()->json($stories);
    }
}