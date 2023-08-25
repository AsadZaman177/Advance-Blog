@extends('backend.layout.master')

@section('title')
CMS
@endsection

@section('styles')

@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">CMS</h1>
</div>


<div class="row">
	<div class="col-md-12">
        <!-- About -->
        <div class="card shadow mb-4">
            <a href="#aboutPage" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">About Us Page</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse" id="aboutPage">
                <div class="card-body">
                   <form action="/storeblog" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="about_us">About Title</label>
                                <input class="form-control @error('about_us') is-invalid @enderror" type="text" name="about_us" id="about_us" placeholder="About Us">
                                @if($errors->has('about_us'))
                                    <small class="text-danger">{{ $errors->first('about_us') }}</small>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title">Short Description</label>
                                <input class="form-control @error('about_short_description') is-invalid @enderror" type="text" name="about_short_description" id="about_short_description" placeholder="What we do">
                                @if($errors->has('about_short_description'))
                                    <small class="text-danger">{{ $errors->first('about_short_description') }}</small>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea rows="5" class="form-control @error('description') is-invalid @enderror" name="description" id="description"></textarea>
                                @if($errors->has('description'))
                                    <small class="text-danger">{{ $errors->first('description') }}</small>
                                @endif
                            </div>
                        </div>
                        <button style="float: right;" class="btn btn-success" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact -->
        <div class="card shadow mb-4">
            <a href="#contactPage" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Contact Us Page</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse" id="contactPage">
                <div class="card-body">
                   <form action="/storeblog" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="conatct_us">Contact Title</label>
                                <input class="form-control @error('conatct_us') is-invalid @enderror" type="text" name="conatct_us" id="conatct_us" placeholder="About Us">
                                @if($errors->has('conatct_us'))
                                    <small class="text-danger">{{ $errors->first('conatct_us') }}</small>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title">Short Description</label>
                                <input class="form-control @error('contact_short_description') is-invalid @enderror" type="text" name="contact_short_description" id="contact_short_description" placeholder="What we do">
                                @if($errors->has('contact_short_description'))
                                    <small class="text-danger">{{ $errors->first('contact_short_description') }}</small>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea rows="5" class="form-control @error('conatct_description') is-invalid @enderror" name="conatct_description" id="conatct_description"></textarea>
                                @if($errors->has('conatct_description'))
                                    <small class="text-danger">{{ $errors->first('conatct_description') }}</small>
                                @endif
                            </div>
                        </div>
                        <button style="float: right;" class="btn btn-success" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="card shadow mb-4">
            <a href="#footer" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Footer Section</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse" id="footer">
                <div class="card-body">
                   <form action="/storeblog" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="twitter">Twitter</label>
                                <input class="form-control @error('twitter') is-invalid @enderror" type="text" name="twitter" id="twitter" placeholder="twiiter.com/test">
                                @if($errors->has('twitter'))
                                    <small class="text-danger">{{ $errors->first('twitter') }}</small>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label for="title">Facebook</label>
                                <input class="form-control @error('facebook') is-invalid @enderror" type="text" name="facebook" id="facebook" placeholder="facrbook.com">
                                @if($errors->has('facebook'))
                                    <small class="text-danger">{{ $errors->first('facebook') }}</small>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label for="title">Instagram</label>
                                <input class="form-control @error('instagram') is-invalid @enderror" type="text" name="instagram" id="instagram" placeholder="instagram.com">
                                @if($errors->has('instagram'))
                                    <small class="text-danger">{{ $errors->first('instagram') }}</small>
                                @endif
                            </div>      
                        </div>
                        <button style="float: right;" class="btn btn-success" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@include('backend.partials.tagsModals')
@section('scripts')
<!-- <script src="{{ asset('js/tags.js') }}"></script> -->
@endsection
