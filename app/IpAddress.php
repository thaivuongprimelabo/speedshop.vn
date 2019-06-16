<?php

namespace App;

use App\Constants\Common;
use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model
{
    //
    public $timestamps = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::IP_ADDRESS;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ip', 'location', 'created_at'];
}
