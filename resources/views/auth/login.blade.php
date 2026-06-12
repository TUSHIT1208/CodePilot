<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <title> Sign In | CodePilot</title>

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
    {{-- <link href="{{ asset('css/night-mode.css') }}" rel="stylesheet"> --}}

    <!-- Vendor Stylesheets -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/OwlCarousel/assets/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/OwlCarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-select/docs/docs/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/semantic/semantic.min.css') }}" rel="stylesheet">

</head>

<body>
    <div class="text-end mt-3 fs-4 gray-s">
        <a href="{{ route('index') }}" class="text-dark"><i class="uil uil-times container"></i>
        
        </a>
    </div>
    <!-- Signup Start -->
    <div class="sign_in_up_bg mb-5">
        <div class="container">
            <div class="row justify-content-lg-center justify-content-md-center">
                <div class="col-lg-12">
                    <div class="main_logo" id="logo">
                        <img src="{{ asset('images/logo_12.png')}}" alt="" class="logo-inverse" style="width: 32%; position: relative; left: 327%; top: 11px;">
                        <h1 class="ml-3" style="position: relative; left: 372%; bottom: 56px; text-transform: uppercase; font-family: 'Open Sans'; letter-spacing: 3px;">CodePilot</h1>
                    </div>
                </div>

                <div class="col-lg-6 col-md-8">
                    <div class="sign_form">
                        <h2>Welcome Back</h2>
                        <p>Log In to Your CodePilot Account!</p>

                        <!-- Login Form -->
                        <form action="{{ route('login_check') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <!-- Email Input -->
                            <div class="ui search focus mt-15">
                                <div class="ui left icon input swdh95">
                                    <input class="prompt srch_explore form-control" type="email" name="email"
                                        value="{{ old('email') }}" id="id_email" maxlength="64"
                                        placeholder="Email Address">

                                    <i class="uil uil-envelope icon icon2"></i>
                                </div>

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="ui search focus mt-15">
                                <div class="ui left icon input swdh95">
                                    <input class="form-control prompt srch_explore" type="password" name="password"
                                        id="id_password" maxlength="64" placeholder="Password">
                                    <i class="uil uil-key-skeleton-alt icon icon2"></i>


                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button class="login-btn" type="submit">Sign In</button>
                        </form>

                        <p class="sgntrm145">Or <a href="{{ route('forgot_password') }}">Forgot Password</a>.</p>
                        <p class="mb-0 mt-30 hvsng145">Don't have an account? <a href="{{ route('register') }}">Sign
                                Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Signup End -->
    <script>
        (function () {
            'use strict';

            document.addEventListener('DOMContentLoaded', function () {
                const form = document.querySelector('.needs-validation');

                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }, false);
        })();
    </script>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/OwlCarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('vendor/semantic/semantic.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/night-mode.js') }}"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    


    <script>
        $(document).ready(function () {
            if (localStorage.getItem('success')) {
                toastr.options = {
                    closeButton: true,
                    debug: false,
                    newestOnTop: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    preventDuplicates: true,
                    timeOut: 2000,
                    extendedTimeOut: 1000,
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    onShown: function () {
                        $(".toast-success").css({
                            'background-color': '#28a745', // Green for success
                            'opacity': '1'  // Adjust opacity
                        });;
                    }
                };
                toastr.success(localStorage.getItem('success')); // Show toaster notification
                localStorage.removeItem('success'); // Clear the message after showing
            }
        });
        @if(session('success'))
            toastr.options = {
                closeButton: true,
                debug: false,
                newestOnTop: true,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: true,
                timeOut: 2000,
                extendedTimeOut: 1000,
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                onShown: function () {
                    $(".toast-success").css({
                        'background-color': '#28a745', // Green for success
                        'opacity': '1'  // Adjust opacity
                    });;
                }
            };

            toastr.success("{{ session('success') }}", "Success");
        @endif

        @if(session('error'))
            toastr.options = {
                closeButton: true,
                newestOnTop: true,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: true,
                timeOut: 5000,
                extendedTimeOut: 1000,
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                onShown: function () {
                    $(".toast-error").css({
                        'background-color': '#dc3545', // red for info
                        'opacity': '1'
                    });;
                }
            };

            toastr.error("{{ session('error') }}", "Error");
        @endif

        @if(session('warning'))
            toastr.options = {
                closeButton: true,
                debug: false,
                newestOnTop: true,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: true,
                timeOut: 2000,
                extendedTimeOut: 1000,
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                onShown: function () {
                    $(".toast-warning").css({
                        'background-color': '#ffc107', // Green for success
                        'opacity': '1'  // Adjust opacity
                    });;
                }
            };

            toastr.warning("{{ session('warning') }}", "Warning");
        @endif

    </script>



</body>

</html>