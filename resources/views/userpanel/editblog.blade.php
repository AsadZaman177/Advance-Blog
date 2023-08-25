@extends('userpanel.layout.master')

@section('title')
Edit Blog
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    .ck-editor__editable_inline{
        height: 350px;
    }
</style>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Update Blog</h1>
</div>

@if(session()->has('Success'))
    <div class="alert alert-success">
        {{ session()->get('Success') }}
    </div>
@endif
@if(session()->has('Fail'))
    <div class="alert alert-danger">
        {{ session()->get('Fail') }}
    </div>
@endif

<div class="row">
	<div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="{{ url('/blogs') }}" class="btn btn-success btn-sm">Return</a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
               <form action="/user/updateblog" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blog-> id }}">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Blog Title</label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ $blog->title }}" id="title">
                            @if($errors->has('title'))
                                <small class="text-danger">{{ $errors->first('title') }}</small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">Url</label>
                            <input class="form-control @error('url') is-invalid @enderror" type="text" name="url" value="{{ $blog->url }}" id="url">
                            @if($errors->has('url'))
                                <small class="text-danger">{{ $errors->first('url') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="category">Category</label>
                            <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option {{ $blog->category->id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <small class="text-danger">{{ $errors->first('category') }}</small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tags">Tags</label>
                            <select class="tags form-control @error('tags') is-invalid @enderror" multiple="multiple" name="tags[]" id="tags">
                                @foreach($tags as $tag)
                                    <option
                                    @foreach($blog->tags as $bt)
                                        @if($bt->id == $tag->id)
                                            selected
                                        @endif
                                    @endforeach 
                                     value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tags'))
                                <small class="text-danger">{{ $errors->first('tags') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="image">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image">
                            @if($errors->has('image'))
                                <small class="text-danger">{{ $errors->first('image') }}</small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image_alt">Alt</label>
                            <input class="form-control @error('image_alt') is-invalid @enderror" type="text" name="image_alt" value="{{ $blog->image_alt }}" id="image_alt">
                            @if($errors->has('image_alt'))
                                <small class="text-danger">{{ $errors->first('image_alt') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="title">Meta</label>
                            <input class="form-control @error('meta') is-invalid @enderror" type="text" name="meta" value="{{ $blog->meta }}" id="meta">
                            @if($errors->has('meta'))
                                <small class="text-danger">{{ $errors->first('meta') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="short_description">Short Description</label>
                            <textarea rows="5" class="form-control @error('short_description') is-invalid @enderror"  name="short_description" id="short_description">{{ $blog->short_description }}</textarea>
                            @if($errors->has('short_description'))
                                <small class="text-danger">{{ $errors->first('short_description') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="description">Description</label>
                            <textarea rows="5" class="form-control @error('description') is-invalid @enderror" name="description" id="description">{!! $blog->description !!}</textarea>
                            @if($errors->has('description'))
                                <small class="text-danger">{{ $errors->first('description') }}</small>
                            @endif
                        </div>
                    </div>
                   <!--  <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>
                                <input name="publish" id="publish" type="checkbox" {{ $blog->active == 1 ? 'checked' : '' }}> Publish Now
                            </label>
                        </div>
                    </div> -->
                    <button style="float: right;" class="btn btn-success" type="submit">Submit</button>
               </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/blogs.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(".tags").select2({
    placeholder: "Select Tags",
    allowClear: true
    });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
