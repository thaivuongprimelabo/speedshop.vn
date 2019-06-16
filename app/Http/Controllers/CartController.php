<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Product;
use App\Helpers\Cart;
use App\Helpers\CartItem;
use App\Helpers\Utils;
use App\Order;
use Carbon\Carbon;
use App\Constants\Common;
use App\Constants\StatusOrders;
use App\OrderDetails;
use App\Constants\ProductType;
use App\ProductDetails;

class CartController extends AppController
{
    public $breadcrumb = [];
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->breadcrumb = [route('home') => trans('shop.home')];
    }
    
    public function index(Request $request) {

        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.cart_txt')]
        ];
        
        $this->setSEO(['title' => trans('shop.cart_txt')]);
        
        return view('shop.cart', $this->output);
    }
    
    public function addToCart(Request $request) {
        $result = [];
        if($request->ajax()) {
            $pid = $request->pid;
            $id = $request->id;
            $qty = $request->qty;
            $items = $request->items;
            $cart = Cart::getInstance($request->getSession());
            
            $product = Product::find($pid);
            if($product) {
                $cartItem = new CartItem();
                $cartItem->setId($product->id);
                $cartItem->setName($product->getName());
                $cartItem->setImage($product->getFirstImage('small'));
                $cartItem->setPrice($product->getPrice(false));
                if($product->discount) {
                    $cartItem->setPrice($product->getPriceDiscount(false));
                }
                $cartItem->setQty($qty);
                $cartItem->setLink($product->getLink());
                
                if($items != null && count($items)) {
                    foreach($items as $item) {
                        $detailItem = new CartItem();
                        $detailItem->setId($item['id']);
                        $detailItem->setName($item['name']);
                        $detailItem->setPrice($item['price']);
                        $detailItem->setQty($qty);
                        $detailItem->setGroupId($item['group_id']);
                        $detailItem->setGroupName($item['group_name']);
                        $cartItem->addDetailItem($detailItem);
                    }
                }
                
                $cart->addItem($cartItem);
            }
            
            $result['#cart_1'] = view('shop.common.cart_item', ['cart' => $cart])->render();
            $result['.cartCount2'] = $cart->getCount();
            $result['#top_cart'] = $cart->getTopCart();
            return response()->json($result);
        }
        
        return response()->json($result);
    }
    
    public function updateCart(Request $request) {
        $result = [];
        if($request->ajax()) {
            $pid = $request->pid;
            $qty = $request->qty;
            
            $cart = Cart::getInstance($request->getSession());
            $cart->updateCart($pid, $qty);
            
            $this->loadCart($cart, $result);
            return response()->json($result);
        }
    }
    
    public function updateCartDetail(Request $request) {
        $result = [];
        if($request->ajax()) {
            $pid = $request->pid;
            $did = $request->did;
            $qty = $request->qty;
            
            $cart = Cart::getInstance($request->getSession());
            $cart->updateCartDetail($pid, $did, $qty);
            
            $this->loadCart($cart, $result);
            return response()->json($result);
        }
    }
    
    public function removeItem(Request $request) {
        $result = [];
        if($request->ajax()) {
            $id = $request->id;
            
            $cart = Cart::getInstance($request->getSession());
            $cart->removeItem($id);
            
            $this->loadCart($cart, $result);
            return response()->json($result);
        }
    }
    
    public function removeDetailItem(Request $request) {
        $result = [];
        if($request->ajax()) {
            $id = $request->id;
            $pid = $request->pid;
            
            $cart = Cart::getInstance($request->getSession());
            $cart->removeDetailItem($pid, $id);
            
            $this->loadCart($cart, $result);
            return response()->json($result);
        }
    }
    
    public function checkout(Request $request) {
        
        if(!$request->session()->has('cart')) {
            return redirect('/');
        }
        
        if($request->ajax()) {
            
            $result = [];
            
            $cart = Cart::getInstance($request->getSession());
            $cart->setShipFee(Utils::cnvnull($request->ship_fee, 0));
            
            DB::beginTransaction();
            
            try {
                
                $order = [
                    'customer_name' => Utils::cnvnull($request->customer_name, ''),
                    'customer_email' => Utils::cnvnull($request->customer_email, ''),
                    'customer_phone' => Utils::cnvnull($request->customer_phone, ''),
                    'customer_address' => Utils::cnvnull($request->customer_address, ''),
                    'customer_province' => Utils::cnvnull($request->customer_province, ''),
                    'customer_district' => Utils::cnvnull($request->customer_district, ''),
                    'customer_note' => Utils::cnvnull($request->customer_note, ''),
                    'payment_method' => Utils::cnvnull($request->payment_method, ''),
                    'status' => StatusOrders::ORDER_NEW,
                    'subtotal' => $cart->getSubTotal(),
                    'ship_fee' => $cart->getShipFee(),
                    'total' => $cart->getTotal(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                
                $id = DB::table(Common::ORDERS)->insertGetId($order);
                
                if($id) {
                    $order['id'] = $id;
                    $cart->setCheckoutInfo($order);
                    $orderDetails = [];
                    
                    foreach($cart->getCart() as $cartItem) {
                        
                        $orderDetail = [
                            'order_id' => $id,
                            'product_id' => $cartItem->getId(),
                            'product_detail_id' => 0,
                            'name' => $cartItem->getName(),
                            'qty' => $cartItem->getQty(),
                            'price' => $cartItem->getPrice(),
                            'cost' => $cartItem->getCost(),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                        
                        array_push($orderDetails, $orderDetail);
                        
                        $detailList = $cartItem->getDetailList();
                        foreach($detailList as $detail) {
                            
                            $orderDetail = [
                                'order_id' => $id,
                                'product_id' => $cartItem->getId(),
                                'product_detail_id' => $detail->getId(),
                                'name' => '<b>' . $detail->getGroupName() . '</b>: ' . $detail->getName(),
                                'qty' => $detail->getQty(),
                                'price' => $detail->getPrice(),
                                'cost' => $detail->getCost(),
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ];
                            
                            array_push($orderDetails, $orderDetail);
                        }
                        
                    }
                    
                    DB::table(Common::ORDER_DETAILS)->insert($orderDetails);
                }
                
                // Config mail
                $config = [
                    'from' => $this->output['config']['mail_from'],
                    'from_name' => $this->output['config']['mail_name'],
                    'subject' => '[' . $this->output['config']['web_name'] . '] '  . trans('shop.mail_subject.order_success', ['order_id' => $id]),
                    'msg' => [
                        'cart' => $cart,
                        'web_name' => $this->output['config']['web_name'],
                        'web_email' => $this->output['config']['web_email']
                    ],
                    'to'       => [$order['customer_email'], $this->output['config']['web_email']],
                    'template' => 'shop.emails.order_success'
                ];
                
                $message = Utils::sendMail($config);
                if(!Utils::blank($message)) {
                    \Log::error($message);
                }
                
                DB::commit();
                $result['checkout_result'] = true;

                
            } catch(\Exception $e) {
                $result['checkout_result'] = false;
                DB::rollBack();
            }
            
            return response()->json($result);
        }
        
        return view('shop.checkout', $this->output);
    }
    
    public function checkoutSuccess(Request $request) {
        
        if(!$request->session()->has('cart')) {
            return redirect('/');
        }
        
        $cart = Cart::getInstance($request->getSession());
        $cart->destroy();
        return view('shop.checkout_success', $this->output);
    }
    
    private function loadCart($cart, &$result = []) {
        $result['.cartCount2'] = $cart->getCount();
        $result['#top_cart'] = $cart->getTopCart();
        $result['#main_cart'] = $cart->getMainCart();
        $result['#main_cart_mobile'] = $cart->getMainCartMobile();
    }
}
