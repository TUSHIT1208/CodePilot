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
        <img src="{{ asset('images/logo_12.png')}}" alt="" style="height: 51px;position: absolute;top: 7%;" class="logo-inverse">
        <h1 class="ml-3" style="position: relative; left: 50px; bottom: 11px; text-transform: uppercase; font-family: monospace; letter-spacing: 2px;">CodePilot</h1>
    </div>
    {{-- <div class="search120">
		<div class="ui search">
			<div class="ui left icon input swdh10">
				<input class="prompt srch10" type="text" placeholder="Search for Tuts Videos, Tutors, Tests and more..">
				<i class='uil uil-search-alt icon icon1'></i>
			</div>
		</div>
	</div> --}}
    <div class="header_right">
        <ul>
            <li>
                <a href="{{ route('course.create') }}" class="upload_btn" title="Create New Course">Create New
                    Course</a>
            </li>

            <li class="profile-dropdown">
                <a href="#" class="opts_account" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                    aria-expanded="false">
                    @if (!empty(auth()->user()->profile_picture_url))
                        <img id="profile_picture" src="{{ asset(Auth::user()->profile_picture_url) }}">
                    @else
                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px; font-size: 18px;">
                            {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
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
                                    {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
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
                        <a href="{{ route('user.show', Auth::user()->id) }}" class="dp_link_12">View Admin
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
                    <a href="{{ route('dashboard.index') }}" class="item channel_item">CodePilot dashboard</a>
                    <a href="{{ route('setting') }}" class="item channel_item">Setting</a>
                    <a href="{{ route('changepassword.create') }}" class="item channel_item">Change Password</a>
                    <a href="{{ route('logout') }}" class="item channel_item">Sign Out</a>
                </div>
            </li>
        </ul>
    </div>
    <script>
        $(document).ready(function () {
            function updateLogo() {
                if ($("html").hasClass("night-mode")) {
                    $("#logo").attr("src", "{{ asset('images/logo4.png') }}"); // Dark mode logo
                } else {
                    $("#logo").attr("src", "{{ asset('images/logo5.png') }}"); // Light mode logo
                }
            }
    
            // Run on page load
            updateLogo();
    
            // Detect class change on <html> dynamically
            const observer = new MutationObserver(function () {
                updateLogo();
            });
    
            observer.observe(document.documentElement, { attributes: true, attributeFilter: ["class"] });
        });
    </script>
</header>
