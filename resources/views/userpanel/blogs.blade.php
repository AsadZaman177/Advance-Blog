@extends('backend.layout.master')

@section('title')
Blogs
@endsection

@section('styles')

@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Blogs</h1>
</div>


<div class="row">
	<div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Blogs</h6>
                <a href="{{ url('/createblog') }}" class="btn btn-success btn-sm">Create</a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
               <table class="table table-bordered table-slim table-hover" id="blogs">
                   <thead>
                       <tr>
                           <th>SN:</th>
                           <th>Title</th>
                           <th>Image</th>
                           <th>Slug</th>
                           <th>Category</th>
                           <th>Tags</th>
                           <th>Created At</th>
                           <th>Author</th>
                           <th>Status</th>
                           <th>Action</th>
                       </tr>
                   </thead>
                   
               </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/blogs.js') }}"></script>
@endsection
