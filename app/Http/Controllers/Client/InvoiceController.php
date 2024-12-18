<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\InvoiceRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function index()
    {
        try {
            $data = $this->invoiceRepository->getAll();
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

    public function show($id)
    {
        try {
            $data = $this->invoiceRepository->getById($id);
            if ($data) {
                $this->response['data'] = collect([$data]);
                $this->response['status'] = true;
                return response()->json($this->response);
            } 
            else {
                $this->response['message'] = 'Invoice not found!';
                return response()->json($this->response, 404);
            }
        } catch(Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function getByUserId($userId)
    {
        try {
            $data = $this->invoiceRepository->getByUserId($userId);
            if (!$data->isEmpty()) {
                $this->response['data'] = $data;
                $this->response['status'] = true;
                return response()->json($this->response);
            } 
            else {
                $this->response['message'] = 'No Invoices found in this User!';
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
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'list' => 'required|json',
                'amount' => 'required|integer',
                'discount' => 'nullable|string|max:10',
                'coupon' => 'nullable|string|max:30',
                'total' => 'required|integer',
                'status' => 'required|integer',
            ]);

            $data = $this->invoiceRepository->create($validatedData);

            if ($data) {
                $this->response['status'] = true;
                $this->response['data'] = $data;
                return response()->json($this->response);
            }
            else {
                $this->response['message'] = 'Cant not create Invoice!';
                return response()->json($this->response, 404);
                
            }
        } catch(Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
        
    }

    public function update(Request $request, $id)
    {
        try {    
            $validatedData = $request->validate([
                'user_id' => 'sometimes|exists:users,id',
                'list' => 'sometimes|json',
                'amount' => 'sometimes|integer',
                'discount' => 'nullable|string|max:10',
                'coupon' => 'nullable|string|max:30',
                'total' => 'sometimes|integer',
                'status' => 'sometimes|integer',
            ]);

            $data = $this->invoiceRepository->update($id, $validatedData);

            if ($data) {
                $this->response['status'] = true;
                $this->response['data'] = $data;
                return response()->json($this->response);
            }
            else {
                $this->response['message'] = 'Cant not update Invoice!';
                return response()->json($this->response, 404);
                
            }
        } catch(Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }
    
    public function destroy($id)
    {
        try {    
            $data = $this->invoiceRepository->delete($id);

            if ($data) {
                $this->response['status'] = true;
                $this->response['data'] = $data;
                return response()->json($this->response);
            }
            else {
                $this->response['message'] = 'Cant not delete Invoice!';
                return response()->json($this->response, 404);
                
            }
        } catch(Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }
}