<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
                            session(['userLog' => $account]);
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
            $account = $request->input('account');
            $password = $request->input('password');
            $password2 = $request->input('password2');
            $name = $request->input('name');
            $address = $request->input('address');
            $email = $request->input('email');
            $phone = $request->input('phone');

            $rule = [ 
                'email' => 'required|email|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',
                'phone' => 'required|numeric|digits:10'
            ];
            $msgs = [
                'email' => 'Email không đúng định dạng',
                'phone' => 'Số điện thoại không hợp lệ.'
            ];
            $validator = Validator::make($request->all(), $rule, $msgs);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $this->response['message'] = $errors[0];
            }
            else {
                $accountExisted = $this->userRepository->getByAccount($account);
                $emailExisted = $this->userRepository->getByEmail($email);
                $phoneExisted = $this->userRepository->getByPhone($phone);

                if ($accountExisted || $emailExisted || $phoneExisted) {
                    if ($accountExisted) $this->response['message'] =  'Tên tài khoản đã được sử dụng !';
                    if ($emailExisted) $this->response['message'] =  'Email đã được sử dụng !';
                    if ($phoneExisted) $this->response['message'] =  'Số điện thoại đã được sử dụng !';
                }
                else {
                    if ($password != $password2) $this->response['message'] =  'Mật khẩu không khớp !';
                    else if (strlen($password) < 7) $this->response['message'] =  'Mật khẩu tối thiểu 8 kí tự !';
                    else {
                        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                        $data = [
                            'account' => $account,
                            'password' => $hashedPassword,
                            'name' => $name,
                            'phone' => $phone,
                            'email' => $email,
                            'address' => $address,
                            'role' => 'client'
                        ];
                        $data['status'] = true;
                        $this->response['message'] = $this->userRepository->create($data);;
                    }
                }
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
            if (session()->has('user_log')) session()->forget('user_log');
            $this->response['status'] = true;
            $this->response['message'] = 'done';
            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
    }
}
