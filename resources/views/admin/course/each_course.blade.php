@extends('admin.layouts.master')

@section('title')
    View saved course
@endsection

@section('content')
    <div class="wrapper _bg4586">
        <div class="_215b01">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section3125">
                            <div class="row justify-content-center">
                                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                                    <div class="preview_video position-relative">
                                        <a href="#" class="fcrse_img video-trigger">
                                            <img src="{{ asset('courseThumbnail/' . $courseDetail->thumbnail_url) }}"
                                                alt="Course Thumbnail" class="img-fluid thumbnail" style="height: 213px;">
                                            <div class="course-overlay intro_overlay">
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                <span class="_215b02">Preview this course</span>
                                            </div>
                                        </a>
                                        <video id="videoPlayer" class="course-video" width="100%" controls>
                                            <source src="{{ asset('courseVideo/' . $courseDetail->url) }}" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var previewContainer = document.querySelector('.preview_video');
                                        var video = document.getElementById('videoPlayer');
                                        var overlay = previewContainer.querySelector('.course-overlay');

                                        previewContainer.addEventListener('click', function(event) {
                                            event.preventDefault(); // Prevent default link behavior
                                            previewContainer.classList.add('active'); // Show video

                                            video.play(); // Auto-play video
                                        });

                                        // Hide video and show thumbnail when video ends
                                        video.addEventListener('ended', function() {
                                            previewContainer.classList.remove('active');
                                        });
                                    });
                                </script>

                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
                                    <div class="_215b03">
                                        <h2>{{ $courseDetail->title }}</h2>
                                        <span class="_215b04">{{ $courseDetail->description }}</span>
                                    </div>
                                    <div class="_215b05">
                                        <div class="crse_reviews mr-2">
                                            <i class="uil uil-star"></i>5.3.2
                                        </div>
                                        (81,665 ratings)
                                    </div>
                                    {{-- <div class="_215b05">114,521 students enrolled</div> --}}
                                    <div class="_215b06">
                                        <div class="_215b07">
                                            <span><i class='uil uil-comment'></i></span>
                                            English
                                        </div>
                                    </div>
                                    <div class="_215b05">Last updated {{ $courseDetail->updated_at }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="_215b15 _byt1458">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user_dt5">
                            <div class="user_dt_left">
                                <div class="live_user_dt">
                                    <div class="user_img5">
                                        @if (!empty(auth()->user()->profile_picture_url))
                                            <img id="profile_picture" src="{{ asset(Auth::user()->profile_picture_url) }}"
                                                class="img-fluid">
                                        @else
                                            <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px; font-size: 18px;">
                                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="user_cntnt">
                                        <a href="{{ route('setting') }}"
                                            class="mt-2 _df7852">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="course_tabs">
                            <nav>
                                <div class="nav nav-tabs tab_crse justify-content-center" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-courses-tab" data-bs-toggle="tab"
                                        href="#nav-courses" role="tab" aria-selected="false">Courses Content</a>
                                    <a class="nav-item nav-link" id="nav-about-tab" data-bs-toggle="tab" href="#nav-about"
                                        role="tab" aria-selected="true">About</a>
                                    {{-- <a class="nav-item nav-link" id="nav-reviews-tab" data-bs-toggle="tab"
                                        href="#nav-reviews" role="tab" aria-selected="false">Reviews</a> --}}
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="_215b17">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="course_tab_content">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show" id="nav-about" role="tabpanel">
                                    <div class="_htg451">
                                        <div class="_htg452">
                                            <h3>Requirements</h3>
                                            @php
                                                $content = $courseDetail->requirement;
                                            @endphp

                                            @if (strpos($content, '<table') !== false)
                                                {!! str_replace('<table', '<table class="table table-striped table-hover"', $content) !!}
                                            @else
                                                <ul>
                                                    @foreach (explode('.', $content) as $item)
                                                        @if (trim($item) != '')
                                                            <li><span class="_5f7g11">{!! strip_tags(trim($item)) !!}</span></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif

                                        </div>
                                        <div class="_htg452 mt-35">
                                            <h3>Description</h3>
                                            <span class="_abc123">Hi! Welcome to the {{ $courseDetail->title }}.</span>

                                            <ul class="_abc124">
                                                <li><span class="_5f7g11">{{ $courseDetail->description }}</span></li>
                                            </ul>

                                        </div>
                                        <div class="_htg452 mt-35">
                                            <h3>What will students learn in your course?</h3>
                                            <span class="_abc123">Just updated to include Bootstrap 4.1.3!</span>

                                            <ul class="_abc124">
                                                @php
                                                    $content = $courseDetail->learn_in_course;
                                                @endphp

                                                @if (strpos($content, '<table') !== false)
                                                    {!! str_replace('<table', '<table class="table table-striped table-hover"', $content) !!}
                                                @else
                                                    <ul>
                                                        @foreach (explode('.', $content) as $item)
                                                            @if (trim($item) != '')
                                                                <li><span class="_5f7g11">{!! strip_tags(trim($item)) !!}</span>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                @endif

                                            </ul>

                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="nav-courses" role="tabpanel">
                                    @if ($courseDetail->courseattachment->isNotEmpty())
                                        @foreach ($courseDetail->courseattachment as $attachment)
                                            <div class="crse_content container">
                                                <div class="fcrse_1 flex flex-col md:flex-row items-start gap-4">
                                                    <div class="w-full md:w-1/3">
                                                        @if ($attachment->type === 'video')
                                                            <a href="{{ route('codeDebugger', ['id' => $courseDetail->id, 'video_id' => $attachment->id]) }}"
                                                                class="hf_img relative block">
                                                                <img src="{{ asset('courseThumbnail/' . $attachment->thumbnail_url) }}"
                                                                    alt="{{ $attachment->title }}"
                                                                    class="w-full rounded-lg">
                                                                <div
                                                                    class="course-overlay absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 flex flex-col justify-end p-4 rounded-lg">
                                                                    <div
                                                                        class="badge_seller bg-blue-500 text-white px-2 py-1 rounded-full">
                                                                        Featured</div>
                                                                    <div class="crse_reviews text-white playlist_review"><i
                                                                            class="uil uil-star"></i>4.5</div>
                                                                    <span class="play_btn1 text-white text-2xl"><i
                                                                            class="uil uil-play"></i></span>
                                                                    <div class="crse_timer text-white"
                                                                        id="video-duration-{{ $attachment->id }}">
                                                                        Loading...</div>
                                                                </div>
                                                            </a>
                                                            <video id="temp-video-{{ $attachment->id }}"
                                                                style="display:none;">
                                                                <source
                                                                    src="{{ asset('courseVideo/' . $attachment->url) }}"
                                                                    type="video/mp4">
                                                            </video>
                                                            <script>
                                                                document.addEventListener('DOMContentLoaded', function() {
                                                                    const video = document.getElementById('temp-video-{{ $attachment->id }}');
                                                                    video.addEventListener('loadedmetadata', () => {
                                                                        const duration = video.duration;
                                                                        const minutes = Math.floor(duration / 60);
                                                                        const seconds = Math.floor(duration % 60);
                                                                        const formattedDuration = minutes > 0 ?
                                                                            `${minutes}:${seconds.toString().padStart(2, '0')} minutes` : `${seconds} seconds`;
                                                                        document.getElementById('video-duration-{{ $attachment->id }}').innerText =
                                                                            formattedDuration;
                                                                    });
                                                                    video.load();
                                                                });
                                                            </script>
                                                        @elseif ($attachment->type === 'document' && Str::endsWith($attachment->url, '.pdf'))
                                                            <a href="{{ asset('courseAssignments/' . $attachment->url) }}"
                                                                target="_blank" class="hf_img">
                                                                <div
                                                                    class="pdf-thumbnail bg-gray-200 flex items-center justify-center rounded-2xl h-40">
                                                                    <img src="{{ asset('images/PDF_file_icon.svg.webp') }}"
                                                                        alt="PDF Document" class="w-24">
                                                                </div>
                                                            </a>
                                                            <div class="eps_dots eps_dots10 more_dropdown relative">
                                                                <i class="uil uil-ellipsis-v text-lg cursor-pointer"></i>
                                                                <div
                                                                    class="dropdown-content hidden absolute bg-white shadow-lg rounded-lg p-2">
                                                                    <a href="{{ asset('courseAssignments/' . $attachment->url) }}"
                                                                        download="{{ $attachment->title }}"
                                                                        class="bg-blue-500 text-white px-4 py-2 rounded-2xl">Download</a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="hs_content w-full md:w-2/3">
                                                        <div class="vdtodt">
                                                            <span class="vdt14">{{ $attachment->views ?? '0' }}
                                                                views</span>
                                                        </div>
                                                        <a href="javascript:void(0);"
                                                            class="crse14s title900 text-lg font-bold">{{ $attachment->title }}
                                                            | {{ $courseDetail->category->name ?? 'Uncategorized' }}</a>
                                                        <p class="text-gray-700">{{ $attachment->discription }}</p>
                                                        <div class="auth1lnkprce">
                                                            <p>By <a href="javascript:;"
                                                                    class="text-blue-500">{{ $users->first_name . ' ' . $users->last_name ?? 'Unknown' }}</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="no-categories-container text-center fade-in-animation footer mt-3">
                                            <i class="uil uil-folder-minus bounce-effect"
                                                style="font-size: 50px; color: #d1d1d1;"></i>
                                            <h3 class="mt-3 scale-in-text" style="color: #777;">No content Found</h3>
                                            <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have
                                                any
                                                content yet. Add one now to get started!</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="nav-reviews" role="tabpanel">
                                    <div class="student_reviews">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <form action="{{ route('review.store') }}" method="POST"
                                                    id="review-form">
                                                    @csrf
                                                    <input type="hidden" name="course_id"
                                                        value="{{ $courseDetail->id }}">

                                                    <div class="review-container">
                                                        <h3 class="review-title">Give Your Review</h3>

                                                        <!-- Star Rating -->
                                                        <div class="rating-stars">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <span class="star"
                                                                    data-value="{{ $i }}">★</span>
                                                            @endfor
                                                            <input type="hidden" name="rating" id="rating-value"
                                                                value="0">
                                                        </div>

                                                        <!-- Review Text -->
                                                        <textarea name="review" id="review-text" class="mt-3 form-control dt-input" placeholder="Write your review..."
                                                            rows="5"></textarea>

                                                        <!-- Submit Button -->
                                                        <button type="submit" class="submit-btn mt-3"
                                                            id="submit-review">Submit Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="review_right">
                                                    <div class="review_right_heading">
                                                        <h3>Reviews</h3>
                                                    </div>
                                                </div>
                                                <div class="review_all120" id="review-container">
                                                    <!-- Dynamic Reviews Will be Loaded Here -->
                                                </div>

                                            </div>
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
        {{-- <script>
            $(document).ready(function() {
                const courseId = {{ $courseDetail->id }};
                const stars = $('.star');
                const ratingValue = $('#rating-value');

                // ⭐ Handle star click event
                stars.on('click', function() {
                    const value = parseInt($(this).data('value'));
                    ratingValue.val(value);
                    updateStars(value);
                });

                // ⭐ Function to fill stars
                function updateStars(rating) {
                    stars.each(function() {
                        const value = parseInt($(this).data('value'));
                        $(this).toggleClass('filled', value <= rating);
                    });
                }

                // ⭐ Submit form with AJAX and Swal
                $('#review-form').on('submit', function(event) {
                    event.preventDefault();

                    const formData = $(this).serialize();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.success,
                                confirmButtonColor: '#f39c12'
                            });
                            $('#review-form')[0].reset(); // ✅ Reset form
                            resetStars(); // ✅ Reset stars
                            loadReviews(); // ✅ Reload reviews after submission
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to submit review',
                                confirmButtonColor: '#d33'
                            });
                        }
                    });
                });

                // ⭐ Reset stars after submission
                function resetStars() {
                    stars.removeClass('filled');
                    ratingValue.val(0);
                }

                // ⭐ Load all reviews
                function loadReviews() {
                    $.ajax({
                        url: `/review/${courseId}`,
                        type: 'GET',
                        success: function(reviews) {
                            console.log(reviews);

                            // 🔥 Convert object to array if needed
                            if (!Array.isArray(reviews)) {
                                reviews = [reviews];
                            }

                            if (reviews.length > 0) {
                                $('#review-container').empty();
                                window.assetUrl = "{{ asset('') }}";
                                reviews.forEach(review => {
                                    let stars = '';
                                    for (let i = 1; i <= 5; i++) {
                                        if (i <= Math.floor(review.rating)) {
                                            stars +=
                                                `<span class="rating-star full-star">&#9733;</span>`;
                                        } else if (i === Math.floor(review.rating) + 1 && review
                                            .rating % 1 !== 0) {
                                            stars +=
                                                `<span class="rating-star half-star">&#9733;</span>`;
                                        } else {
                                            stars +=
                                                `<span class="rating-star empty-star">&#9733;</span>`;
                                        }
                                    }

                                    const reviewItem = `
                            <div class="review_item">
                                <div class="review_usr_dt">
                                    ${review.user.profile_picture_url
                                        ? ` <img src="${window.assetUrl + review.user.profile_picture_url}" alt="" >` 
                                        : `<div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px; font-size: 18px;">
                                                        ${review.user.username ? review.user.username.charAt(0).toUpperCase() : ''}
                                                    </div>`}
                                    <div class="rv1458">
                                        <h4 class="tutor_name1">${review.user.username || 'Anonymous'}</h4>
                                        <span class="time_145">${formatTime(review.created_at)}</span>
                                    </div>
                                </div>
                                <div class="rating-box mt-20">${stars}</div>
                                <p class="rvds10">${review.review || 'No review provided.'}</p>
                            </div>
                        `;

                                    $('#review-container').append(reviewItem);
                                });
                            } else {
                                $('#review-container').html(`
                        <div class="no-categories-container text-center fade-in-animation footer">
                            <i class="uil uil-folder-minus bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                            <h3 class="mt-3 scale-in-text" style="color: #777;">No Review Found</h3>
                            <p class="mb-4 fade-in-text" style="color: #aaa;">
                                It looks like you don't have any Reviews yet.
                            </p>
                        </div>
                    `);
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }

                // ⭐ Format time (e.g., "2 hours ago")
                function formatTime(time) {
                    if (!time) return 'Unknown';
                    const date = new Date(time);
                    return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
                }

                // ⭐ Load reviews when page loads
                loadReviews();
            });
        </script> --}}
    @endsection
