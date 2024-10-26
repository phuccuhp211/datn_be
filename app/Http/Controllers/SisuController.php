<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductPriceRepositoryInterface;
use App\Repositories\ProductOptionRepositoryInterface;
use App\Http\Controllers\ValidateController;

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

    public function validateData(Request $request)
    {   
        try {
            $validateController = new ValidateController();
            $errorsList = $validateController->handle($request);
            return $errorsList;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
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
                            session(['clientLoged' => $user]);
                            $this->response['status'] = true;
                            $this->response['message'] = session('clientLoged');

                            if (!is_null($user['cart'])) {
                                $userCart = json_decode($user['cart'], true);
                                $cartController = new CartController($this->userRepository, $this->productRepository, $this->productPriceRepository, $this->productOptionRepository);
                                if (session()->has('cart')) $cartController->mergeCart($userCart);
                                else session(['cart' => $userCart]);
                            }
                            else $this->userRepository->updateCartForUser($user['id'], session('cart') ?? []);
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
            $validationResponse = $this->validateData($request);
            if (!empty($validationResponse)) {
                throw new Exception(json_encode($validationResponse, JSON_UNESCAPED_UNICODE));
            } else {
                $object = $this->userRepository->newModel();
                $object->fill($request->all());

                $hashedPassword = password_hash($request->input('password'), PASSWORD_BCRYPT);
                $data = $object->toArray();
                $data['role'] = 'client';
                $data['password'] = $hashedPassword;

                $user = $this->userRepository->create($data);
                unset($user['password']);
                session(['clientLoged' => $user]);

                $this->response['status'] = true;
                $this->response['message'] = session('clientLoged');
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
            if (session()->has('clientLoged')) session()->forget('clientLoged');
            $this->response['status'] = true;
            $this->response['message'] = 'done';
            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
    }

    public function adminLogin(Request $request)
    {
        try {
            $account = $request->input('account');
            $password = $request->input('password');

            if ($account == '') $this->response['message'] = 'Vui lòng nhập tài khoản !';
            else if ($password == '') $this->response['message'] =  'Vui lòng nhập mật khẩu !';
            else {
                $user = $this->userRepository->getByAccount($account);
                if ($user) {
                    if ($user['lock'] == 1 && $user['role'] != 'admin') $this->response['message'] = 'Tài Khoản bị khóa !';
                    else {
                        $passwordTrue = password_verify($password, $user['password']);
                        if ($passwordTrue) {
                            unset($user['password']);
                            $this->response['status'] = true;
                            session(['adminLoged' => $user]);
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

    public function adminLogout(Request $request)
    {
        try {
            if (session()->has('adminLoged')) session()->forget('adminLoged');
            $this->response['status'] = true;
            $this->response['message'] = 'done';
            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
    }
}
