<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">        
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <title>Cursus - Sign In</title>
    
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{ asset('images/fav.png') }}">
    
    <!-- Stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,500" rel="stylesheet">
    <link href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" rel="stylesheet">
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
    {{-- <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

.toast{
    position: absolute;
    top: 25px;
    right: 30px;
    border-radius: 12px;
    background: #fff;
    padding: 20px 35px 20px 25px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    border-left: 6px solid #4070f4;
    overflow: hidden;
    transform: translateX(calc(100% + 30px));
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
    z-index: 1;
}

.toast.active{
    transform: translateX(0%);
}

.toast .toast-content{
    display: flex;
    align-items: center;
}

.toast-content .check{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 35px;
    width: 35px;
    background-color: #4070f4;
    color: #fff;
    font-size: 20px;
    border-radius: 50%;
}

.toast-content .message{
    display: flex;
    flex-direction: column;
    margin: 0 20px;
}

.message .text{
    font-size: 20px;
    font-weight: 400;;
    color: #666666;
}

.message .text.text-1{
    font-weight: 600;
    color: #333;
}

.toast .close{
    position: absolute;
    top: 10px;
    right: 15px;
    padding: 5px;
    cursor: pointer;
    opacity: 0.7;
}

.toast .close:hover{
    opacity: 1;
}

.toast .progress{
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 100%;
    background: #ddd;
}

.toast .progress:before{
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    height: 100%;
    width: 100%;
    background-color: #4070f4;
}

.progress.active:before{
    animation: progress 5s linear forwards;
}

@keyframes progress {
    100%{
        right: 100%;
    }
}


.toast.active ~ button{
    pointer-events: none;
}

    </style> --}}
</head> 

<body>
    <!-- Signup Start -->
    <div class="sign_in_up_bg">
        <div class="container">
            <div class="row justify-content-lg-center justify-content-md-center">
                <div class="col-lg-12">
                    <div class="main_logo25" id="logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('images/logo.svg') }}" alt=""></a>
                        <a href="{{ url('/') }}"><img class="logo-inverse" src="{{ asset('images/ct_logo.svg') }}" alt=""></a>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-8">
                    <div class="sign_form">
                        <h2>Welcome Back</h2>
                        <p>Log In to Your Cursus Account!</p>
                        <button class="social_lnk_btn color_btn_fb"><i class="uil uil-facebook-f"></i>Continue with Facebook</button>
                        <button class="social_lnk_btn mt-15 color_btn_tw"><i class="uil uil-twitter"></i>Continue with Twitter</button>
                        <button class="social_lnk_btn mt-15 color_btn_go"><i class="uil uil-google"></i>Continue with Google</button>
                                                
                        @if (session('success'))
                            <div class="toast">
                                <div class="toast-content">
                                    <i class="fas fa-solid fa-check check"></i>
                                    <div class="message">
                                        <span class="text text-1">Success</span>
                                        <span class="text text-2">{{ session('success') }}</span>
                                    </div>
                                </div>
                                <i class="fa-solid fa-xmark close"></i>
                                <div class="progress"></div>
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form action="{{ route('login_check') }}" method="POST">
                            @csrf
                            <div class="ui search focus mt-15">
                                <div class="ui left icon input swdh95">
                                    <input class="prompt srch_explore" 
                                           type="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           id="id_email" 
                                           maxlength="64" 
                                           placeholder="Email Address">                                                         
                                    <i class="uil uil-envelope icon icon2"></i>
                                </div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="ui search focus mt-15">
                                <div class="ui left icon input swdh95">
                                    <input class="prompt srch_explore" 
                                           type="password" 
                                           name="password" 
                                           id="id_password"                                 
                                           maxlength="64" 
                                           placeholder="Password">
                                    <i class="uil uil-key-skeleton-alt icon icon2"></i>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="ui form mt-30 checkbox_sign">
                                <div class="inline field">
                                    <div class="ui checkbox mncheck">
                                        <input type="checkbox" name="remember" tabindex="0" class="hidden">
                                        <label>Remember Me</label>
                                    </div>
                                </div>
                            </div>
                            <button class="login-btn" type="submit">Sign In</button>
                        </form>
                        <p class="sgntrm145">Or <a href="{{ route('forgot_password') }}">Forgot Password</a>.</p>
                        <p class="mb-0 mt-30 hvsng145">Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>

                    </div>
                    <div class="sign_footer"><img src="{{ asset('images/sign_logo.png') }}" alt="">© 2024 <strong>Cursus</strong>. All Rights Reserved.</div>
                </div>                
            </div>                
        </div>                
    </div>
    <!-- Signup End -->    

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/OwlCarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('vendor/semantic/semantic.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>    
    <script src="{{ asset('js/night-mode.js') }}"></script>    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
    const toast = document.querySelector(".toast");
    const closeIcon = document.querySelector(".close");
    const progress = document.querySelector(".progress");

    if (toast) {
        toast.classList.add("active"); // Activates the toast
        progress.classList.add("active");

        setTimeout(() => {
            toast.classList.remove("active");
        }, 5000);

        setTimeout(() => {
            progress.classList.remove("active");
        }, 5300);
    }

    if (closeIcon) {
        closeIcon.addEventListener("click", () => {
            toast.classList.remove("active");
            setTimeout(() => {
                progress.classList.remove("active");
            }, 300);
        });
    }
});

    </script>
    
</body>
</html>
