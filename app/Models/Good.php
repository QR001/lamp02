<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{

    protected $fillable = ['bid','g_name','g_status','g_size','g_color','g_img','g_sales','g_oprice','g_nprice','g_stock','g_integral','created_at','updated_at'];

    // public function detail()
    // {
    //     return $this->hasOne('App\Models\Detail','gid');
    // }

    // public function orderdetails(){
    //     return $this->belongsTo('App\Models\orderdetails','gid');
    // }
    public function orderdetails()
    {
    
        return $this->hasMany('App\Models\orderdetails');
    
    }

}
