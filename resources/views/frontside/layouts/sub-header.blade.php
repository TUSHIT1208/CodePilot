<div class="_215cd2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="course_tabs">
                    <nav>
                        <div class="nav nav-tabs tab_crse  justify-content-center">
                            <a class="nav-item nav-link" href="{{ route('about') }}">About</a>
                            <a class="nav-item nav-link" href="{{ route('blog') }}">Blog</a>
                            <a class="nav-item nav-link" href="{{ route('company') }}">Company</a>
                            <a class="nav-item nav-link" href="{{ route('carrer') }}">Careers</a>
                            <a class="nav-item nav-link" href="{{ route('press') }}">Press</a>
                        </div>
                    </nav>
                </div>
                <div class="title129 mt-35 mb-35">
                    <h2>Insights, ideas, and stories</h2>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll(".nav-item");

            tabs.forEach(tab => {
                tab.addEventListener("click", function() {
                    tabs.forEach(t => t.classList.remove("active")); // Remove active from all
                    this.classList.add("active"); // Add active to clicked tab
                });
            });
        });
    </script>
</div>
