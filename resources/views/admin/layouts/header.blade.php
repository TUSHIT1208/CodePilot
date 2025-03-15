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
		{{-- <a href="index.html"><img src="{{ asset('images/logo.png') }}" alt=""></a> --}}
		{{-- <a href="index.html"><img class="logo-inverse" src="{{ asset('images/logo.png') }}" alt=""></a> --}}
	</div>
	{{-- <div class="search120">
		<div class="ui search">
			<div class="ui left icon input swdh10">
				<input class="prompt srch10" type="text" placeholder="Search for Tuts Videos, Tutors, Tests and more..">
				<i class='uil uil-search-alt icon icon1'></i>
			</div>
		</div>
	</div>--}}
	<div class="header_right">
		<ul>
			<li>
				<a href="{{ route('course.create') }}" class="upload_btn" title="Create New Course">Create New
					Course</a>
			</li>

			<li class="profile-dropdown">
				<a href="#" class="opts_account" data-bs-toggle="dropdown" data-bs-auto-close="outside"
					aria-expanded="false">
					@if(!empty(auth()->user()->profile_picture_url))
						<img id="profile_picture" src="{{ asset(Auth::user()->profile_picture_url) }}">
					@else
						<h1 id="default_avtar">{{ substr(Auth::user()->first_name, 0, 1) }}</h1>
					@endif
				</a>
				<div class="dropdown-menu dropdown_account drop-down dropdown-menu-end">
					<div class="channel_my">
						<div class="profile_link">
							@if(!empty(auth()->user()->profile_picture_url))
								<img id="profile_picture" src="{{ asset(Auth::user()->profile_picture_url) }}">
							@else
								<h1 id="default_avtar">{{ substr(Auth::user()->first_name, 0, 1) }}</h1>
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
							<i class="uil uil-moon"></i> Night mode
							<span class="btn-night-mode-switch">
								<span class="uk-switch-button"></span>
							</span>
						</a>
					</div>
					<a href="{{ route('admin.dashboard') }}" class="item channel_item">CodePilot dashboard</a>
					<a href="{{ route('setting') }}" class="item channel_item">Setting</a>
					<a href="{{ route('admin.help') }}" class="item channel_item">Help</a>
					<a href="{{ route('changepassword.create') }}" class="item channel_item">Change Password</a>
					<a href="{{ route('logout') }}" class="item channel_item">Sign Out</a>
				</div>
			</li>
		</ul>
	</div>
</header>