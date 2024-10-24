<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductPriceRepositoryInterface;
use App\Repositories\ProductOptionRepositoryInterface;


class CartController extends Controller
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

    public function getCart (Request $request)
    {
        $this->response['status'] = true;
        $this->response['message'] = session('cart');

        return response()->json($this->response);
    }

    public function insertOrUpdate(Request $request) 
    {
        try {
            $productId = $request->input('productId');
            $sizeId = $request->input('sizeId');
            $optionId = $request->input('optionId');
            $quantity = $request->input('quantity', 1);
            $cart = session('cart');

            $product = $this->productRepository->getProductForCart($productId)->toArray();
            $size = $this->productPriceRepository->getById($sizeId)->toArray();
            $option = $optionId ? $this->productOptionRepository->getById($optionId)->toArray() : null;

            $product['quantity'] = $quantity;
            $product['sizeId'] = $size['id'];
            $product['sizeName'] = $size['name'];
            $product['optionId'] = $option ? $option['id'] : null;
            $product['optionName'] = $option ? $option['name'] : null;
            $product['price'] = $size['price'];
            $product['saleFrom'] = $size['sale_from'];
            $product['saleTo'] = $size['sale_to'];
    
            $product = $this->calPrice($product);
            $repeated = false;

            foreach ($cart['list'] as &$item) {
                if ($item['id'] == $productId) {
                    if ($item['sizeId'] == $sizeId) {
                        if ($item['optionId'] == $optionId) {
                            $item['quantity'] += $quantity;
                            $item = $this->calPrice($item);
                            $repeated = true;
                            break;
                        }
                    }
                }
            }
            if (!$repeated) $cart['list'][] = $product;

            $cart = $this->updateTotalPrice($cart);
            session(['cart' => $cart]);
            $this->updateCartForUser();

            $this->response['status'] = true;
            $this->response['message'] = session('cart');

            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
    }

    public function delete(Request $request) 
    {
        try {
            $key = $request->input('key');
            $cart = session('cart');
            unset($cart['list'][$key]);

            $cart = $this->updateTotalPrice($cart);
            session(['cart' => $cart]);
            $this->updateCartForUser();

            $this->response['status'] = true;
            $this->response['message'] = session('cart');

            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
    }

    public function deleteAllCart(Request $request) 
    {
        try {
            session()->forget('cart');
            $this->updateCartForUser();

            $this->response['status'] = true;
            $this->response['message'] = [];

            return response()->json($this->response);
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
            return response()->json($this->response);
        }
    }

    function updateTotalPrice($cart) 
    {
        try {
            $total = 0;
            foreach ($cart['list'] as &$item) {
                $item = $this->calPrice($item);
                $total += $item['total'];
            }
            $cart['total'] = $total;

            return $cart;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    function calPrice($product) 
    {
        try {
            $now = new DateTime();
            if (!$product['saleFrom'] && !$product['saleTo']) {
                $product['finalPrice'] = $product['price'];
                $product['total'] = $product['quantity'] * $product['finalPrice'];
            }
            else {
                $saleFrom = new DateTime($product['saleFrom']);
                $saleTo = new DateTime($product['saleTo']);
                if ($saleFrom > $now || $saleTo < $now) {
                    $product['finalPrice'] = $product['price'];
                    $product['total'] = $product['quantity'] * $product['finalPrice'];
                } 
                else {
                    $product['finalPrice'] = $product['sale'];
                    $product['total'] = $product['quantity'] * $product['finalPrice'];
                } 
            }
                
            return $product;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    function updateCartForUser() 
    {
        try {
            if(session()->has('clientLoged')) $this->userRepository->updateCartForUser(session('clientLoged'), session('cart'));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function mergeCart($userCart) 
    {
        try {
            $session = session('cart');

            foreach ($userCart['list'] as $item2) {
                $repeated = false;
                foreach ($session['list'] as &$item1) {
                    if ($item1['id'] == $item2['id']) {
                        if ($item1['sizeId'] == $item2['sizeId']) {
                            if ($item1['optionId'] == $item2['optionId']) {
                                $item1['quantity'] += $item2['quantity'];
                                $item1 = $this->calPrice($item1);
                                $repeated = true;
                                break;
                            }
                        }
                    }
                }
                if (!$repeated) $session['list'][] = $this->calPrice($item2);
            }
            
            $session = $this->updateTotalPrice($session);
            session(['cart' => $session]);
            $this->userRepository->updateCartForUser(session('clientLoged'), session('cart'));
        } catch (Exception $e) {
            $this->response['message'] = $e->getMessage();
        }
    }
}