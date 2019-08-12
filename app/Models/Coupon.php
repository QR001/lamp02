<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //白名单
    protected $fillable = ['uid','c_money','c_type','c_status','c_time'];
}
