<?php

namespace App\Http\Controllers\Client;

use App\Repositories\SponsorRepositoryInterface;
use App\Http\Controllers\ValidateController;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Mail\ThankYouMail;
use Illuminate\Support\Facades\Mail;

class SponsorController extends Controller
{
    protected $sponsorRepository;

    public function __construct(SponsorRepositoryInterface $sponsorRepository)
    {
        $this->sponsorRepository = $sponsorRepository;
    }

    public function getAll()
    {
        try {
            $data = $this->sponsorRepository->getAll();
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
            $data = $this->sponsorRepository->getById($id);
            if ($data) {
                $this->response['data'] = $data;
                $this->response['status'] = true;
                return response()->json($this->response);
            } 
            else {
                $this->response['message'] = 'Sponsor not found!';
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
            $validateController = new ValidateController();

            $rules = [ 
                'name' => 'required|string|max:50',
                'email' => 'required|email|max:100',
                'amount' => 'required|numeric|min:1000',
                'project_id' => 'required|exists:projects,id',
                'date' => 'required|date'
            ];

            $messages = [
                'name.required' => 'Vui lòng nhập tên.',
                'name.string' => 'Tên phải là một chuỗi ký tự.',
                'name.max' => 'Tên không được vượt quá 50 ký tự.',

                'email.required' => 'Vui lòng nhập địa chỉ email.',
                'email.email' => 'Địa chỉ email không hợp lệ.',
                'email.max' => 'Địa chỉ email không được vượt quá 100 ký tự.',

                'amount.required' => 'Vui lòng nhập số tiền.',
                'amount.numeric' => 'Số tiền phải là số.',
                'amount.min' => 'Số tiền phải ít nhất là 1,000.',

                'project_id.required' => 'Vui lòng chọn dự án.',
                'project_id.exists' => 'Dự án đã chọn không tồn tại.',

                'date.required' => 'Vui lòng nhập ngày.',
                'date.date' => 'Ngày nhập không hợp lệ.'
            ];

            $newRM = [$rules, $messages];
            $errorsList = $validateController->customValidate($newRM ,$request);

            if ($errorsList) {
                $this->response['message'] = $errorsList;
                return response()->json($this->response, 400);
            }
            else {
                $sponsor = Sponsor::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'amount' => $request->input('amount'),
                    'project_id' => $request->input('project_id'),
                    'date' => $request->input('date')
                ]);

                $project = $sponsor->project;
                $sponsorData = [
                    'name' => $sponsor->name,
                    'email' => $sponsor->email,
                    'amount' => $sponsor->amount,
                    'project_name' => $project->name,
                ];

                $this->response['status'] = true;
                $this->response['data'] = $sponsor;

                Mail::to($sponsor->email)->send(new ThankYouMail($sponsorData));
                return response()->json($this->response);
            }
            
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }
}
