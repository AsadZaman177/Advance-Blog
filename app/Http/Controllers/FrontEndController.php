<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class FrontEndController extends Controller
{
    public function index(){
        $blogs = Blog::where('active','1')->paginate(1);

        return view('frontend.index',compact('blogs'));
    }

    public function singleBlog($url){
        $blog = Blog::where('url',$url)->first();
        
        return view('frontend.single',compact('blog'));
    }
    
}
