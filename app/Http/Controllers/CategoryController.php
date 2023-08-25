<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class CategoryController extends Controller
{
    // Return Category View
    public function index(){
        return view('backend.category');
    }

    // Display Categories Databale
    public function show(){

        $categories = Category::all();

        return Datatables::of($categories)
        ->addColumn('action', function ($category) {
            return '<a href="#" id="'. $category->id .'" class="btn btn-sm btn-primary editCategory"><i class="fa fa-edit"></i> Edit</a> 
            <a href="#" id="'. $category->id .'" class="btn btn-sm btn-danger deleteCategory"><i class="fa fa-trash"></i> Delete</a>';
            })
           ->editColumn('created_at', function ($category) {
                return $category->created_at ? with(new Carbon($category->created_at))->format('d/m/Y') : '';
            })
            ->editColumn('updated_at', function ($category) {
                return $category->updated_at ? with(new Carbon($category->updated_at))->format('d/m/Y') : '';
            })
        ->addIndexColumn()
        ->make(true);
    }

    // Store Category
    public function create(Request $request){
    $request->validate([
        'category_name' => 'required|min:3|',
    ]); 

    $slug =  Str::slug($request->category_name);

    $Category = Category::create([
        'name' => $request->category_name,
        'slug' => $slug,
    ]);

    return 'Success';
    }

    // Edit Category
    public function edit($id){

        $cat = Category::find($id);
       
       return $cat;
    }

    //Update Category
    public function update(Request $request){
        $request->validate([
        'editcategory_name' => 'required|min:3|',
    ],[
        'editcategory_name.required' => 'The category name is required',
        'editcategory_name.min' => 'The category name should be min 3 characters', 
    ]);

        $cat = Category::find($request->category_id);

        $cat->name = $request->editcategory_name;
        $cat->slug = Str::slug($request->editcategory_name);
        $cat->save();

        if($cat){
            return 'Success';
        }
        else{
            return Response::json(['error'=>'Not Found'], 404 );
        }
      
    }

    public function delete($id){

        $cat = Category::find($id);
        if($cat){
            $cat->delete();
            return 'Success';
        }
        else{
            return Response::json(['error'=>'Not Found'], 404 );
        }  

    }

}
