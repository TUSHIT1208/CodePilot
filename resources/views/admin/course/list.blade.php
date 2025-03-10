@extends('admin.layouts.master')

@section('title') Explore Courses @endsection

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
                                    @foreach($courses as $course)
                                        <div class="col-lg-3 col-md-4">
                                            <div class="fcrse_1 mt-30">
                                                <a href="{{ route('course.show', $course->id) }}" class="fcrse_img">
                                                    <img src="{{ isset($course->thumbnail_url) && $course->thumbnail_url != null ? asset('courseThumbnail/' . $course->thumbnail_url) : asset('images/courses/img-2.jpg') }}"
                                                        alt="Course Thumbnail">

                                                    <div class="course-overlay">
                                                        @if($course->is_active)
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
                                                            <span class="publish-text" data-id="{{ $course->id }}" style="cursor: pointer;">
                                                                <i class="uil uil-windsock"></i> Publish
                                                            </span>
                                                            
                                                            <a href="{{ route('course.edit', $course->id) }}"><span><i
                                                                        class="uil uil-edit-alt text-sm"></i>Edit</span></a>
                                                        </div>
                                                    </div>
                                                    <div class="vdtodt">
                                                        <span class="vdt14">50 views</span>
                                                        <span class="vdt14">{{ $course->created_at->diffForHumans() }}</span>

                                                    </div>
                                                    <a href="{{ route('course.show', $course->id) }}"
                                                        class="crse14s">{{ $course->title }}</a>
                                                    <a href="#"
                                                        class="crse-cate">{{ $course->category->name ?? 'Uncategorized' }}</a>
                                                    <div class="auth1lnkprce">
                                                        <p class="cr1fot">By <a
                                                                href="#">{{ $course->user->first_name . ' ' . $course->user->last_name ?? 'unknown'}}</a>
                                                        </p>
                                                        <div class="prce142">${{ $course->price ?? 'Free' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="col-md-12">
                                    <div class="main-loader mt-50">
                                        <div class="spinner">
                                            <div class="bounce1"></div>
                                            <div class="bounce2"></div>
                                            <div class="bounce3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.footer')
        <script>
            $(document).ready(function () {
                $('.publish-text').click(function () {
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
                                success: function (response) {
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
                                error: function (xhr) {
                                    var errorMessage = xhr.responseJSON.message || "Something went wrong.";
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
@endsection