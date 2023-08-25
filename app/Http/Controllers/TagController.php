<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Tag;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class TagController extends Controller
{
     // Return Tags View
    public function index(){
        return view('backend.tags');
    }

    // Display Tags Databale
    public function show(){
        $tags = Tag::all();

        return Datatables::of($tags)
        ->addColumn('action', function ($tag) {
            return '<a href="#" id="'. $tag->id .'" class="btn btn-sm btn-primary editTag"><i class="fa fa-edit"></i> Edit</a> 
            <a href="#" id="'. $tag->id .'" class="btn btn-sm btn-danger deleteTag"><i class="fa fa-trash"></i> Delete</a>';
            })
           ->editColumn('created_at', function ($tag) {
                return $tag->created_at ? with(new Carbon($tag->created_at))->format('d/m/Y') : '';
            })
            ->editColumn('updated_at', function ($tag) {
                return $tag->updated_at ? with(new Carbon($tag->updated_at))->format('d/m/Y') : '';
            })
        ->addIndexColumn()
        ->make(true);
    }

    // Store Tag
    public function create(Request $request){
    $request->validate([
        'tag_name' => 'required|min:3|',
    ]); 

    $slug =  Str::slug($request->tag_name);

    $tag = Tag::create([
        'name' => $request->tag_name,
        'slug' => $slug,
    ]);

    return 'Success';
    }

    // Edit Category
    public function edit($id){

        $tag = Tag::find($id);
       
       return $tag;
    }

    //Update Tag
    public function update(Request $request){
  
        $request->validate([
        'edittag_name' => 'required|min:3|',
    ],[
        'edittag_name.required' => 'The tag name is required',
        'edittag_name.min' => 'The tag name should be min 3 characters', 
    ]);

        $tag = Tag::find($request->tag_id);

        $tag->name = $request->edittag_name;
        $tag->slug = Str::slug($request->edittag_name);
        $tag->save();

        if($tag){
            return 'Success';
        }
        else{
            return Response::json(['error'=>'Not Found'], 404 );
        }
      
    }

    public function delete($id){

        $tag = Tag::find($id);
        if($tag){
            $tag->delete();
            return 'Success';
        }
        else{
            return Response::json(['error'=>'Not Found'], 404 );
        }  

    }
}
