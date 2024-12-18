<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\FormRequestRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class FormRequestController extends Controller
{
    protected $formRequestRepository;

    public function __construct(FormRequestRepository $formRequestRepository)
    {
        $this->formRequestRepository = $formRequestRepository;
    }

    public function getAll()
    {
        try {
            $data = $this->formRequestRepository->getAll();
            $this->response['data'] = $data;
            $this->response['status'] = true;
            return response()->json($this->response);
        } catch(Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function getById($id)
    {
        try {
            $data = $this->formRequestRepository->getById($id);
            if ($data) {
                $this->response['data'] = $data;
                $this->response['status'] = true;
                return response()->json($this->response);
            } 
            else {
                $this->response['message'] = 'Form Request not found!';
                return response()->json($this->response, 404);
            }
        } catch(Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:40',
                'phone' => 'required|string|max:12',
                'email' => 'required|string|max:50',
                'address' => 'required|string',
                'message' => 'required|string',
                'type' => 'nullable|string|max:10',
                'status' => 'nullable|string|max:10',
                'addition_infomation' => 'nullable|json',
            ]);

            $additionalInformation = json_decode($validated['addition_infomation'], true);

            $validated['addition_infomation'] = $additionalInformation ? json_encode($additionalInformation) : null;

            $formRequest = $this->formRequestRepository->create($validated);
            if ($validated['type'] === 'vol') Mail::to('doanvanngoc061220@gmail.com')->send(new \App\Mail\NewVolunteerRequest($formRequest));
            else if ($validated['type'] === 'adot') Mail::to('doanvanngoc061220@gmail.com')->send(new \App\Mail\NewAdoptRequest($formRequest));
            
            $this->response['status'] = true;
            $this->response['data'] = $formRequest;
            return response()->json($this->response, 201);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $formRequest = $this->formRequestRepository->getById($id);
            if (!$formRequest) {
                $this->response['message'] = 'Form Request not found!';
                return response()->json($this->response, 404);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:40',
                'phone' => 'required|string|max:12',
                'email' => 'required|string|max:25',
                'address' => 'required|string',
                'message' => 'required|string',
                'type' => 'required|string|max:10',
                'status' => 'required|string|max:10',
                'addition_infomation' => 'nullable|json',
            ]);

            $updated = $this->formRequestRepository->update($id, $validated);

            if ($updated) {
                $this->response['data'] = $updated;
                $this->response['status'] = true;
                return response()->json($this->response, 201);
            } else {
                $this->response['message'] = 'Cant not update Form Request';
                return response()->json($this->response, 404);
            }
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->formRequestRepository->delete($id);
            if ($deleted) {
                $this->response['data'] = $deleted;
                $this->response['status'] = true;
                return response()->json($this->response, 201);
            } else {
                $this->response['message'] = 'Cant not delete Form Request';
                return response()->json($this->response, 404);
            }
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }
}
