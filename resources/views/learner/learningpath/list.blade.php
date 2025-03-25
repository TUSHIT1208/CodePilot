@extends('learner.layout.master')

@section('title')
    Learning path
@endsection
@section('content_learner')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-8">
                        <div class="section3125 mt-3">
                            <h1>Learning path</h1>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="_14d25">
                            <div class="row mt-5">
                                @if ($path_name->isEmpty())
                                    <!-- No Records Found -->
                                    <div class="no-categories-container text-center fade-in-animation footer">
                                        <i class="uil uil-folder-minus bounce-effect"
                                            style="font-size: 50px; color: #d1d1d1;"></i>
                                        <h3 class="mt-3 scale-in-text" style="color: #777;">No Learning path Found</h3>
                                        <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                                            learning path yet. Add one now to get started!</p>
                                    </div>
                                @else

                                    @foreach ($path_name as $path)
                                        <div class="col-md-4">
                                            <div class="card learning-card p-4 position-relative learning-path"
                                                data-name="{{ $path->name }}">
                                                <span class="icon-badge"><i class="uil uil-bullseye"></i></span>
                                                <h6 class="text-primary">PATH</h6>
                                                <h4 name="category_name">{{ $path->name}}</h4>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="row" id="course-list">

                                    <!-- Courses will be dynamically added here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('learner.layout.footer')
    </div>

    <script>
        $(document).ready(function () {
            $(".learning-path").click(function () {
                var pathName = $(this).data("name"); // Get the selected learning path name

                $.ajax({
                    url: "{{ route('course.byCategory') }}",
                    type: "GET",
                    data: { category_name: pathName },
                    beforeSend: function () {
                        $("#course-list").html("<p class='text-white'>Loading courses...</p>");
                    },
                    success: function (response) {
                        $("#course-list").html(response); // Inject the courses inside the same page
                    },
                    error: function () {
                        $("#course-list").html("<p class='text-danger'>Failed to load courses.</p>");
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Fetch CSRF Token from Meta Tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            // Handle Wishlist Button Click
            document.addEventListener("click", function (event) {
                if (event.target.closest(".wishlistButton")) {
                    let button = event.target.closest(".wishlistButton");
                    let form = button.closest(".wishlistForm");
                    let formData = new FormData(form);

                    fetch("{{ route('wishlist.store') }}", {
                        method: "POST",
                        body: formData,
                        headers: { "X-CSRF-TOKEN": csrfToken }
                    })
                        .then(response => response.json().then(data => ({ status: response.status, body: data })))
                        .then(({ status, body }) => {
                            showToastr(status, body.message);
                        })
                        .catch(() => toastr.error("Error adding to wishlist"));
                }
            });

            // Handle Cart Form Submission
            document.addEventListener("submit", function (event) {
                if (event.target.closest(".cartForm")) {
                    event.preventDefault();
                    let form = event.target;
                    let formData = new FormData(form);

                    fetch("{{ route('cart.store') }}", {
                        method: "POST",
                        body: formData,
                        headers: { "X-CSRF-TOKEN": csrfToken }
                    })
                        .then(response => response.json().then(data => ({ status: response.status, body: data })))
                        .then(({ status, body }) => {
                            showToastr(status, body.message);
                        })
                        .catch(() => toastr.error("Error adding to cart"));
                }
            });

            // ✅ Toastr Notification Helper
            function showToastr(status, message) {
                let bgColor = status === 201 ? "#28a745" : status === 409 ? "#ffc107" : "#dc3545";
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    preventDuplicates: true,
                    timeOut: 5000,
                    extendedTimeOut: 1000,
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    onShown: function () {
                        $(".toast-success").css({ "background-color": bgColor, "opacity": "1" });
                    }
                };
                status === 201 ? toastr.success(message) : status === 409 ? toastr.warning(message) : toastr.error("Something went wrong!");
            }
        });

    </script>
@endsection