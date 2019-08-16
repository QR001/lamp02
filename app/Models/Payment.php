<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = ['uid','balance','pid'];

    public function user()
    {
        return $this->belongsTo('App\Models\user','uid','id');
    }
}
