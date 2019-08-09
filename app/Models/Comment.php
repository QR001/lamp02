<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
<<<<<<< HEAD
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
=======
    //白名单
    protected $fillable = ['c_score','c_content','c_img','uid','gid'];
>>>>>>> origin/zhangyahan
}
