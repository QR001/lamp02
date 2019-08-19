<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class refunds extends Model
{
    //
<<<<<<< HEAD
    protected $fillable=['uid','did','r_num','payments','r_cause','r_explain'];
=======
    protected $fillable=['uid','did','r_num','r_cause','r_explain','r_payments'];
>>>>>>> origin/zhangyahan

    public function orderdetails(){
        return $this->belongsTo('App\Models\ordersdetails','did');
    }
}
