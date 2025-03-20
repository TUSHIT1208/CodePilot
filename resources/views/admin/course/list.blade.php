@extends('admin.layouts.master')

@section('title')
    Explore Courses
@endsection

@section('content')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-8">
                        <div class="section3125 mt-3">
                            <div class="explore_search">
                            </div>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <a href="{{ route('course.create') }}" class="upload_btn" title="Create New Course">Create New
                            Course</a>
                    </div>
                    <div class="col-md-12">
                        <div class="_14d25">
                            <div class="row mt-5">
                                @if ($courses->isEmpty())
                                    <!-- No Records Found -->
                                    <div class="no-categories-container text-center fade-in-animation footer">
                                        <i class="uil uil-folder-minus bounce-effect"
                                            style="font-size: 50px; color: #d1d1d1;"></i>
                                        <h3 class="mt-3 scale-in-text" style="color: #777;">No Course Found</h3>
                                        <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                                            Course yet. Add one now to get started!</p>
                                    </div>
                                @else
                                    @foreach ($courses as $course)
                                        <div class="col-lg-3 col-md-4">
                                            <div class="fcrse_1 mt-30">
                                                <a href="{{ route('course.show', $course->id) }}" class="fcrse_img">
                                                    <img src="{{ isset($course->thumbnail_url) && $course->thumbnail_url != null ? asset('courseThumbnail/' . $course->thumbnail_url) : asset('images/courses/img-2.jpg') }}"
                                                        alt="Course Thumbnail">

                                                    <div class="course-overlay list_overlay">
                                                        @if ($course->is_active)
                                                            <div class="badge_seller">Active</div>
                                                        @else
                                                            <div class="badge_seller">InActive</div>
                                                        @endif
                                                        <div class="crse_reviews">
                                                            <i class="uil uil-star"></i> 5
                                                        </div>
                                                        <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                        <div class="crse_timer">{{ $course->duration ?? 'N/A' }} hours</div>
                                                    </div>
                                                </a>
                                                <div class="fcrse_content">
                                                    <div class="eps_dots more_dropdown">
                                                        <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                        <div class="dropdown-content">

                                                            <span class="add-to-home-text" data-id="{{ $course->id }}" style="cursor: pointer;">
                                                                <i class="uil uil-windsock"></i> add to home
                                                            </span>

                                                            <span class="publish-text" data-id="{{ $course->id }}"
                                                                style="cursor: pointer;">
                                                                <i class="uil uil-windsock"></i> Publish
                                                            </span>

                                                            <a href="{{ route('course.edit', $course->id) }}"><span><i
                                                                        class="uil uil-edit-alt text-sm"></i>Edit</span></a>
                                                        </div>
                                                    </div>
                                                    <div class="vdtodt">
                                                        <span class="vdt14">50 views</span>
                                                        <span
                                                            class="vdt14">{{ $course->created_at->diffForHumans() }}</span>

                                                    </div>  
                                                    <a href="{{ route('course.show', $course->id) }}"
                                                        class="crse14s">{{ $course->title }}</a>
                                                    <div class="row">
                                                        <div class="col-lg-9">
                                                            <a href="#"
                                                                class="crse-cate">{{ $course->category->name ?? 'Uncategorized' }}</a>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <form action="{{ route('courses.toggle', $course->id) }}"
                                                                method="POST" class="toggle-form">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="toggle-button mt-2">
                                                                     <input type="checkbox" class="toggle-input"
                                                                        id="toggle{{ $course->id }}"
                                                                        data-id="{{ $course->id }}"
                                                                        {{ $course->is_active ? 'checked' : '' }}
                                                                        onchange="updateCourseStatus({{ $course->id }})">
                                                                    <label for="toggle{{ $course->id }}"
                                                                        class="toggle-label">
                                                                        <span class="toggle-circle"></span>
                                                                    </label>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="auth1lnkprce">
                                                        <p class="cr1fot">By <a
                                                                href="#">{{ $course->user->first_name . ' ' . $course->user->last_name ?? 'unknown' }}</a>
                                                        </p>
                                                        <div class="prce142">{{ $course->price == 0 ? 'Free' : '₹' . $course->price }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.footer')
        <script>
            $(document).ready(function() {
                $('.publish-text').click(function() {
                    var courseId = $(this).data('id');
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Do you want to publish this course?",
                        icon: "warning",
                        background: '#f8f9fa', // Light background color
                        color: '#343a40', // Dark text color
                        showCancelButton: true,
                        confirmButtonColor: "#28a745", // Green color for confirm button
                        cancelButtonColor: "#dc3545", // Red color for cancel button
                        confirmButtonText: "Yes, Publish it!",
                        cancelButtonText: "No, Cancel",
                        customClass: {
                            title: 'swal-title', // Custom class for title
                            content: 'swal-content', // Custom class for content
                            confirmButton: 'swal-confirm-button', // Custom class for confirm button
                            cancelButton: 'swal-cancel-button' // Custom class for cancel button
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('course.publish') }}", // Add your URL here
                                type: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    course_id: courseId // Include course ID in the data
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: "Published!",
                                        text: "The course has been published.",
                                        icon: "success",
                                        background: '#d4edda', // Light green background for success
                                        color: '#155724', // Dark green text color
                                        confirmButtonColor: "#28a745" // Green color for confirm button
                                    });
                                    location.reload(); // Reload page after update
                                },
                                error: function(xhr) {
                                    var errorMessage = xhr.responseJSON.message ||
                                        "Something went wrong.";
                                    Swal.fire({
                                        title: "Error!",
                                        text: errorMessage,
                                        icon: "error",
                                        background: '#f8d7da', // Light red background for error
                                        color: '#721c24', // Dark red text color
                                        confirmButtonColor: "#dc3545" // Red color for confirm button
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>

        <script>
            function updateCourseStatus(courseId) {
                let isActive = document.getElementById(`toggle${courseId}`).checked;

                fetch(`{{ url('/courses/toggle-status/') }}/${courseId}`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            is_active: isActive
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.options = {
                                closeButton: true,
                                debug: false,
                                newestOnTop: true,
                                progressBar: true,
                                positionClass: "toast-top-right",
                                preventDuplicates: true,
                                timeOut: 2000,
                                extendedTimeOut: 1000,
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                onShown: function() {
                                    $(".toast-success").css({
                                        'background-color': '#28a745', // Green for success
                                        'opacity': '1' // Adjust opacity
                                    });;
                                }
                            };
                            toastr.success('Course status updated successfully.')
                        } else {
                            alert('Failed to update status!');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        </script>
        <script>
            $(document).ready(function () {
                $('.add-to-home-text').click(function () {
                    var courseId = $(this).data('id');
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Do you want to add this course to home?",
                        icon: "warning",
                        background: '#f8f9fa',
                        color: '#343a40',
                        showCancelButton: true,
                        confirmButtonColor: "#28a745",
                        cancelButtonColor: "#dc3545",
                        confirmButtonText: "Yes, Add it!",
                        cancelButtonText: "No, Cancel",
                        customClass: {
                            title: 'swal-title',
                            content: 'swal-content',
                            confirmButton: 'swal-confirm-button',
                            cancelButton: 'swal-cancel-button'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('courses.addToHome') }}", // Add your route here
                                type: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    course_id: courseId
                                },
                                success: function (response) {
                                    Swal.fire({
                                        title: "Added to Home!",
                                        text: "The course has been added to home.",
                                        icon: "success",
                                        background: '#d4edda',
                                        color: '#155724',
                                        confirmButtonColor: "#28a745"
                                    });
                                    location.reload(); // Reload page after update
                                },
                                error: function (xhr) {
                                    var errorMessage = xhr.responseJSON.message || "Something went wrong.";
                                    Swal.fire({
                                        title: "Error!",
                                        text: errorMessage,
                                        icon: "error",
                                        background: '#f8d7da',
                                        color: '#721c24',
                                        confirmButtonColor: "#dc3545"
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>

@endsection
