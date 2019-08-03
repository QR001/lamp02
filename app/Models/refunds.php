<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class refunds extends Model
{
    //
    protected $fillable=['uid','did','r_num','r_cause','r_explain'];

    public function orderdetails(){
        return $this->belongsTo('App\Models\ordersdetails','did');
    }
}
