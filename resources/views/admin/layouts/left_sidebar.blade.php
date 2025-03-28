<nav class="vertical_nav">
    <div class="left_section menu_left" id="js-menu">
        <div class="left_section">
            <ul>
                <li class="menu--item">
                    <a href="{{ route('dashboard.index') }}" class="menu--link" title="Dashboard">
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
                    <a href="{{ route('category.index')}}" class="menu--link" title="Create Category">
                        <i class="uil uil-folder-plus menu--icon"></i>
                        <span class="menu--label">Category</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('subcategory.index')}}" class="menu--link" title="Create Sub-Category">
                        <i class="uil uil-folder-open menu--icon"></i>
                        <span class="menu--label">SubCategory</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('course.index') }}" class="menu--link" title="Course">
                        <i class="uil uil-graduation-cap menu--icon"></i>
                        <span class="menu--label">Course</span>
                    </a>
                </li>
                {{-- <li class="menu--item">
                    <a href="{{route('learner.list')}}" class="menu--link" title="My Certificates">
                        <i class='uil uil-award menu--icon'></i>
                        <span class="menu--label">My Certificates</span>
                    </a>
                </li> --}}
                {{--

                <li class="menu--item">
                    <a href="{{route('admin.review')}}" class="menu--link" title="Reviews">
                        <i class='uil uil-star menu--icon'></i>
                        <span class="menu--label">Reviews</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{route('admin.earning')}}" class="menu--link" title="Earning">
                        <i class='uil uil-dollar-sign menu--icon'></i>
                        <span class="menu--label">Earning</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{route('admin.payout')}}" class="menu--link" title="Payout">
                        <i class='uil uil-wallet menu--icon'></i>
                        <span class="menu--label">Payout</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{route('admin.statement')}}" class="menu--link" title="Statements">
                        <i class='uil uil-file-alt menu--icon'></i>
                        <span class="menu--label">Statements</span>
                    </a>
                </li> --}}
                <li class="menu--item">
                    <a href="{{ route('user.index') }}" class="menu--link" title="Learners">
                        <i class='uil uil-check-circle menu--icon'></i>
                        <span class="menu--label">Learners</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('instructorList') }}" class="menu--link" title="Instructors">
                        <i class='uil uil-plus-circle menu--icon'></i>
                        <span class="menu--label">Instructors</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('transactions.index') }}" class="menu--link" title="Transactions History">
                        <i class='uil uil-transaction menu--icon'></i>
                        <span class="menu--label">Transactions History</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="left_section pt-2">
            <ul>
                <li class="menu--item">
                    <a href="{{ route('setting') }}" class="menu--link" title="Setting">
                        <i class='uil uil-cog menu--icon'></i>
                        <span class="menu--label">Setting</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{route('faq.index')}}" class="menu--link" title="FAQ">
                        <i class='uil uil-file menu--icon'></i>
                        <span class="menu--label">FAQ's</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{route('learningpath.index')}}" class="menu--link" title="Learning Path">
                        <i class='uil uil-bullseye menu--icon'></i>
                        <span class="menu--label">Learning Path</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('contactus.index')}}" class="menu--link" title="content us">
                        <i class='uil uil-file menu--icon'></i>
                        <span class="menu--label">Contact us</span>
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