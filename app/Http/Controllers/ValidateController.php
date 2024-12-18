<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Validator;
use Request;

class ValidateController extends Controller
{
    protected $validteRules;
    protected $validteMessages;

    public function __construct()
    {
        $this->validteRules = [
            // Base
            'name' => 'required|string|max:40|min:3',
            'type' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',

            // Animal
            'age' => 'required|numeric',
            'gender' => 'required|numeric|max:1',
            'color' => 'required|string|max:20',
            'genitive' => 'required|string|max:20',
            'health_info' => 'required|string',

            // Product
            'purpose' => 'required|string',
            'out_of_stock' => 'required|numeric|max:1',

            // Product Price & Option
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',

            // User
            'account' => 'required|string|max:40',
            'password' => 'required|string|max:40',
            'phone' => 'required|numeric|digits:10|unique:users,phone',
            'email' => 'required|email|max:100|unique:users,email|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',
            'address' => 'required|string',

            // Stories & Catalog
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required|string|max:100',
            'content' => 'required|string',
            'index' => 'required|numeric|max:1'
        ];
        $this->validteMessages = [
            // Base
            'name.required' => 'Vui lòng nhập tên',
            'name.string' => 'Tên phải là chuỗi ký tự',
            'name.max' => 'Tên không được vượt quá 40 ký tự',
            'name.min' => 'Tên không được ít hơn 3 ký tự',
            'type.required' => 'Vui lòng chọn loại',
            
            'images.*.required' => 'Vui lòng chọn ảnh',
            'images.*.image' => 'Tệp tải lên phải là hình ảnh',
            'images.*.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, webp',
            'images.*.max' => 'Kích thước hình ảnh không được vượt quá 2048 KB',

            // Animal
            'age.required' => 'Vui lòng nhập tuổi',
            'age.numeric' => 'Tuổi phải là số',
            'gender.required' => 'Vui lòng chọn giới tính',
            'gender.numeric' => 'Giới tính phải là số',
            'gender.max' => 'Giá trị giới tính không hợp lệ',
            'color.required' => 'Vui lòng nhập màu sắc',
            'color.string' => 'Màu sắc phải là chuỗi ký tự',
            'color.max' => 'Màu sắc không được vượt quá 20 ký tự',
            'genitive.required' => 'Vui lòng nhập giống loài',
            'genitive.string' => 'Giống loài phải là chuỗi ký tự',
            'genitive.max' => 'Giống loài không được vượt quá 20 ký tự',
            'health_info.required' => 'Vui lòng nhập thông tin sức khỏe',

            // Product
            'purpose.required' => 'Vui lòng nhập mục đích',
            'purpose.string' => 'Mục đích phải là chuỗi ký tự',
            'out_of_stock.required' => 'Vui lòng nhập tình trạng còn hàng',
            'out_of_stock.numeric' => 'Tình trạng còn hàng phải là số',
            'out_of_stock.max' => 'Giá trị tình trạng còn hàng không hợp lệ',

            // Product Price & Option
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'price.numeric' => 'Giá phải là số',
            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.numeric' => 'Số lượng phải là số',

            // User
            'account.required' => 'Vui lòng nhập tài khoản',
            'account.string' => 'Tài khoản phải là chuỗi ký tự',
            'account.max' => 'Tài khoản không được vượt quá 40 ký tự',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự',
            'password.max' => 'Mật khẩu không được vượt quá 40 ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại phải là số',
            'phone.digits' => 'Số điện thoại phải có 10 chữ số',
            'phone.unique' => 'Số điện thoại đã tồn tại trong hệ thống',
            'email.max' => 'Email tối đa 50 ký tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email phải đúng định dạng',
            'email.regex' => 'Định dạng email không hợp lệ',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'address.required' => 'Vui lòng nhập địa chỉ',

            // Stories & Catalog
            'thumbnail.required' => 'Vui lòng tải lên ảnh đại diện',
            'thumbnail.image' => 'Tệp tải lên phải là hình ảnh',
            'thumbnail.mimes' => 'Ảnh đại diện phải có định dạng: jpeg, png, jpg, webp',
            'thumbnail.max' => 'Kích thước ảnh đại diện không được vượt quá 2048 KB',
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.string' => 'Tiêu đề phải là chuỗi ký tự',
            'title.max' => 'Tiêu đề không được vượt quá 40 ký tự',
            'content.required' => 'Vui lòng nhập nội dung',
            'content.string' => 'Nội dung phải là chuỗi ký tự',
            'index.required' => 'Vui lòng nhập chỉ số',
            'index.numeric' => 'Chỉ số phải là số',
            'index.max' => 'Giá trị chỉ số không hợp lệ'
        ];
    }

    public function handle($request)
    {   
        try {
            $filteredRules = [];
            $filteredMessages = [];

            foreach ($this->validteRules as $field => $rule) {
                if ($request->has($field) || $field == 'images.*') {
                    $filteredRules[$field] = $rule;

                    foreach ($this->validteMessages as $messageField => $message) {
                        if (str_contains($messageField, $field)) {
                            $filteredMessages[$messageField] = $message;
                        }
                    }
                }
            }

            $errorsList = null;
            $validation = validator::make($request->all(), $filteredRules, $filteredMessages);
            
            if ($validation->fails()) {
                $errorsList = $validation->errors()->all();
            }

            return $errorsList;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function customValidate($rulesAndMsgs, $request)
    {   
        try {
            $rule = $rulesAndMsgs['rules'];
            $mess = $rulesAndMsgs['messages'];

            $errorsList = null;
            $validation = validator::make($request->all(), $rule, $mess);
            
            if ($validation->fails()) {
                $errorsList = $validation->errors()->all();
            }

            return $errorsList;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
