@extends('learner.layout.master')

@section('title') My courses @endsection

@section('content_learner')
    <!-- Body Start -->
    <div class="wrapper _bg4586">

        <div class="container">
            <div class="crse_content">
                <h3>My courses</h3>
                <div class="_14d25">
                    <div class="row mt-5">
                        @if ($mycourse->isEmpty())
                            <!-- No Records Found -->
                            <div class="no-categories-container text-center fade-in-animation footer">
                                <i class="uil uil-folder-minus bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                                <h3 class="mt-3 scale-in-text" style="color: #777;">No Course Found</h3>
                                <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                                    Course yet. Add one now to get started!</p>
                            </div>
                        @else
                                        @foreach ($mycourse as $course)
                                                        @php
        $transaction = $paymentTransactions->firstWhere('order.order_items.0.course.id', $course->course->id);
                                                        @endphp
                                                        <div class="col-lg-3 col-md-4">
                                                            <div class="fcrse_1 mt-30">
                                                                <a href="{{ route('course.show', $course->course->id) }}" class="fcrse_img">
                                                                    <img src="{{ $course->course->thumbnail_url ? asset('courseThumbnail/' . $course->course->thumbnail_url) : asset('images/courses/img-2.jpg') }}"
                                                                        alt="Course Thumbnail">

                                                                    <div class="course-overlay" style="position: absolute;width : 100%;">
                                                                        @if ($course->course->is_active)
                                                                            <div class="badge_seller">Active</div>
                                                                        @else
                                                                            <div class="badge_seller">InActive</div>
                                                                        @endif
                                                                        <div class="crse_reviews">
                                                                            <i class="uil uil-star"></i> 5
                                                                        </div>
                                                                        <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                                        <div class="crse_timer">{{ $course->course->duration ?? 'N/A' }} hours</div>
                                                                    </div>
                                                                </a>
                                                                <div class="fcrse_content">
                                                                    <div class="eps_dots more_dropdown">
                                                                        <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                                        <div class="dropdown-content text-dark p-1">

                                                                            @if ($transaction)

                                                                                <a href="{{ route('invoice.view', $transaction->id) }}" title="View Invoice">
                                                                                    <i class="uil uil-eye"></i> Invoice
                                                                                </a>
                                                                                <br>
                                                                                <a href="{{ route('invoice.download', $transaction->id) }}"
                                                                                    title="Download Invoice">
                                                                                    <i class="uil uil-download-alt"></i> Invoice
                                                                                </a>

                                                                            @endif
                                                                            {{-- <span><i class="uil uil-eye"></i>View Invoice</span>
                                                                            <span><i class='uil uil-download-alt'></i>Download Invoice</span> --}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="vdtodt">
                                                                        <span class="vdt14">50 views</span>
                                                                        <span class="vdt14">{{ $course->course->created_at->diffForHumans() }}</span>

                                                                    </div>
                                                                    <a href="{{ route('course.show', $course->course->id) }}"
                                                                        class="crse14s">{{ $course->course->title }}</a>
                                                                    <a href="#"
                                                                        class="crse-cate">{{ $course->course->category->name ?? 'Uncategorized' }}</a>
                                                                    <div class="auth1lnkprce">
                                                                        <p>By <a
                                                                                href="javascript:;">{{ $course->course->user->first_name . ' ' . $course->course->user->last_name ?? 'unknown' }}</a>
                                                                        </p>
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
                @include('learner.layout.footer')

        {{--
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // When the "Edit Profile" button is clicked, trigger file input
                document.getElementById('editProfileBtn_learner').addEventListener('click', function () {
                    console.log("Edit Profile button clicked!");
                    document.getElementById('fileInput').click(); // Open file picker dialog
                });

                // Function to handle file input change event
                function previewImage(event) {
                    const file = event.target.files[0]; // Get selected file
                    const saveButton = document.getElementById('saveProfileBtn');
                    const profileImage = document.getElementById('profileImage');

                    if (file) {
                        console.log("Selected file:", file);

                        const reader = new FileReader(); // Create a FileReader instance

                        // Once the file is read, update the profile image preview
                        reader.onload = function (e) {
                            console.log("File loaded successfully:", e.target.result); // Log base64 string
                            profileImage.src = e.target.result; // Set image source
                            saveButton.style.display = 'inline-block'; // Show the save profile button
                        };

                        // Read the file as a data URL (this will create the preview)
                        reader.readAsDataURL(file);
                    } else {
                        console.log("No file selected.");
                        saveButton.style.display = 'none'; // Hide the save profile button if no image is selected

                        // Optionally reset the image to the default avatar
                        profileImage.src = 'path_to_default_avatar.jpg'; // Replace with your default avatar path
                    }
                }

                // Attach the previewImage function to the file input's change event
                document.getElementById('fileInput').addEventListener('change', previewImage);
            });
        </script> --}}
@endsection
