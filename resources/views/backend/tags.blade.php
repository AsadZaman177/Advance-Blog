@extends('backend.layout.master')

@section('title')
Tags
@endsection

@section('styles')

@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Tags</h1>
</div>


<div class="row">
	<div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tags</h6>
                <a href="#" data-toggle="modal" data-target="#addTagModal" class="btn btn-success btn-sm">Add Tag</a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
               <table class="table table-bordered table-slim table-hover" id="tags">
                   <thead>
                       <tr>
                           <th>SN:</th>
                           <th>Name</th>
                           <th>Slug</th>
                           <th>Created At</th>
                           <th>Updated At</th>
                           <th>Action</th>
                       </tr>
                   </thead>
                   
               </table>
            </div>
        </div>
    </div>
</div>

@endsection

@include('backend.partials.tagsModals')
@section('scripts')
<script src="{{ asset('js/tags.js') }}"></script>
@endsection
