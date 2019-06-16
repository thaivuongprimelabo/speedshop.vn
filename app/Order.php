<?php

namespace App;

use App\Constants\Common;
use App\Helpers\Utils;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Constants\StatusOrders;

class Order extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::ORDERS;
    
    public function getOrderDetails() {
        $orderDetails = OrderDetails::select(
                            'order_details.order_id',
                            DB::raw('(CASE WHEN order_details.product_detail_id = 0 THEN order_details.product_id ELSE \'\' END) AS product_id'),
                            'order_details.name',
                            'order_details.qty',
                            'order_details.price',
                            'order_details.cost'
                        )
                        ->where('order_details.order_id', $this->id)
                        ->get();
        
        return $orderDetails;
    }
    
    public function getTotal() {
        return Utils::formatCurrency($this->total);
    }
    
    public function getSubTotal() {
        return Utils::formatCurrency($this->subtotal);
    }
    
    public function getShipFee() {
        return Utils::formatCurrency($this->ship_fee);
    }
    
    public function getAddress() {
        return $this->customer_address . ' ' . $this->customer_district . ' ' . $this->customer_province;
    }
    
    public function getStatus() {
        $status = StatusOrders::getData($this->status);
        return $status;
    }
    
}
