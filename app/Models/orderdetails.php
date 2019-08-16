<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orderdetails extends Model
{
    //

    protected $fillable=['oid','gid','d_num','d_color','d_status'];

    public function good(){
        return $this->belongsTo('App\Models\good','gid');
    }

    public function order(){
        return $this->belongsTo('App\Models\orders','oid');
    }

    public function refunds(){
        return $this->hasOne('App\Models\refunds','did');
    }
}
