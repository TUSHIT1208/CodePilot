<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="Gambolthemes">
	<meta name="author" content="Gambolthemes">
	<title>CodePilot - Reset Password</title>

	<!-- Favicon Icon -->
	<link rel="icon" type="image/png" href="{{ asset('images/fav.png') }}">

	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
	<link href='{{ asset('vendor/unicons-2.0.1/css/unicons.css') }}' rel='stylesheet'>
	<link href="{{ asset('css/vertical-responsive-menu.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
	<link href="{{ asset('css/night-mode.css') }}" rel="stylesheet">

	<!-- Vendor Stylesheets -->
	<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/OwlCarousel/assets/owl.carousel.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/OwlCarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/bootstrap-select/docs/docs/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/semantic/semantic.min.css') }}">
</head>

<body class="sign_in_up_bg">
	<!-- Reset Password Start -->
	<div class="container">
		<div class="row justify-content-lg-center justify-content-md-center">
			<div class="col-lg-12">
				<div class="main_logo25" id="logo">
					<a href="index.html"><img src="{{ asset('images/logo.svg') }}" alt=""></a>
					<a href="index.html"><img class="logo-inverse" src="{{ asset('images/ct_logo.svg') }}" alt=""></a>
				</div>
			</div>

			<div class="col-lg-6 col-md-8">
				<div class="sign_form">
					<h2>Reset Your Password</h2>
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif
					<form method="POST" action="{{ route('password.update') }}">
						@csrf
						<input type="hidden" name="token" value="{{ $token }}">
						
						<div class="ui search focus mt-50">
							<div class="ui left icon input swdh95">
								<input class="prompt srch_explore" type="email" name="email" value="{{ old('email') }}" id="id_email" required maxlength="64" placeholder="Email Address">
								<i class="uil uil-envelope icon icon2"></i>
							</div>
							@error('email')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
						
						<div class="ui search focus mt-20">
							<div class="ui left icon input swdh95">
								<input class="prompt srch_explore" type="password" name="password" id="id_password" required maxlength="64" placeholder="New Password">
								<i class="uil uil-lock icon icon2"></i>
							</div>
							@error('password')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
						
						<div class="ui search focus mt-20">
							<div class="ui left icon input swdh95">
								<input class="prompt srch_explore" type="password" name="password_confirmation" id="id_password_confirmation" required maxlength="64" placeholder="Confirm Password">
								<i class="uil uil-lock icon icon2"></i>
							</div>
							@error('password_confirmation')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
						
						<button class="login-btn" type="submit">Reset Password</button>
					</form>
					<p class="mb-0 mt-30">Remembered your password? <a href="{{ route('login') }}">Sign In</a></p>
				</div>
				<div class="sign_footer"><img src="{{ asset('images/sign_logo.png') }}" alt="">© 2024 <strong>CodePilot</strong>. All Rights Reserved.</div>
			</div>
		</div>
	</div>
	<!-- Reset Password End -->

	<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('vendor/OwlCarousel/owl.carousel.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js') }}"></script>
	<script src="{{ asset('vendor/semantic/semantic.min.js') }}"></script>
	<script src="{{ asset('js/custom.js') }}"></script>
	<script src="{{ asset('js/night-mode.js') }}"></script>
</body>

</html>
