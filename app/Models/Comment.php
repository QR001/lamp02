<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    protected $fillable=['gid','uid','c_score','c_content'];

    public function Good()
    {
        $this->belongsTo('App\Models\Good','gid');
    }

    public function user()
    {
        $this->belongsTo('App\Models\user','uid');
    }
}
