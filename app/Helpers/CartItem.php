<?php

namespace App\Helpers;
class CartItem {

    private $id = '';
    private $name = '';
    private $image = '';
    private $qty = 0;
    private $price = 0;
    private $priceFormat = '';
    private $cost = 0;
    private $link = '';
    
    private $groupId = 0;
    private $groupName = '';
    
    private $detailList = [];
    
    public function setId($_id) {
        $this->id = $_id;
    }
    
    public function setName($_name) {
        $this->name = $_name;
    }
    
    public function setImage($_image) {
        $this->image = $_image;
    }
    
    public function setQty($_qty) {
        $this->qty = $_qty;
        $this->cost = $this->price * $this->qty;
    }
    
    public function setPrice($_price) {
        $this->price = $_price;
    }
    
    public function setPriceFormat($_priceformat) {
        $this->priceFormat = $_priceformat;
    }
    
    public function setLink($_link) {
        $this->link = $_link;
    }
    
    public function setGroupId($_groupid) {
        $this->groupId = $_groupid;
    }
    
    public function setGroupName($_groupname) {
        $this->groupName = $_groupname;
    }
    
    public function setDetailList($_detailList) {
        $this->detailList = $_detailList;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getImage() {
        return $this->image;
    }
    
    public function getQty() {
        return $this->qty;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function getPriceFormat() {
        return Utils::formatCurrency($this->price);
    }
    
    public function getCost() {
        //$this->cost = $this->price * $this->qty;
//         if(count($this->detailList)) {
//             foreach($this->detailList as $detail) {
//                 $this->cost += $detail->getCost();
//             }
//         }
        return $this->cost;
    }
    
    public function getCostIncludeDetail() {
        $cost = $this->price * $this->qty;
        if(count($this->detailList)) {
            foreach($this->detailList as $detail) {
                $cost += $detail->getCost();
            }
        }
        return $cost;
    }
    
    public function getCostFormat() {
        return Utils::formatCurrency($this->cost);
    }
    
    public function getLink() {
        return $this->link;
    }
    
    public function getDetailList() {
        return $this->detailList;
    }
    
    public function getGroupId() {
        return $this->groupId;
    }
    
    public function getGroupName() {
        return $this->groupName;
    }
    
    public function addDetailItem(CartItem $cartItem) {
        array_push($this->detailList, $cartItem);
    }
}
?>