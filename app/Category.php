<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $fillable = [
        'name', 'slug',
    ];

   // Category Has Many Blogs
   public function blogs(){

        return $this->hasMany('App\Blog');
   }

   public static function boot() {
        parent::boot();

        static::deleting(function($category) { // before delete() method call this
               $uncategorized = Category::firstOrCreate(['name' => 'Uncategorized', 'slug' => 
                             'uncategorized']);
               Blog::where('category_id', $category->id)->update(
                             ['category_id' => $uncategorized->id]);
        });
     }
}
