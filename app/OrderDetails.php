<?php

namespace App;

use App\Constants\Common;
use App\Helpers\Utils;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::ORDER_DETAILS;
    
    public function getPrice() {
        return Utils::formatCurrency($this->price);
    }
    
    public function getCost() {
        return Utils::formatCurrency($this->cost);
    }
}
