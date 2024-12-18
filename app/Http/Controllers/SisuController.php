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
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SisuController extends Controller
{
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

    public function validateData(Request $request, $custom = false, $newRM = [])
    {   
        try {
            $validateController = new ValidateController();
            if (!$custom) $errorsList = $validateController->handle($request);
            else $errorsList = $validateController->customValidate($newRM ,$request);
            return $errorsList;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function clientLogin(Request $request)
    {
        try {
            $httpCode = 200;
            $account = $request->input('account');
            $password = $request->input('password');

            if ($account == '') {
                $this->response['message'] = 'Vui lòng nhập tài khoản !';
                $httpCode = 404;
            }
            else if ($password == '') {
                $this->response['message'] =  'Vui lòng nhập mật khẩu !';
                $httpCode = 404;
            }
            else {
                $user = $this->userRepository->getByAccount($account);
                if ($user) {
                    if (!$user['is_active'] || $user['role'] != 'client') {
                        $this->response['message'] = 'Tài Khoản bị khóa !';
                        $httpCode = 403;
                    }
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
                        else {
                            $this->response['message'] =  'Sai mật khẩu';
                            $httpCode = 403;
                        }
                    }
                } 
                else {
                    $this->response['message'] =  'Sai tên tài khoản !';
                    $httpCode = 403;
                }
            }

            return response()->json($this->response, $httpCode);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
        
    }

    public function clientRegister(Request $request)
    {
        try {
            $validationResponse = $this->validateData($request);
            if (!empty($validationResponse)) {
                $this->response['message'] = json_encode($validationResponse, JSON_UNESCAPED_UNICODE);
                return response()->json($this->response, 404);
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
                return response()->json($this->response, 201);
            }
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
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
            return response()->json($this->response, 500);
        }
    }

    public function clientConfig(Request $request)
    {
        try {
            $validationResponse = $this->validateData($request);
            if (!empty($validationResponse)) {
                $this->response['message'] = json_encode($validationResponse, JSON_UNESCAPED_UNICODE);
                return response()->json($this->response, 404);
            } else {
                $object = $this->userRepository->newModel();
                $object->fill($request->all());
                $data = $object->toArray();
                
                $user = $this->userRepository->update($request->input('id'),$data);
                $this->response['status'] = true;
                $this->response['data'] = $user;
                return response()->json($this->response, 204);
            }
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function clientChangePassword(Request $request)
    {
        try {
            $oldPass = $request->input('oldPass');
            $newPass = $request->input('newPass');
            $reNewPass = $request->input('reNewPass');

            if (!session()->has('clientLoged')) {
                $this->response['message'] = 'Yêu cầu đăng nhập';
                return response()->json($this->response, 403);
            }

            $account = session('clientLoged')['account'];
            $object = $this->userRepository->getByAccount($account);

            if (!password_verify($oldPass, $object['password'])) {
                $this->response['message'] = 'Mật khẩu cũ không đúng';
                return response()->json($this->response, 403);
            } else {
                if ($newPass !== $reNewPass) {
                    $this->response['message'] = 'Vui lòng nhập lại mật khẩu khớp với mật khẩu mới';
                    return response()->json($this->response, 404);
                } else {
                    $hashedNewPassword = password_hash($newPass, PASSWORD_BCRYPT);
                    $object->password = $hashedNewPassword;
                    $this->userRepository->update($object->id, $object->toArray());

                    $this->response['status'] = true;
                    $this->response['message'] = 'Mật khẩu đã được cập nhật thành công';
                    return response()->json($this->response, 204);
                }
            }
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function clientForgotPassword(Request $request)
    {
        try {
            $rules = [ 'email' => 'required|email|exists:users,email' ];
            $messages = [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email phải đúng định dạng',
                'email.exists' => 'Email không tồn tại trong hệ thống'
            ];

            $validationData = $this->validateData($request, true, ['rules' => $rules, 'messages' => $messages]);
            if (!empty($validationData)) {
                $this->response['message'] = json_encode($validationData, JSON_UNESCAPED_UNICODE);
                return response()->json($this->response, 404);
            } else {
                $status = Password::sendResetLink(
                    $request->only('email'),
                    function ($user, $token) {
                        $resetUrl = config('app.frontend_url') . "/reset-password?token=$token&email=" . urlencode($user->email);
                        $user->sendPasswordResetNotification($resetUrl);
                    }
                );

                if ($status === Password::RESET_LINK_SENT) {
                    $this->response['status'] = true;
                    $this->response['message'] = 'Link đặt lại mật khẩu đã được gửi!';
                    return response()->json($this->response,200);
                } else {
                    $this->response['message'] = 'Không thể gửi link đặt lại mật khẩu. Vui lòng thử lại sau.';
                    return response()->json($this->response, 500);
                }
            }

        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function clientResetPassword(Request $request)
    {
        try {
            $rules = [
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ];
            $messages = [
                'token.required' => 'Token hết hạn hoặc không hợp lệ',
                'password.required' => 'Yêu cầu Mật Khẩu',
                'password.min' => 'Mật khẩu tối thiểu 8 kí tự',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp',
                'email.required' => 'Yêu cầu Email',
                'email.email' => 'Email phải đúng định dạng',
            ];

            $validationData = $this->validateData($request, true, ['rules' => $rules, 'messages' => $messages]);
            if (!empty($validationData)) {
                $this->response['message'] = json_encode($validationData, JSON_UNESCAPED_UNICODE);
                return response()->json($this->response, 404);
            } else {
                $status = Password::reset(
                    $request->only('email', 'password', 'password_confirmation', 'token'),
                    function ($user, $password) {
                        $user->forceFill([
                            'password' => Hash::make($password),
                            'remember_token' => Str::random(60),
                        ])->save();
                    }
                );

                if ($status == Password::PASSWORD_RESET) {
                    $this->response['status'] = true;
                    $this->response['message'] = 'Đặt lại mật khẩu thành công!';
                    return response()->json($this->response, 204);
                } else {
                    $this->response['message'] = 'Yêu cầu đặt lại mật khẩu không hợp lệ.';
                    return response()->json($this->response, 500);
                }
            }
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    public function adminLogin(Request $request)
    {
        try {
            $account = $request->input('account');
            $password = $request->input('password');

            if ($account == '') {
                $this->response['message'] = 'Vui lòng nhập tài khoản !';
                return response()->json($this->response, 404);
            }
            else if ($password == '') {
                $this->response['message'] =  'Vui lòng nhập mật khẩu !';
                return response()->json($this->response, 404);
            }
            else {
                $user = $this->userRepository->getByAccount($account);
                if ($user) {
                    if (!$user['is_active'] || $user['role'] != 'admin') {
                        $this->response['message'] = 'Tài Khoản bị khóa !';
                        return response()->json($this->response, 403);
                    }
                    else {
                        $passwordTrue = password_verify($password, $user['password']);
                        if ($passwordTrue) {
                            unset($user['password']);
                            session(['adminLoged' => $user]);
                            $this->response['status'] = true;
                            $this->response['message'] = session('adminLoged');
                            return response()->json($this->response);
                        }
                        else {
                            $this->response['message'] =  'Sai mật khẩu';
                            return response()->json($this->response, 403);
                        }
                    }
                } 
                else {
                    $this->response['message'] =  'Sai tên tài khoản !';
                    return response()->json($this->response, 403);
                }
            }
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response, 500);
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
            return response()->json($this->response, 500);
        }
    }
}
