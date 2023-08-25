<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'slug',
    ];

    // Tags have many blogs
    public function blogs(){
        return $this->belongsToMany('App\Blog');
    }
}
