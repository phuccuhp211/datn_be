<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepositoryInterface;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectRepo;

    public function __construct(ProjectRepositoryInterface $projectRepo)
    {
        $this->projectRepo = $projectRepo;
    }

    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 4);
        $projects = $this->projectRepo->newModel()->paginate($perPage);
        return response()->json($projects);
    }


    public function show($id)
    {
        $project = $this->projectRepo->getById($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        // Bao gồm danh sách sponsor liên quan đến project
        $project->load('sponsors'); // Assumes the Project model has a sponsors relationship

        // Tính lại tổng số tiền đã ủng hộ từ danh sách sponsors
        $project->raised_amount = $project->sponsors->sum('amount');

        return response()->json($project);
    }
}
