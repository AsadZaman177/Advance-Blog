@extends('customAuth.master')

@section('title')
Login
@endsection

@section('styles')
@endsection

@section('content')
<div class="container">

	<!-- Outer Row -->
	<div class="row justify-content-center">

		<div class="col-xl-6 col-lg-6 col-md-6">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-12">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
								</div>
								<form method="POST" action="{{ route('login') }}" class="user">
									@csrf
									<div class="form-group">
										<input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
										name="email" value="{{ old('email') }}" placeholder="Enter Email Address..." autofocus>
										@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group">
										<input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="current-password">
										@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group">
										<div class="custom-control custom-checkbox small">
											<input class="custom-control-input" type="checkbox" name="remember" id="remember" class="{{ old('remember') ? 'checked' : '' }}"> 
	
											<label class="custom-control-label" for="remember">Remember
											Me</label>
											
										</div>
										

									</div>
									<button type="submit" class="btn btn-primary btn-user btn-block">
										{{ __('Login') }}
									</button>
									<hr>
								</form>
								<hr>
								<div class="text-center">
									@if (Route::has('password.request'))
									<a class="btn btn-link" href="{{ route('password.request') }}">
										{{ __('Forgot Your Password?') }}
									</a>
									@endif
								</div>
								<div class="text-center">
									<a class="small" href="{{ route('register') }}">Create an Account!</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>
@endsection

@section('scripts')
@endsection