@extends('instructor.layouts.master')

@section('title')
    Explore Courses
@endsection

@section('content')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-8">
                        <div class="section3125">
                            <h2 class="st_title"> <i class="uil uil-graduation-cap"></i> Courses</h2>
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

                                                            {{-- <span class="toggle-home-status" data-id="{{ $course->id }}"
                                                                data-active="{{ $course->is_active_home }}"
                                                                style="cursor: pointer;">
                                                                <i class="uil uil-windsock"></i>
                                                                {{ $course->is_active_home ? 'Remove from Home' : 'Add to Home' }}
                                                            </span> --}}

                                                            <span class="toggle-publish-status"
                                                                data-id="{{ $course->id }}"
                                                                data-active="{{ $course->is_active }}"
                                                                style="cursor: pointer;">
                                                                <i class="uil uil-windsock"></i>
                                                                {{-- <span id="publish-label-{{ $course->id }}"> --}}
                                                                    {{ $course->is_active ? 'Unpublish' : 'Publish' }}
                                                                {{-- </span> --}}
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
                                                        <div class="col-lg-12">
                                                            <a href="#" class="crse-cate">{{ Str::limit($course->description, 100, '...') ?? 'Uncategorized' }}</a>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="auth1lnkprce">
                                                        <p class="cr1fot">By <a
                                                                href="#">{{ $course->user->first_name . ' ' . $course->user->last_name ?? 'unknown' }}</a>
                                                        </p>
                                                        <div class="prce142">
                                                            @if ($course->price == 0)
                                                                Free
                                                            @else
                                                                @if ($course->discount > 0)
                                                                    <s
                                                                        style="text-decoration-color: red; font-size: 0.9em;">₹{{ $course->price }}</s>
                                                                @endif
                                                                ₹{{ $course->price - ($course->discount ?? 0) }}
                                                            @endif
                                                        </div>
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
    </div>

    <script>
        $(document).ready(function() {
            $('.toggle-publish-status').click(function() {
                var courseId = $(this).data('id');
                var isActive = $(this).data('active');

                var actionText = isActive ? "unpublish this course?" : "publish this course?";
                var confirmButtonText = isActive ? "Yes, Unpublish it!" : "Yes, Publish it!";
                var successMessage = isActive ? "Unpublished!" : "Published!";
                var successText = isActive ? "The course has been unpublished successfully." :
                    "The course has been published successfully.";

                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to " + actionText,
                    icon: "warning",
                    background: '#f8f9fa',
                    color: '#343a40',
                    showCancelButton: true,
                    confirmButtonColor: isActive ? "#dc3545" : "#28a745",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: "No, Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('course.togglePublish') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                course_id: courseId
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: successMessage,
                                    text: successText,
                                    icon: "success",
                                    background: '#d4edda',
                                    color: '#155724',
                                    confirmButtonColor: "#28a745"
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                var errorMessage = "Something went wrong.";
                                if (xhr.status === 400 && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }

                                Swal.fire({
                                    title: "Action Failed!",
                                    text: errorMessage,
                                    icon: "warning",
                                    background: '#fff3cd',
                                    color: '#856404',
                                    confirmButtonColor: "#ffc107"
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.toggle-home-status').click(function() {
                var courseId = $(this).data('id');
                var isActive = $(this).data('active');

                var actionText = isActive ? "remove this course from home?" : "add this course to home?";
                var confirmButtonText = isActive ? "Yes, Remove it!" : "Yes, Add it!";
                var successMessage = isActive ? "Removed from Home!" : "Added to Home!";
                var successText = isActive ? "The course has been removed from the home page." :
                    "The course has been added to the home page.";

                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to " + actionText,
                    icon: "warning",
                    background: '#f8f9fa',
                    color: '#343a40',
                    showCancelButton: true,
                    confirmButtonColor: isActive ? "#dc3545" : "#28a745",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: "No, Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('courses.toggleHomeStatus') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                course_id: courseId
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: successMessage,
                                    text: successText,
                                    icon: "success",
                                    background: '#d4edda',
                                    color: '#155724',
                                    confirmButtonColor: "#28a745"
                                });
                                location.reload();
                            },
                            error: function(xhr) {
                                var errorMessage = "Something went wrong.";
                                if (xhr.status === 400 && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }

                                Swal.fire({
                                    title: "Action Failed!",
                                    text: errorMessage,
                                    icon: "warning",
                                    background: '#fff3cd',
                                    color: '#856404',
                                    confirmButtonColor: "#ffc107"
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
