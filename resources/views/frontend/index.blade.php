@extends('frontend.layout.master')

@section('title')
My Blog
@endsection

@section('styles')

@endsection

@section('content')

<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">
    	@foreach($blogs as $blog)
        <!-- Post preview-->
        <div class="post-preview">
            <a href="{{ url('/blog/'.$blog->url) }}">
                <h2 class="post-title">{{ $blog->title }}</h2>
                <h3 class="post-subtitle">{{ $blog->short_description }}</h3>
            </a>
            <p class="post-meta">
                Posted by
                <a href="#!">{{ $blog->user->name }}</a>
                on {{ Carbon\Carbon::parse($blog->created_at)->Format('F d,Y') }}
            </p>
        </div>
            @if(!$loop->last)
                <hr class="my-4" />
            @endif
        @endforeach
        
        <!-- Pager-->
        <div class="d-flex justify-content-end mb-4">
            <nav aria-label="paginate">
                <ul class="pagination justify-content-end">
                    {{ $blogs->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection

