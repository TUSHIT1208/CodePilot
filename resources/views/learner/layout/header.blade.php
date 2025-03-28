<!-- Header Start -->
<header class="header clearfix">
    <button type="button" id="toggleMenu" class="toggle_menu">
        <i class='uil uil-bars'></i>
    </button>
    <button id="collapse_menu" class="collapse_menu">
        <i class="uil uil-bars collapse_menu--icon "></i>
        <span class="collapse_menu--label"></span>
    </button>
    <div class="main_logo" id="logo">
        <h1>CodePilot</h1>
        {{-- <a href="index.html"><img class="logo-inverse" src="{{ asset('images/ct_logo.svg') }}" alt=""></a> --}}
    </div>

    <div class="header_right">
        <ul>
            <li></li>
            <li>
                <a href="{{ route('cart.index') }}" class="option_links" title="cart"><i
                        class='uil uil-shopping-cart-alt'></i> <span class="noti_count" id="cart_count">0</span></a>
            </li>

            <li class="profile-dropdown">
                <a href="#" class="opts_account" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                    aria-expanded="false">
                    @if (!empty(auth()->user()->profile_picture_url))
                        <img id="profile_picture" src="{{ asset(Auth::user()->profile_picture_url) }}">
                    @else
                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px; font-size: 18px;">
                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
                        </div>
                    @endif
                </a>
                <div class="dropdown-menu dropdown_account drop-down dropdown-menu-end">
                    <div class="channel_my">
                        <div class="profile_link">
                            @if (!empty(auth()->user()->profile_picture_url))
                                <img id="profile_picture" src="{{ asset(Auth::user()->profile_picture_url) }}">
                            @else
                                <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px; font-size: 18px;">
                                    {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="pd_content">
                                <div class="rhte85">
                                    <h6>{{ Auth::user()->username }}</h6>
                                    <div class="mef78" title="Verify">
                                        <i class='uil uil-check-circle'></i>
                                    </div>
                                </div>
                                <span>{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                        <a href="{{ route('user.learner_show', Auth::user()->id) }}" class="dp_link_12">View Student
                            Profile</a>
                    </div>
                    <div class="night_mode_switch__btn">
                        <a href="#" id="night-mode" class="btn-night-mode">
                            <i class="uil uil-moon mode-icon"></i>
                            <span style="position: relative; left: 16%;">Night Mode</span>
                            <span class="btn-night-mode-switch">
                                <span class="uk-switch-button"></span>
                            </span>
                        </a>
                    </div>                    
                    <a href="{{ route('learner.dashboard') }}" class="item channel_item">Dashboard</a>
                    <a href="{{ route('learner.setting') }}" class="item channel_item">Setting</a>
                    <a href="{{ route('changepassword.create') }}" class="item channel_item">Change Password</a>
                    <a href="{{ route('logout') }}" class="item channel_item">Sign Out</a>
                </div>
            </li>
        </ul>
    </div>
</header>
<script>
    function updateCartWishlistCount() {
        $.ajax({
            url: "{{ route('cart.counts') }}",
            method: "GET",
            success: function(response) {
                $('#cart_count').text(response.cartCount);
                $('#wishlist_count').text(response.wishlistCount);
            }
        });
    }

    // Call function when the page loads
    $(document).ready(function() {
        updateCartWishlistCount();
    });
</script>
<!-- Header End -->
