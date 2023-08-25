<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Tag;
use App\Category;
use App\Blog;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class BlogController extends Controller
{
    // return blogs view
    public function index(){

        return view('backend.blogs');
    }

    // Reuturn All Blogs
    public function getAllBlogs(){
        $blogs = Blog::all();
       
        return Datatables::of($blogs)
        ->addColumn('image', function ($blog) {
              $url= asset('images/blogImages/'.$blog->image);
              return '<img src="'.$url.'"class="img-thumbnail" />';
            })
        ->addColumn('category_id', function ($blog) {
              return '<span class="badge badge-primary badge-pill">'.$blog->category->name.'</span>';
            })
        ->addColumn('id', function ($blog) {
                return $blog->tags->map(function($tag) {
                        return '<span class="badge badge-dark badge-pill">'.$tag->name.'</span>';
                    })->implode('<br>');
            })
        ->editColumn('created_at', function ($blog) {
                return $blog->created_at ? with(new Carbon($blog->created_at))->format('d/m/Y') : '';
            })
        ->addColumn('user_id', function ($blog) {
              return '<span class="badge badge-success badge-pill">'.$blog->user->name.'</span>';
            })
        ->addColumn('active', function ($blog) {
              if($blog->active == '1'){
                $status = 'active';
                return '<span class="badge badge-warning badge-pill">'.$status.'</span>';
              }
              else{
                $status = 'Deactive';
                return '<span class="badge badge-danger badge-pill">'.$status.'</span>';
              }
            })
        ->addColumn('action', function ($blog) {
            return '<a href="/editblog/'. $blog->id .'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> 
            <a href="/deleteblog/'. $blog->id .'" id="'. $blog->id .'" class="btn btn-sm btn-danger deleteBlog"><i class="fa fa-trash"></i> Delete</a>';
            })
        ->addIndexColumn()
        ->rawColumns(['image','category_id','user_id','id','active', 'action'])
        ->make(true);

    }

    // Create blog form
    public function create(){

        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.createblog',compact('categories','tags'));
    }

    // Store Blog
    public function store(Request $request){
         // dd($request->all());
        $user = Auth::user();
        $publish = $request->publish == 'on' ? '1' : '0';
        
        $this->validateBlog($request);

        $uploadedImage = $request->file('image');
        $imageWithExt = $uploadedImage->getClientOriginalName($uploadedImage);
        $imageName = pathinfo($imageWithExt,PATHINFO_FILENAME);
        $imageExt = $uploadedImage->getClientOriginalExtension();
        $image = $imageName . time() . "." .$imageExt;
        $request->image->move(public_path('images/blogImages'),$image);
        
        $blog = Blog::create([ 
                'user_id' => $user->id,
                'category_id' => $request->category,
                'title' => $request->title,
                'url' => $request->url,
                'image' => $image,
                'image_alt' => $request->image_alt,
                'meta' => $request->meta,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'active' => $publish,
                ]);

            
                $blog->tags()->attach($request->tags);

                return redirect()->back()->with('Success','Successful!');
    }

    // Blog Validation
    public function validateBlog($request){
        $request->validate([
            'title' => 'required',
            'url' => 'required|unique:blogs',
            'category' => 'required',
            'tags' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,bmp,gif|max:4000',
            'image_alt' => 'required',
            'meta' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);
    } 

    //Edit Blog 
    public function edit($id){
        $categories = Category::all();
        $tags = Tag::all();
        $blog = Blog::find($id);
        return view('backend.editblog',compact('categories','tags','blog'));
    }

    // Update Blog
    public function update(Request $request){
        $user = Auth::user();
        $blog = Blog::findOrFail($request->blog_id);
        
        $this->updateBlogValidation($request);

        $publish = $request->publish == 'on' ? '1' : '0';

        $storeImage = $blog->image;
        if($request->has('image')){
            $path = "images/blogImages";
            $image = $blog->image;
            $this->deleteImage($path,$image);

            $uploadedImage = $request->file('image');
            $imageWithExt = $uploadedImage->getClientOriginalName($uploadedImage);
            $imageName = pathinfo($imageWithExt,PATHINFO_FILENAME);
            $imageExt = $uploadedImage->getClientOriginalExtension();
            $storeImage = $imageName . time() . "." .$imageExt;
            $request->image->move(public_path('images/blogImages'),$storeImage);
        }
            $blog->title = $request->title;
            $blog->url = $request->url;
            $blog->category_id = $request->category;
            $blog->user_id = $user->id;
            $blog->image = $storeImage;
            $blog->image_alt = $request->image_alt;
            $blog->meta = $request->meta;
            $blog->short_description = $request->short_description;
            $blog->description = $request->description;
            $blog->save();
            $blog->tags()->sync($request->tags);

        return redirect()->back()->with('Success','Successful!');

    }

    // Update Blog validation
    public function updateBlogValidation($request){
        if($request->has('image'))
        {
            $request->validate([
                'title' => 'required',
                'url' => 'required|unique:blogs,url,'.$request->blog_id,
                'category' => 'required',
                'tags' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png,bmp,gif|max:4000',
                'image_alt' => 'required',
                'meta' => 'required',
                'short_description' => 'required',
                'description' => 'required',
            ]);
        }  
        else{
             $request->validate([
                'title' => 'required',
                'url' => 'required|unique:blogs,url,'.$request->blog_id,
                'category' => 'required',
                'tags' => 'required',
                'image_alt' => 'required',
                'meta' => 'required',
                'short_description' => 'required',
                'description' => 'required',
            ]);
        }  
    }

    // Delete Blog
    public function delete($id){

        $blog = Blog::find($id);
        if($blog){
            $path = "images/blogImages";
            $image = $blog->image;
            $this->deleteImage($path,$image);
            $blog->delete();
            return 'Success';
        }
        else{
            return Response::json(['error'=>'Not Found'], 404 );
        }  

    }

    // Delete Image
    public function deleteImage($path,$image){
        if(file_exists(public_path().$path.$image)){
            unlink(public_path().$path.$image);
        }
    }

    // Awaiting Approval Blogs
    public function awaiting(){
        return view('backend.awaiting');
    }

    // Reuturn All Awaiting
    public function getAllAwaiting(){
        $blogs = Blog::where('active',0)->get();
       
        return Datatables::of($blogs)
        ->addColumn('image', function ($blog) {
              $url= asset('images/blogImages/'.$blog->image);
              return '<img src="'.$url.'"class="img-thumbnail" />';
            })
        ->addColumn('category_id', function ($blog) {
              return '<span class="badge badge-primary badge-pill">'.$blog->category->name.'</span>';
            })
        
        ->addColumn('user_id', function ($blog) {
              return '<span class="badge badge-success badge-pill">'.$blog->user->name.'</span>';
            })
        ->addColumn('active', function ($blog) {
              if($blog->active == '1'){
                $status = 'active';
                return '<span class="badge badge-warning badge-pill">'.$status.'</span>';
              }
              else{
                $status = 'Deactive';
                return '<span class="badge badge-danger badge-pill">'.$status.'</span>';
              }
            })
        ->addColumn('action', function ($blog) {
            return '
            <a href="#" id="'. $blog->id .'" class="btn btn-sm btn-success approve"><i class="fa fa-check"></i> Approve</a>
            <a href="/editblog/'. $blog->id .'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> 
            <a href="/deleteblog/'. $blog->id .'" id="'. $blog->id .'" class="btn btn-sm btn-danger deleteBlog"><i class="fa fa-trash"></i> Delete</a>';
            })
        ->addIndexColumn()
        ->rawColumns(['image','category_id','user_id','id','active', 'action'])
        ->make(true);

    }

    // Approve Blogs
    public function approveBlog($id){
        $blog = Blog::find($id);
        if($blog){
            $blog->active = 1;
            $blog->save();
            return 'Success';
        }
        else{
            return Response::json(['error'=>'Not Found'], 404 );
        }  
    }

    /******************* User Functions **************/
    // User Awaiting Blogs
    public function UserAwaitingBlogs(){
        
        return view('userpanel.awaitingblogs');
    }

    // User All Awaiting
    public function AllUserAwaitingBlogs(){
        $user_id = Auth::user()->id;
        $blogs = Blog::where('active',0)->where('user_id',$user_id)->get();
       
        return Datatables::of($blogs)
        ->addColumn('image', function ($blog) {
              $url= asset('images/blogImages/'.$blog->image);
              return '<img src="'.$url.'"class="img-thumbnail" />';
            })
        ->addColumn('category_id', function ($blog) {
              return '<span class="badge badge-primary badge-pill">'.$blog->category->name.'</span>';
            })
        
        ->addColumn('user_id', function ($blog) {
              return '<span class="badge badge-success badge-pill">'.$blog->user->name.'</span>';
            })
        ->addColumn('active', function ($blog) {
              if($blog->active == '1'){
                $status = 'active';
                return '<span class="badge badge-warning badge-pill">'.$status.'</span>';
              }
              else{
                $status = 'Deactive';
                return '<span class="badge badge-danger badge-pill">'.$status.'</span>';
              }
            })
        ->addColumn('action', function ($blog) {
            return '
            <a href="/user/editblog/'. $blog->id .'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> 
            <a href="/deleteblog/'. $blog->id .'" id="'. $blog->id .'" class="btn btn-sm btn-danger deleteBlog"><i class="fa fa-trash"></i> Delete</a>';
            })
        ->addIndexColumn()
        ->rawColumns(['image','category_id','user_id','id','active', 'action'])
        ->make(true);
    }

    //User Edit Blog 
    public function useredit($id){
        $categories = Category::all();
        $tags = Tag::all();
        $blog = Blog::find($id);
        return view('userpanel.editblog',compact('categories','tags','blog'));
    }

    //User Update Blog
    public function userupdate(Request $request){
        $user = Auth::user();
        $blog = Blog::findOrFail($request->blog_id);
        
        $this->updateBlogValidation($request);

        $publish = $request->publish == 'on' ? '1' : '0';

        $storeImage = $blog->image;
        if($request->has('image')){
            $path = "images/blogImages";
            $image = $blog->image;
            $this->deleteImage($path,$image);

            $uploadedImage = $request->file('image');
            $imageWithExt = $uploadedImage->getClientOriginalName($uploadedImage);
            $imageName = pathinfo($imageWithExt,PATHINFO_FILENAME);
            $imageExt = $uploadedImage->getClientOriginalExtension();
            $storeImage = $imageName . time() . "." .$imageExt;
            $request->image->move(public_path('images/blogImages'),$storeImage);
        }
            $blog->title = $request->title;
            $blog->url = $request->url;
            $blog->category_id = $request->category;
            $blog->user_id = $user->id;
            $blog->image = $storeImage;
            $blog->image_alt = $request->image_alt;
            $blog->meta = $request->meta;
            $blog->short_description = $request->short_description;
            $blog->description = $request->description;
            $blog->save();
            $blog->tags()->sync($request->tags);

        return redirect()->back()->with('Success','Successful!');
    }
    // User Approved Blogs
    public function UserApprovedBlogs(){
        
        return view('userpanel.approvedblogs');
    }

    // User All Approved
    public function AllUserApprovedBlogs(){
        $user_id = Auth::user()->id;
        $blogs = Blog::where('active',1)->where('user_id',$user_id)->get();
       
        return Datatables::of($blogs)
        ->addColumn('image', function ($blog) {
              $url= asset('images/blogImages/'.$blog->image);
              return '<img src="'.$url.'"class="img-thumbnail" />';
            })
        ->addColumn('category_id', function ($blog) {
              return '<span class="badge badge-primary badge-pill">'.$blog->category->name.'</span>';
            })
        
        ->addColumn('user_id', function ($blog) {
              return '<span class="badge badge-success badge-pill">'.$blog->user->name.'</span>';
            })
        ->addColumn('active', function ($blog) {
              if($blog->active == '1'){
                $status = 'active';
                return '<span class="badge badge-warning badge-pill">'.$status.'</span>';
              }
              else{
                $status = 'Deactive';
                return '<span class="badge badge-danger badge-pill">'.$status.'</span>';
              }
            })
        ->addColumn('action', function ($blog) {
            return '
            <a href="/deleteblog/'. $blog->id .'" id="'. $blog->id .'" class="btn btn-sm btn-danger deleteBlog"><i class="fa fa-trash"></i> Delete</a>';
            })
        ->addIndexColumn()
        ->rawColumns(['image','category_id','user_id','id','active', 'action'])
        ->make(true);
    }

}
