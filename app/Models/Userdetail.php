<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userdetail extends Model
{
    //
    protected $fillable = [
        'uid',
        'realname',
        'sex',
        'description',
        'integral',
        'phone',
        'pic'
    ];

    public function user()
    {
        $this->belongsTo('App\Models\user','uid');
    }
}
