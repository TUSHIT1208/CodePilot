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
    <link rel="icon" type="image/png" href="{{ asset('images/fav.png') }}">

    <!-- Stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,500" rel="stylesheet">
    <link href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">  
    <link href="{{ asset('vendor/unicons-2.0.1/css/unicons.css') }}" rel="stylesheet">
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
    <link href="{{ asset('vendor/semantic/semantic.min.css') }}" rel="stylesheet">


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
                                    <a href="#instructor-signup-tab" id="instructor-tab" class="nav-link active"
                                        data-bs-toggle="tab">Instructor Sign Up</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#student-signup-tab" id="student-tab" class="nav-link"
                                        data-bs-toggle="tab">Student Sign Up</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="instructor-signup-tab" role="tabpanel"
                                aria-labelledby="instructor-tab">
                                <h2>Welcome to Cursus</h2>
                                <p>Sign Up and Create Course!</p>
                                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="ui search focus">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="username"
                                                value="{{ old('username') }}" id="id_username" maxlength="64"
                                                placeholder="UserName">
                                        </div>
                                        @error('username')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="firstname"
                                                value="{{ old('firstname') }}" id="id_firstname" maxlength="64"
                                                placeholder="First Name">
                                        </div>
                                        @error('firstname')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="middlename"
                                                value="{{ old('middlename') }}" id="id_middlename" maxlength="64"
                                                placeholder="Middle Name">
                                        </div>
                                        @error('middlename')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="lastname"
                                                value="{{ old('lastname') }}" id="id_lastname" maxlength="64"
                                                placeholder="Last Name">
                                        </div>
                                        @error('lastname')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="email" name="emailaddress"
                                                value="{{ old('emailaddress') }}" id="id_email" maxlength="64"
                                                placeholder="Email Address">
                                        </div>
                                        @error('emailaddress')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="password" name="password"
                                                value="{{ old('password') }}" id="id_password" maxlength="64"
                                                placeholder="Password">
                                        </div>
                                        @error('password')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="password"
                                                name="password_confirmation" value="{{ old('password_confirmation') }}"
                                                id="id_confirmationpassword" maxlength="64" placeholder="Confirm Password">
                                        </div>
                                        @error('password_confirmation')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="number" name="phone_no"
                                                value="{{ old('phone_no') }}" id="id_phone_no" maxlength="64"
                                                placeholder="Phone Number">
                                        </div>
                                        @error('phone_no')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="file" name="profile_picture_url"
                                                id="id_profile_picture_url">
                                        </div>
                                        @error('profile_picture_url')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="date" name="date_of_birth"
                                                value="{{ old('date_of_birth') }}" id="id_date_of_birth"
                                                placeholder="Date of Birth">
                                        </div>
                                        @error('date_of_birth')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <textarea class="prompt srch_explore" name="bio" id="id_bio"
                                                placeholder="Professional Background" rows="4"
                                                cols="70">{{ old('bio') }}</textarea>
                                        </div>
                                        @error('bio')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="skill"
                                                value="{{ old('skill') }}" id="id_skill"
                                                placeholder="Skills (List of Expertise)">
                                        </div>
                                        @error('skill')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui form mt-30 checkbox_sign">
                                        <div class="inline field">
                                            <div class="ui checkbox mncheck">
                                                <input type="checkbox" tabindex="0" class="hidden">
                                                <label>I’m in for emails with exciting discounts and personalized
                                                    recommendations</label>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="login-btn" type="submit">Instructor Sign Up Now</button>
                                </form>


                            </div>
                            <div class="tab-pane fade" id="student-signup-tab" role="tabpanel"
                                aria-labelledby="student-tab">
                                <h2>Welcome to Cursus</h2>
                                <p>Sign Up and Start Learning!</p>
                                <form action="{{ route('user.store_learner')}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="ui search focus">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="username"
                                                value="{{ old('username') }}" id="id_username" maxlength="64"
                                                placeholder="UserName">
                                        </div>
                                        @error('username')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="firstname"
                                                value="{{ old('firstname') }}" id="id_firstname" maxlength="64"
                                                placeholder="First Name">
                                        </div>
                                        @error('firstname')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="middlename"
                                                value="{{ old('middlename') }}" id="id_middlename" maxlength="64"
                                                placeholder="Middle Name">
                                        </div>
                                        @error('middlename')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="text" name="lastname"
                                                value="{{ old('lastname') }}" id="id_lastname" maxlength="64"
                                                placeholder="Last Name">
                                        </div>
                                        @error('lastname')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="email" name="emailaddress"
                                                value="{{ old('emailaddress') }}" id="id_email" maxlength="64"
                                                placeholder="Email Address">
                                        </div>
                                        @error('emailaddress')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="password" name="password"
                                                value="{{ old('password') }}" id="id_password" maxlength="64"
                                                placeholder="Password">
                                        </div>
                                        @error('password')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="password"
                                                name="password_confirmation" value="{{ old('password_confirmation') }}"
                                                id="id_confrimpassword" maxlength="64" placeholder="Confirm Password">
                                        </div>
                                        @error('password_confirmation')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="number" name="phone_no"
                                                value="{{ old('phone_no') }}" id="id_phoneno" maxlength="64"
                                                placeholder="Phone Number">
                                        </div>
                                        @error('phone_no')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="file" name="profile_picture_url"
                                                id="id_profile_picture_url">
                                        </div>
                                        @error('profile_picture_url')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh11 swdh19">
                                            <input class="prompt srch_explore" type="date" name="date_of_birth"
                                                value="{{ old('date_of_birth') }}" id="id_date_of_birth">
                                        </div>
                                        @error('date_of_birth')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="ui form mt-30 checkbox_sign">
                                        <div class="inline field">
                                            <div class="ui checkbox mncheck">
                                                <input type="checkbox" tabindex="0" class="hidden">
                                                <label>I’m in for emails with exciting discounts and personalized
                                                    recommendations</label>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="login-btn" type="submit">Student Sign Up Now</button>
                                </form>

                            </div>
                        </div>
                        <p class="mb-0 mt-30">Already have an account? <a href="{{ route('login')}}">Log In</a></p>
                    </div>
                    <div class="sign_footer"><img src="images/sign_logo.png" alt="">© 2024 <strong>Cursus</strong>. All
                        Rights Reserved.</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Signup End -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="js/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $('form[action="{{ route('user.store_learner') }}"]').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                let form = $(this);
                let formData = new FormData(this);

                // Clear previous error messages
                form.find('.text-danger').remove();

                $.ajax({
                    url: form.attr('action'), // Form action URL
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // Redirect to the login page with a success message
                        window.location.href = "{{ route('login') }}?success=" + encodeURIComponent('Registration successful! Please log in.');
                    },
                    error: function (xhr) {
                        // Handle validation errors from the server
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            for (let key in errors) {
                                let input = form.find([name="${key}"]);
                                let errorMessage = <strong class="text-danger">${errors[key][0]}</strong>;
                                input.closest('.ui.search').append(errorMessage);
                            }
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });

    </script>

    <script src="js/jquery-3.7.1.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/OwlCarousel/owl.carousel.js"></script>
    <script src="vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js"></script>
    <script src="vendor/semantic/semantic.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/night-mode.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        // Check if there is a success message in the session
    @if(session('success'))
    toastr.options = {
                            "closeButton": true, // Remove close button
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": true, // Enable time bar
                            "positionClass": "toast-bottom-right",
                            "preventDuplicates": true,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000", // Duration before auto-hiding
                    "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
            
            // Show success toast notification with the session message
            toastr.success("{{ session('success') }}", "Success");
        @endif
    
        // You can also handle other session messages if needed
        @if(session('error'))
            toastr.options = {
                closeButton: true,
                debug: false,
                newestOnTop: true,
                progressBar: true,
                positionClass: "toast-top-right",  // Toast notification position
                preventDuplicates: true,
                timeOut: 3000,  // Display duration of the toast (3 seconds)
                extendedTimeOut: 1000,
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"
            };
            
            // Show error toast notification with the session message
            toastr.error("{{ session('error') }}", "Error");
        @endif
    </script>
</body>

</html>