<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAll(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 4);
            $data = $this->projectRepository->newModel()->paginate($perPage);
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
            $data = $this->projectRepository->getById($id);
            if ($data) {
                $data->load('sponsors');
                $data->raised_amount = $data->sponsors->sum('amount');

                $this->response['data'] = $data;
                $this->response['status'] = true;
                return response()->json($this->response);
            } 
            else {
                $this->response['message'] = 'Project not found!';
                return response()->json($this->response, 404);
            }
        } catch(Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }
}
