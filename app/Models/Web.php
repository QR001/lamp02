<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Web extends Model
{
    //白名单
    protected  $fillable=['w_title','w_description','w_logo','w_isopen','w_cright','w_keyword'];
}
