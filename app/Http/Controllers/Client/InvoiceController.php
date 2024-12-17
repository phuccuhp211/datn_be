<?php

namespace App\Http\Controllers;

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

    public function getAll()
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

    public function getById($id)
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
}