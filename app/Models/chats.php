<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chats extends Model
{
    //

    protected $fillable = ['uid','kid','u_content','u_status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
}
