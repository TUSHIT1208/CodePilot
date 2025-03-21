<!-- Left Sidebar Start -->
<nav class="vertical_nav">
	<div class="left_section menu_left" id="js-menu">
		<div class="left_section">
			<ul>
				<li class="menu--item">
					<a href="{{ route('learner.dashboard') }}" class="menu--link" title="Dashboard">
						<i class="uil uil-apps menu--icon"></i>
						<span class="menu--label">Dashboard</span>
					</a>
				</li>

				<li class="menu--item menu--item__has_sub_menu">
					<label class="menu--link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
						aria-expanded="false" aria-controls="sidebarApps">
						<i class='uil uil-layers menu--icon'></i><span>Course</span>
					</label>
					<div class="collapse menu-dropdown" id="sidebarApps">
						<ul class="nav nav-sm flex-column sub_menu">
							@foreach($categories as $category)
								<li class="nav-item">
									<a href="#category-{{ $category->id }}" class="sub_menu--link nav-item"
										data-bs-toggle="collapse" role="button" aria-expanded="false"
										aria-controls="category-{{ $category->id }}">
										{{ $category->name }}
									</a>
									<div class="collapse menu-dropdown ms-5 mb-2" id="category-{{ $category->id }}">
										<ul class="nav nav-sm flex-column">
											@foreach($category->sub_categories as $subCategory)
												<li class="menu--item">
													<a href="{{ route('course.purches', $subCategory->id)}}"
														class="sub_sub_menu--link"
														style="background-color: transparent;">{{ $subCategory->name }}</a>
													{{-- <a href="{{ route('course.purches',$subCategory->id)}}"
														class="sub_sub_menu--link" data-bs-toggle="collapse">
														{{ $subCategory->name }}
													</a> --}}
												</li>
											@endforeach
										</ul>
									</div>
								</li>
							@endforeach
						</ul>

					</div>
				</li>
				<li class="menu--item">
					<a href="{{ route('learning.path') }}" class="menu--link" title="Saved Courses">
						<i class="uil uil-bullseye menu--icon"></i>
					  <span class="menu--label">Learnign Path</span>
					</a>
				</li>
				<li class="menu--item">
					<a href="{{ route('wishlist.index') }}" class="menu--link" title="Saved Courses">
						<i class="uil uil-heart-alt menu--icon"></i>
						<span class="menu--label">Saved Courses</span>
					</a>
				</li>
				<li class="menu--item">
					<a href="student_my_certificates.html" class="menu--link" title="My Certificates">
						<i class='uil uil-award menu--icon'></i>
						<span class="menu--label">My Certificates</span>
					</a>
				</li>
			</ul>
		</div>
		<div class="left_section pt-2">
			<ul>
				<li class="menu--item">
					<a href="{{ route('learner.setting') }}" class="menu--link" title="Setting">
						<i class='uil uil-cog menu--icon'></i>
						<span class="menu--label">Setting</span>
					</a>
				</li>
				<li class="menu--item">
					<a href="feedback.html" class="menu--link" title="Send Feedback">
						<i class='uil uil-comment-alt-exclamation menu--icon'></i>
						<span class="menu--label">Send Feedback</span>
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
