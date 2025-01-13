<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">
		<title>Cursus - Sign Up Next Step</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="images/fav.png">
		
		<!-- Stylesheets -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
		<link href='vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
		<link href="css/vertical-responsive-menu.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/responsive.css" rel="stylesheet">
		<link href="css/night-mode.css" rel="stylesheet">
		
		<!-- Vendor Stylesheets -->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
		<link href="vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="vendor/bootstrap-select/docs/docs/dist/css/bootstrap-select.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="vendor/semantic/semantic.min.css">	
		
	</head> 

<body>
	<!-- Signup Start -->
	<div class="sign_in_up_bg">
		<div class="container">
			<div class="row justify-content-lg-center justify-content-md-center">
				<div class="col-lg-12">
					<div class="main_logo25" id="logo">
						<a href="index.html"><img src="images/logo.svg" alt=""></a>
						<a href="index.html"><img class="logo-inverse" src="images/ct_logo.svg" alt=""></a>
					</div>
				</div>
			
				<div class="col-lg-6 col-md-8">
					<div class="sign_form basic_form">
						<div class="main-tabs">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a href="#instructor-signup-tab" id="instructor-tab" class="nav-link active" data-bs-toggle="tab">Instructor Sign Up</a>
								</li>
								<li class="nav-item">
									<a href="#student-signup-tab" id="student-tab" class="nav-link" data-bs-toggle="tab">Student Sign Up</a>
								</li>																				
							</ul>									
						</div>

						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="instructor-signup-tab" role="tabpanel" aria-labelledby="instructor-tab">
								<h2>Welcome to Cursus</h2>
						        <p>Sign Up and Create Course!</p>
								<form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="ui search focus">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="username" value="{{ old('username') }}" id="id_firstname" maxlength="64" placeholder="UserName">
                                        </div>
                                        @error('username')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="firstname" value="{{ old('firstname') }}" id="id_firstname" maxlength="64" placeholder="First Name">
                                        </div>
                                        @error('firstname')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="middlename" value="{{ old('middlename') }}" id="id_fullname" maxlength="64" placeholder="Middle Name">
                                        </div>
                                        @error('middlename')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="lastname" value="{{ old('lastname') }}" id="id_fullname" maxlength="64" placeholder="Last Name">
                                        </div>
                                        @error('lastname')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="email" name="emailaddress" value="{{ old('emailaddress') }}" id="id_email" maxlength="64" placeholder="Email Address">
                                        </div>
                                        @error('emailaddress')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="password" name="password" value="{{ old('password') }}" id="id_password" maxlength="64" placeholder="Password">
                                        </div>
                                        @error('password')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" id="id_password" maxlength="64" placeholder="Confirm Password">
                                        </div>
                                        @error('password_confirmation')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="number" name="phone_no" value="{{ old('phone_no') }}" id="id_phone_no" maxlength="64" placeholder="Phone Number">
                                        </div>
                                        @error('phone_no')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="file" name="profile_picture_url" id="id_profile_picture_url">
                                        </div>
                                        @error('profile_picture_url')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" id="id_date_of_birth" placeholder="Date of Birth">
                                        </div>
                                        @error('date_of_birth')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <textarea class="prompt srch_explore" name="bio" id="id_bio" placeholder="Professional Background" rows="4" cols="70">{{ old('bio') }}</textarea>
                                        </div>
                                        @error('bio')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="skill" value="{{ old('skill') }}" id="id_skill" placeholder="Skills (List of Expertise)">
                                        </div>
                                        @error('skill')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui form mt-30 checkbox_sign">
                                        <div class="inline field">
                                            <div class="ui checkbox mncheck">
                                                <input type="checkbox" tabindex="0" class="hidden">
                                                <label>I’m in for emails with exciting discounts and personalized recommendations</label>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <button class="login-btn" type="submit">Instructor Sign Up Now</button>
                                </form>
                                
                                
							</div>
							<div class="tab-pane fade" id="student-signup-tab" role="tabpanel" aria-labelledby="student-tab">
								<h2>Welcome to Cursus</h2>
						        <p>Sign Up and Start Learning!</p>
								<form action="{{ route('user.store_learner')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="ui search focus">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="username" value="{{ old('username') }}" id="id_firstname"  maxlength="64" placeholder="UserName">
                                        </div>
                                        @error('username')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="firstname" value="{{ old('firstname') }}" id="id_firstname"  maxlength="64" placeholder="First Name">
                                        </div>
                                        @error('firstname')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="middlename" value="{{ old('middlename') }}" id="id_fullname" maxlength="64" placeholder="Middle Name">
                                        </div>
                                        @error('middlename')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="lastname" value="{{ old('lastname') }}" id="id_fullname"  maxlength="64" placeholder="Last Name">
                                        </div>
                                        @error('lastname')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="email" name="emailaddress" value="{{ old('emailaddress') }}" id="id_email"  maxlength="64" placeholder="Email Address">
                                        </div>
                                        @error('emailaddress')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="password" name="password" value="{{ old('password') }}" id="id_password"  maxlength="64" placeholder="Password">
                                        </div>
                                        @error('password')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" id="id_password"  maxlength="64" placeholder="Confirm Password">
                                        </div>
                                        @error('password_confirmation')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="number" name="phone_no" value="{{ old('phone_no') }}" id="id_fullname"  maxlength="64" placeholder="Phone Number">
                                        </div>
                                        @error('phone_no')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="file" name="profile_picture_url" id="id_fullname" >
                                        </div>
                                        @error('profile_picture_url')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" id="id_fullname" >
                                        </div>
                                        @error('date_of_birth')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                
                                    <div class="ui form mt-30 checkbox_sign">
                                        <div class="inline field">
                                            <div class="ui checkbox mncheck">
                                                <input type="checkbox" tabindex="0" class="hidden">
                                                <label>I’m in for emails with exciting discounts and personalized recommendations</label>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <button class="login-btn" type="submit">Student Sign Up Now</button>
                                </form>
                                
							</div>
						</div>
						<p class="mb-0 mt-30">Already have an account? <a href="{{ route('login')}}">Log In</a></p>
					</div>
					<div class="sign_footer"><img src="images/sign_logo.png" alt="">© 2024 <strong>Cursus</strong>. All Rights Reserved.</div>
				</div>				
			</div>				
		</div>				
	</div>
	<!-- Signup End -->	

	<script src="js/jquery-3.7.1.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js"></script>
	<script src="vendor/semantic/semantic.min.js"></script>
	<script src="js/custom.js"></script>	
	<script src="js/night-mode.js"></script>	
</body>
</html>