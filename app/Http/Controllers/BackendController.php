<?php

namespace App\Http\Controllers;
use App\Category;
use App\Tag;
use App\Blog;
use App\User;

use Illuminate\Http\Request;

class BackendController extends Controller
{
    // Admin 
    public function Dashboard(){
        $categoriesCount = Category::count();
        $tagsCount = Tag::count();
        $blogsCount = Blog::count();
        $publishedBlogs = Blog::where('active','1')->count();
        $waitingBlogs = Blog::where('active','0')->count();
        $userCount = User::count();
        return view('backend.dashboard',compact('categoriesCount','tagsCount','blogsCount','publishedBlogs','waitingBlogs','userCount'));
    }

    public function cms(){
        return view('backend.cms');
    }

    public function userDashboard(){
        return view('userpanel.dashboard');
    }

    // Create blog form
    public function createBlog(){

        $categories = Category::all();
        $tags = Tag::all();
        return view('userpanel.createblog',compact('categories','tags'));
    }

    
}
