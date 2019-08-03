<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    //
    protected $fillable = ['name','passsword','status','power','email_status'];
    
    public function orders()
    {
    
        return $this->hasMany('App\Models\orders');
    
    }
}
