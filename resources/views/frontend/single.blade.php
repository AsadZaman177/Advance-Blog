@extends('frontend.layout.master')

@section('title')
My Blog
@endsection

@section('styles')

@endsection

@section('content')
 <!-- Page Header-->
  <header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
      <div class="container position-relative px-4 px-lg-5">
          <div class="row gx-4 gx-lg-5 justify-content-center">
              <div class="col-md-10 col-lg-8 col-xl-7">
                  <div class="post-heading">
                      <h1>{{ $blog->title }}</h1>
                      <span class="meta">
                          Posted by
                          <a href="#!">{{ $blog->user->name }}</a>
                          on {{ Carbon\Carbon::parse($blog->created_at)->Format('F d,Y') }}
                      </span>
                  </div>
              </div>
          </div>
      </div>
  </header>
<div class="row gx-4 gx-lg-5 justify-content-center">
  <div class="col-md-10 col-lg-8 col-xl-7">
      <p>{{ $blog->short_description }}</p>

      <img class="img-fluid" src="{{ asset('/images/blogImages/'.$blog->image) }}" alt="{{ $blog->image_alt }}" />
     
      <p>{!! $blog->description !!}</p>
      
      
  </div>
</div>
@endsection

@section('scripts')

@endsection

