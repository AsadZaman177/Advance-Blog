<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Role Has Many Users
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
