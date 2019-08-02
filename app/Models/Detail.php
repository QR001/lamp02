<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{

    protected $fillable = ['gid','d_trait','d_prompt','d_explain'];

    public function good()
    {
        return $this->belongsTo('App\Models\Good');
    }
}
