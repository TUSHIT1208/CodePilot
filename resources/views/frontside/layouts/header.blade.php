<!-- Header Start -->
<header class="header clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="ml_item">
                    <div class="main_logo main_logo15" id="logo">
                        <h1>CodePilot</h1>
                        {{-- <a href="index.html"><img src="images/logo.svg" alt=""></a>
                        <a href="index.html"><img class="logo-inverse" src="images/ct_logo.svg" alt=""></a> --}}
                    </div>				
                </div>				
                <div class="header_right pr-0">
                    <ul>				
                        <li class="profile-dropdown">
                            <a href="#" class="opts_account" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">
                            <img src="images/hd_dp.jpg" alt=""
                                style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            </a>
                            <div class="dropdown-menu dropdown_account drop-down dropdown-menu-end">
                                <div class="night_mode_switch__btn">
                                    <a href="#" id="night-mode" class="btn-night-mode">
                                        <i class="uil uil-moon"></i> Night mode
                                        <span class="btn-night-mode-switch">
                                            <span class="uk-switch-button"></span>
                                        </span>
                                    </a>
                                </div>
                                <a href="{{ route('login') }}" class="item channel_item">Sign In</a>						
                                <a href="{{ route('register') }}" class="item channel_item">Sign Up</a>
                            </div>
                        </li>
                    </ul>
                </div>		
            </div>		
        </div>
    </div>
</header>