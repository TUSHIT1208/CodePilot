<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('index') }}" class="logo d-flex align-items-center me-auto">
            <h1 class="sitename">CodePilot</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('index') }}" class="{{ request()->routeIs('index') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                </li>
                <li><a href="{{ route('course') }}"
                        class="{{ request()->routeIs('course') ? 'active' : '' }}">Courses</a></li>
                <li><a href="{{ route('contact') }}"
                        class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a href="javascript:;" class="user" data-bs-toggle="dropdown" data-bs-auto-close="outside"
            aria-expanded="false"><i class="uil uil-user-circle"></i></a>
        <div class="dropdown-menu dropdown_account drop-down mt-2">
            <a href="{{ route('login') }}" class="item channel_item front-register">Sign In</a><br>
            <a href="{{ route('register') }}" class="item channel_item front-register">Sign Up</a>
        </div>
    </div>
</header>
