<nav class="vertical_nav">
    <div class="left_section menu_left" id="js-menu">
        <div class="left_section">
            <ul>
                <li class="menu--item">
                    <a href="{{ route('instructor.dashboard') }}" class="menu--link" title="Dashboard">
                        <i class="uil uil-apps menu--icon"></i>
                        <span class="menu--label">Dashboard</span>
                    </a>
                </li>
                {{-- <li class="menu--item">
                    <a href="#" class="menu--link" title="Courses">
                        <i class='uil uil-book-alt menu--icon'></i>
                        <span class="menu--label">Courses</span>
                    </a>
                 </li> --}}
                {{--<li class="menu--item">
                    <a href="{{route('admin.analyics')}}" class="menu--link" title="Analyics">
                        <i class='uil uil-analysis menu--icon'></i>
                        <span class="menu--label">Analyics</span>
                    </a>
                </li> --}}
                
                <li class="menu--item">
                    <a href="{{ route('course.index') }}" class="menu--link" title="Course">
                        <i class='uil uil-search menu--icon'></i>
                        <span class="menu--label">Course</span>
                    </a>
                </li>
                {{-- <li class="menu--item">
                    <a href="{{ route('transactions.index') }}" class="menu--link" title="Transactions History">
                        <i class='uil uil-transaction menu--icon'></i>
                        <span class="menu--label">Transactions History</span>
                    </a>
                </li> --}}
        <div class="left_section pt-2">
            <ul>
                <li class="menu--item">
                    <a href="{{ route('instructor.setting') }}" class="menu--link" title="Setting">
                        <i class='uil uil-cog menu--icon'></i>
                        <span class="menu--label">Setting</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get all menu links
        let menuLinks = document.querySelectorAll(".menu--item .menu--link");

        // Function to remove active class from all links
        function removeActiveClass() {
            menuLinks.forEach(link => {
                link.classList.remove("active");
            });
        }

        // Add click event to each menu link
        menuLinks.forEach(link => {
            link.addEventListener("click", function () {
                removeActiveClass(); // Remove active class from all links
                this.classList.add("active"); // Add active class to clicked link

                // Store the active link in localStorage
                localStorage.setItem("activeMenu", this.getAttribute("href"));
            });
        });

        // Retain the active class on page reload
        let activeMenu = localStorage.getItem("activeMenu");
        if (activeMenu) {
            menuLinks.forEach(link => {
                if (link.getAttribute("href") === activeMenu) {
                    link.classList.add("active");
                }
            });
        }
    });
</script>