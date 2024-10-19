<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Client\CartController;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductPriceRepositoryInterface;
use App\Repositories\ProductOptionRepositoryInterface;

class SisuController extends Controller
{
    private $response;
    private $userRepository;
    private $productRepository;
    private $productPriceRepository;
    private $productOptionRepository;
    
    public function __construct (
        UserRepositoryInterface $userRepository, 
        ProductRepositoryInterface $productRepository,
        ProductPriceRepositoryInterface $productPriceRepositoryInterface,
        ProductOptionRepositoryInterface $productOptionRepositoryInterface
    )
    {
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->productPriceRepository = $productPriceRepositoryInterface;
        $this->productOptionRepository = $productOptionRepositoryInterface;
        $this->response = ['status' => false ,'message'=> ''];
    }

    public function clientLogin(Request $request)
    {
        try {
            $account = $request->input('account');
            $password = $request->input('password');

            if ($account == '') $this->response['message'] = 'Vui lòng nhập tài khoản !';
            else if ($password == '') $this->response['message'] =  'Vui lòng nhập mật khẩu !';
            else {
                $user = $this->userRepository->getByAccount($account);
                if ($user) {
                    if ($user['lock'] == 1 && $user['role'] != 'client') $this->response['message'] = 'Tài Khoản bị khóa !';
                    else {
                        $passwordTrue = password_verify($password, $user['password']);
                        if ($passwordTrue) {
                            unset($user['password']);
                            $this->response['status'] = true;
                            session(['userLog' => $user]);
                            if (!is_null($user['cart'])) {
                                $userCart = json_decode($user['cart'], true);
                                $cartController = new CartController($this->userRepository, $this->productRepository, $this->productPriceRepository, $this->productOptionRepository);
                                if (session()->has('cart')) $cartController->mergeCart($userCart);
                                else session(['cart' => $userCart]);
                            }
                            else $this->userRepository->updateCartForUser($user['id'], session('cart'));
                        }
                        else $this->response['message'] =  'Sai mật khẩu';
                    }
                } 
                else $this->response['message'] =  'Sai tên tài khoản !';
            }

            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
        
    }

    public function clientRegister(Request $request)
    {
        try {
            $rule = [
                'account' => 'required|string|min:3|unique:users,account',
                'password' => 'required|min:8',
                'password2' => 'required|same:password',
                'name' => 'required|string|max:255',
                'address' => 'nullable|string|max:255',
                'email' => 'required|email|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/|unique:users,email',
                'phone' => 'required|numeric|digits:10|unique:users,phone'
            ];
            $msgs = [
                'account.unique' => 'Tên tài khoản đã được sử dụng!',
                'email.unique' => 'Email đã được sử dụng!',
                'phone.unique' => 'Số điện thoại đã được sử dụng!',
                'password2.same' => 'Mật khẩu không khớp!',
                'password.min' => 'Mật khẩu tối thiểu 8 kí tự!',
                'email' => 'Email không đúng định dạng.',
                'phone.digits' => 'Số điện thoại không hợp lệ.',
            ];
            $validator = Validator::make($request->all(), $rule, $msgs);

            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                $this->response['message'] = $errors;
            } else {
                $hashedPassword = password_hash($request->input('password'), PASSWORD_BCRYPT);
                $data = [
                    'account' => $request->input('account'),
                    'password' => $hashedPassword,
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'role' => 'client'
                ];

                $this->response['status'] = true;
                $this->response['message'] = $this->userRepository->create($data);
            }

            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
    }


    public function clientLogout(Request $request)
    {
        try {
            if (session()->has('userLog')) session()->forget('userLog');
            $this->response['status'] = true;
            $this->response['message'] = 'done';
            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
    }
}
