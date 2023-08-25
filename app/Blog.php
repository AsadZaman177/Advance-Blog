<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id', 'category_id','title','url','image','image_alt','meta','short_description','description',
        'active',
    ];

    // Blogs belongs to User

    public function user(){

        return $this->belongsTo('App\User');
    }

    // Blogs belongs to Category
    public function category(){

        return $this->belongsTo('App\Category');
    }

    // Blogs have many tags
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
