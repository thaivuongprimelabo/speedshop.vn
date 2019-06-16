<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class Cart {

    private $cart = [];
    private $total = 0;
    private $totalFormat = 0;
    private $count = 0;
    private $cartItem = null;
    private $session = null;
    private $checkoutInfo = null;
    private $subTotal = 0;
    private $shipFee = 0;
    public static $instance;
    
    public function __construct() {
        self::$instance = self::$instance;
    }
    
    public static function getInstance($session) {
        if (self::$instance === null) {
            if($session->has('cart')) {
                self::$instance = $session->get('cart');
            } else {
                self::$instance = new self();
            }
            
            self::$instance->session = $session;
        }
        return self::$instance;
    }
    
    public function getCart() {
        return $this->cart;
    }
    
    public function setCart($_cart) {
        $this->cart = $_cart;
        if(!count($this->cart)) {
            $this->session->remove('cart');
        } else {
            $this->session->put('cart', $this);
        }
    }
    
    public function setCheckoutInfo($_info) {
        $this->checkoutInfo = $_info;
    }
    
    public function setCount($_count) {
        $this->count = $_count;
    }
    
    public function setShipFee($_shipFee) {
        $this->shipFee = $_shipFee;
    }
    
    public function getSubTotal() {
        $this->subTotal = 0;
        foreach($this->cart as $cartItem) {
            $this->subTotal += $cartItem->getCostIncludeDetail();
        }
        return $this->subTotal;
    }
    
    public function getTotal() {
        $this->total = 0;
        $this->total = $this->subTotal + $this->shipFee;
        return $this->total;
    }
    
    public function getCheckoutInfo() {
        return $this->checkoutInfo;
    }
    
    public function getTotalFormat() {
        return Utils::formatCurrency($this->getTotal());
    }
    
    public function getSubTotalFormat() {
        return Utils::formatCurrency($this->getSubTotal());
    }
    
    public function getShipFee() {
        return $this->shipFee;
    }
    
    public function getShipFeeFormat() {
        return Utils::formatCurrency($this->getShipFee());
    }
    
    public function addItem(CartItem $cartItem) {
        $flg = false;
        foreach($this->cart as $cItem) {
            if($cItem->getId() == $cartItem->getId()) {
                $cItem->setQty($cartItem->getQty());
                $cItem->setDetailList($cartItem->getDetailList());
                $flg = true;
                break;
            }
        }
        if(!$flg) {
            array_push($this->cart, $cartItem);
        }
        $this->cartItem = $cartItem;
        $this->session->put('cart', $this);
    }
    
    public function addDetailItem($id, CartItem $detailItem) {
        foreach($this->cart as $cartItem) {
            if($cartItem->getId() == $id) {
                $cartItem->addDetailItem($detailItem);
                break;
            }
        }
        
        $this->cartItem = $cartItem;
        $this->session->put('cart', $this);
    }
    
    public function getCartItem() {
        return $this->cartItem;
    }
    
    public function getCount() {
        $this->count = count($this->cart);
        return $this->count;
    }
    
    public function getTopCart() {
        return view('shop.common.top_cart', ['cart' => $this])->render();
    }
    
    public function getMainCart() {
        return view('shop.common.main_cart', ['cart' => $this])->render();
    }
    
    public function getMainCartMobile() {
        return view('shop.common.main_cart_mobile', ['cart' => $this])->render();
    }
    
    public function updateCart($id, $qty) {
        foreach($this->cart as $cartItem) {
            if($cartItem->getId() == $id) {
                $cartItem->setQty($qty);
            }
        }
        
        $this->session->put('cart', $this);
    }
    
    public function updateCartDetail($pid, $did, $qty) {
        foreach($this->cart as $cartItem) {
            if($cartItem->getId() == $pid) {
                $detailList = $cartItem->getDetailList();
                foreach($detailList as $detail) {
                    if($detail->getId() == $did) {
                        $detail->setQty($qty);
                    }
                }
            }
        }
        
        $this->session->put('cart', $this);
    }
    
    public function removeItem($id) {
        $cart = [];
        foreach($this->cart as $cartItem) {
            if($cartItem->getId() != $id) {
                array_push($cart, $cartItem);
            }
        }
        
        $this->setCart($cart);
    }
    
    public function removeDetailItem($pid, $id) {
        foreach($this->cart as $cartItem) {
            if($cartItem->getId() == $pid) {
                $detailList = [];
                foreach($cartItem->getDetailList() as $detail) {
                    if($detail->getId() != $id) {
                        array_push($detailList, $detail);
                    }
                }
                
                $cartItem->setDetailList($detailList);
            }
        }
        
        $this->setCart($this->cart);
    }
    
    public function destroy() {
        $this->session->remove('cart');
    }
}
?>