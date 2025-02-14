<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    //
    protected $fillable = ['uid','sid','o_consignee','o_contact','o_address','cid','o_no','o_amount','o_status','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\user','uid','id');
    }

    public function sends()
    {
        
        return $this->belongsTo('App\Models\sends','sid','id');
    }

    public function orderdetails(){
        return $this->hasOne('App\Models\orderdetails','oid','id');
    }
    
    public function refunds(){
        return $this->belongsTo('App\Models\refunds','uid');
    }
   

   
}
