@extends('instructor.layouts.master')

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
                                <div class="preview_video">
                                    <a href="#" class="fcrse_img" data-bs-toggle="modal" data-bs-target="#videoModal">
                                        <img src="{{ asset('courseThumbnail/' . $courseDetail->thumbnail_url) }}" alt="Course Thumbnail" class="img-fluid" style="height : 213px;"/>
                                        <div class="course-overlay intro_overlay">
                                            <div class="badge_seller">Bestseller</div>
                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                            <span class="_215b02">Preview this course</span>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <video id="videoPlayer" width="100%" controls>
                                                <source id="videoSource" src="" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                var videoModal = document.getElementById('videoModal');
                                videoModal.addEventListener('show.bs.modal', function(event) {
                                    var videoUrl = "{{ asset('courseVideo/' . $courseDetail->url) }}";
                                    var videoSource = videoModal.querySelector('#videoSource');
                                    var videoPlayer = videoModal.querySelector('#videoPlayer');

                                    videoSource.setAttribute('src', videoUrl);
                                    videoPlayer.load();
                                });

                                videoModal.addEventListener('hidden.bs.modal', function() {
                                    var videoPlayer = videoModal.querySelector('#videoPlayer');
                                    videoPlayer.pause();
                                    videoPlayer.currentTime = 0;
                                });
                            </script>

                            <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
                                <div class="_215b03">
                                    <h2>{{ $courseDetail->title }}</h2>
                                    <span class="_215b04">The only course you need to learn web development - HTML, CSS, JS, Node, and More!</span>
                                </div>
                                <div class="_215b05">
                                    <div class="crse_reviews mr-2">
                                        <i class="uil uil-star"></i>5.3.2
                                    </div>
                                    (81,665 ratings)
                                </div>
                                <div class="_215b05">114,521 students enrolled</div>
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
                                        <img id="profile_picture" src="{{ asset(Auth::user()->profile_picture_url) }}" class="img-fluid">
                                    @else
                                        <h1 id="default_avtar" style="position: relative; right: 28%;">
                                            {{ substr(Auth::user()->username, 0, 1) }}
                                        </h1>
                                    @endif
                                </div>
                                <div class="user_cntnt">
                                    <a href="{{ route('setting') }}"
                                        class="mt-2 _df7852">{{ Auth::user()->username }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="course_tabs">
                        <nav>
                            <div class="nav nav-tabs tab_crse justify-content-center" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-courses-tab" data-bs-toggle="tab" href="#nav-courses" role="tab" aria-selected="false">Courses Content</a>
                                <a class="nav-item nav-link" id="nav-about-tab" data-bs-toggle="tab" href="#nav-about" role="tab" aria-selected="true">About</a>
                                <a class="nav-item nav-link" id="nav-reviews-tab" data-bs-toggle="tab" href="#nav-reviews" role="tab" aria-selected="false">Reviews</a>
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
                                            <ul class="list-group">
                                                @foreach(explode('.', $content) as $item)
                                                    @if(trim($item) != '')
                                                        <li class="list-group-item"><span class="_5f7g11">{{ trim($item) }}</span></li>
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
                                                @foreach(explode('.', $content) as $item)
                                                    @if(trim($item) != '')
                                                        <li><span class="_5f7g11">{!! strip_tags(trim($item)) !!}</span></li>
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
                                        <div class="crse_content container mx-auto p-4">
                                            <div class="fcrse_1 flex flex-col md:flex-row items-start gap-4">
                                                <div class="w-full md:w-1/3">
                                                    @if ($attachment->type === 'video')
                                                        <a href="{{ route('codeDebugger', ['id' => $courseDetail->id, 'video_id' => $attachment->id]) }}" class="hf_img relative block">
                                                            <img src="{{ asset('courseThumbnail/' . $attachment->thumbnail_url) }}" alt="{{ $attachment->title }}" class="w-full rounded-lg">
                                                            <div class="course-overlay absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 flex flex-col justify-end p-4 rounded-lg">
                                                                <div class="badge_seller bg-blue-500 text-white px-2 py-1 rounded-full">Featured</div>
                                                                <div class="crse_reviews text-white playlist_review"><i class="uil uil-star"></i>4.5</div>
                                                                <span class="play_btn1 text-white text-2xl"><i class="uil uil-play"></i></span>
                                                                <div class="crse_timer text-white" id="video-duration-{{ $attachment->id }}">Loading...</div>
                                                            </div>
                                                        </a>
                                                        <video id="temp-video-{{ $attachment->id }}" style="display:none;">
                                                            <source src="{{ asset('courseVideo/' . $attachment->url) }}" type="video/mp4">
                                                        </video>
                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                const video = document.getElementById('temp-video-{{ $attachment->id }}');
                                                                video.addEventListener('loadedmetadata', () => {
                                                                    const duration = video.duration;
                                                                    const minutes = Math.floor(duration / 60);
                                                                    const seconds = Math.floor(duration % 60);
                                                                    const formattedDuration = minutes > 0 ? `${minutes}:${seconds.toString().padStart(2, '0')} minutes` : `${seconds} seconds`;
                                                                    document.getElementById('video-duration-{{ $attachment->id }}').innerText = formattedDuration;
                                                                });
                                                                video.load();
                                                            });
                                                        </script>
                                                    @elseif ($attachment->type === 'document' && Str::endsWith($attachment->url, '.pdf'))
                                                        <a href="{{ asset('courseAssignments/' . $attachment->url) }}" target="_blank" class="hf_img">
                                                            <div class="pdf-thumbnail bg-gray-200 flex items-center justify-center rounded-2xl h-40">
                                                                <img src="{{ asset('images/PDF_file_icon.svg.webp') }}" alt="PDF Document" class="w-24">
                                                            </div>
                                                        </a>
                                                        <div class="eps_dots eps_dots10 more_dropdown relative">
                                                            <i class="uil uil-ellipsis-v text-lg cursor-pointer"></i>
                                                            <div class="dropdown-content hidden absolute bg-white shadow-lg rounded-lg p-2">
                                                                <a href="{{ asset('courseAssignments/' . $attachment->url) }}" download="{{ $attachment->title }}" class="bg-blue-500 text-white px-4 py-2 rounded-2xl">Download</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="hs_content w-full md:w-2/3">
                                                    <div class="vdtodt">
                                                        <span class="vdt14">{{ $attachment->views ?? '0' }} views</span>
                                                    </div>
                                                    <a href="javascript:void(0);" class="crse14s title900 text-lg font-bold">{{ $attachment->title }} | {{ $courseDetail->category->name ?? 'Uncategorized' }}</a>
                                                    <p class="text-gray-700">{{ $attachment->discription }}</p>
                                                    <div class="auth1lnkprce">
                                                        <p>By <a href="javascript:;" class="text-blue-500">{{ $users->username ?? 'Unknown' }}</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="no-categories-container text-center py-10">
                                        <i class="uil uil-folder-minus text-5xl text-gray-300"></i>
                                        <h3 class="mt-3 text-2xl text-gray-500">No Content Found</h3>
                                        <p class="text-gray-400">It looks like you don't have any content yet. Add one now to get started!</p>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="nav-reviews" role="tabpanel">
                                <div class="student_reviews">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="reviews_left">
                                                <h3>Student Feedback</h3>
                                                <div class="total_rating">
                                                    <div class="_rate001">4.6</div>
                                                    <div class="rating-box">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star half-star"></span>
                                                    </div>
                                                    <div class="_rate002">Course Rating</div>
                                                </div>
                                                <div class="_rate003">
                                                    <div class="_rate004">
                                                        <div class="progress progress1">
                                                            <div class="progress-bar w-70" role="progressbar"
                                                                aria-valuenow="70" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="rating-box">
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star full-star"></span>
                                                        </div>
                                                        <div class="_rate002">70%</div>
                                                    </div>
                                                    <div class="_rate004">
                                                        <div class="progress progress1">
                                                            <div class="progress-bar w-30" role="progressbar"
                                                                aria-valuenow="30" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="rating-box">
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star empty-star"></span>
                                                        </div>
                                                        <div class="_rate002">40%</div>
                                                    </div>
                                                    <div class="_rate004">
                                                        <div class="progress progress1">
                                                            <div class="progress-bar w-5" role="progressbar"
                                                                aria-valuenow="10" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="rating-box">
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star empty-star"></span>
                                                            <span class="rating-star empty-star"></span>
                                                        </div>
                                                        <div class="_rate002">5%</div>
                                                    </div>
                                                    <div class="_rate004">
                                                        <div class="progress progress1">
                                                            <div class="progress-bar w-2" role="progressbar"
                                                                aria-valuenow="2" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                        <div class="rating-box">
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star empty-star"></span>
                                                            <span class="rating-star empty-star"></span>
                                                            <span class="rating-star empty-star"></span>
                                                        </div>
                                                        <div class="_rate002">1%</div>
                                                    </div>
                                                    <div class="_rate004">
                                                        <div class="progress progress1">
                                                            <div class="progress-bar w-1" role="progressbar"
                                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                        <div class="rating-box">
                                                            <span class="rating-star full-star"></span>
                                                            <span class="rating-star empty-star"></span>
                                                            <span class="rating-star empty-star"></span>
                                                            <span class="rating-star empty-star"></span>
                                                            <span class="rating-star empty-star"></span>
                                                        </div>
                                                        <div class="_rate002">1%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="review_right">
                                                <div class="review_right_heading">
                                                    <h3>Reviews</h3>
                                                    <div class="review_search">
                                                        <input class="rv_srch" type="text"
                                                            placeholder="Search reviews...">
                                                        <button class="rvsrch_btn"><i
                                                                class='uil uil-search'></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review_all120">
                                                <div class="review_item">
                                                    <div class="review_usr_dt">
                                                        <img src="images/left-imgs/img-1.jpg" alt="">
                                                        <div class="rv1458">
                                                            <h4 class="tutor_name1">John Doe</h4>
                                                            <span class="time_145">2 hour ago</span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-box mt-20">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star half-star"></span>
                                                    </div>
                                                    <p class="rvds10">Nam gravida elit a velit rutrum, eget dapibus ex
                                                        elementum. Interdum et malesuada fames ac ante ipsum primis in
                                                        faucibus. Fusce lacinia, nunc sit amet tincidunt venenatis.</p>
                                                    <div class="rpt100">
                                                        <span>Was this review helpful?</span>
                                                        <div class="radio--group-inline-container">
                                                            <div class="radio-item">
                                                                <input id="radio-1" name="radio" type="radio">
                                                                <label for="radio-1" class="radio-label">Yes</label>
                                                            </div>
                                                            <div class="radio-item">
                                                                <input id="radio-2" name="radio" type="radio">
                                                                <label for="radio-2" class="radio-label">No</label>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="report145">Report</a>
                                                    </div>
                                                </div>
                                                <div class="review_item">
                                                    <div class="review_usr_dt">
                                                        <img src="images/left-imgs/img-2.jpg" alt="">
                                                        <div class="rv1458">
                                                            <h4 class="tutor_name1">Jassica William</h4>
                                                            <span class="time_145">12 hour ago</span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-box mt-20">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                    </div>
                                                    <p class="rvds10">Nam gravida elit a velit rutrum, eget dapibus ex
                                                        elementum. Interdum et malesuada fames ac ante ipsum primis in
                                                        faucibus. Fusce lacinia, nunc sit amet tincidunt venenatis.</p>
                                                    <div class="rpt100">
                                                        <span>Was this review helpful?</span>
                                                        <div class="radio--group-inline-container">
                                                            <div class="radio-item">
                                                                <input id="radio-3" name="radio1" type="radio">
                                                                <label for="radio-3" class="radio-label">Yes</label>
                                                            </div>
                                                            <div class="radio-item">
                                                                <input id="radio-4" name="radio1" type="radio">
                                                                <label for="radio-4" class="radio-label">No</label>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="report145">Report</a>
                                                    </div>
                                                </div>
                                                <div class="review_item">
                                                    <div class="review_usr_dt">
                                                        <img src="images/left-imgs/img-3.jpg" alt="">
                                                        <div class="rv1458">
                                                            <h4 class="tutor_name1">Albert Dua</h4>
                                                            <span class="time_145">5 days ago</span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-box mt-20">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star half-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                    </div>
                                                    <p class="rvds10">Nam gravida elit a velit rutrum, eget dapibus ex
                                                        elementum. Interdum et malesuada fames ac ante ipsum primis in
                                                        faucibus. Fusce lacinia, nunc sit amet tincidunt venenatis.</p>
                                                    <div class="rpt100">
                                                        <span>Was this review helpful?</span>
                                                        <div class="radio--group-inline-container">
                                                            <div class="radio-item">
                                                                <input id="radio-5" name="radio2" type="radio">
                                                                <label for="radio-5" class="radio-label">Yes</label>
                                                            </div>
                                                            <div class="radio-item">
                                                                <input id="radio-6" name="radio2" type="radio">
                                                                <label for="radio-6" class="radio-label">No</label>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="report145">Report</a>
                                                    </div>
                                                </div>
                                                <div class="review_item">
                                                    <div class="review_usr_dt">
                                                        <img src="images/left-imgs/img-4.jpg" alt="">
                                                        <div class="rv1458">
                                                            <h4 class="tutor_name1">Zoena Singh</h4>
                                                            <span class="time_145">15 days ago</span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-box mt-20">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                    </div>
                                                    <p class="rvds10">Nam gravida elit a velit rutrum, eget dapibus ex
                                                        elementum. Interdum et malesuada fames ac ante ipsum primis in
                                                        faucibus. Fusce lacinia, nunc sit amet tincidunt venenatis.</p>
                                                    <div class="rpt100">
                                                        <span>Was this review helpful?</span>
                                                        <div class="radio--group-inline-container">
                                                            <div class="radio-item">
                                                                <input id="radio-7" name="radio3" type="radio">
                                                                <label for="radio-7" class="radio-label">Yes</label>
                                                            </div>
                                                            <div class="radio-item">
                                                                <input id="radio-8" name="radio3" type="radio">
                                                                <label for="radio-8" class="radio-label">No</label>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="report145">Report</a>
                                                    </div>
                                                </div>
                                                <div class="review_item">
                                                    <div class="review_usr_dt">
                                                        <img src="images/left-imgs/img-5.jpg" alt="">
                                                        <div class="rv1458">
                                                            <h4 class="tutor_name1">Joy Dua</h4>
                                                            <span class="time_145">20 days ago</span>
                                                        </div>
                                                    </div>
                                                    <div class="rating-box mt-20">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                    </div>
                                                    <p class="rvds10">Nam gravida elit a velit rutrum, eget dapibus ex
                                                        elementum. Interdum et malesuada fames ac ante ipsum primis in
                                                        faucibus. Fusce lacinia, nunc sit amet tincidunt venenatis.</p>
                                                    <div class="rpt100">
                                                        <span>Was this review helpful?</span>
                                                        <div class="radio--group-inline-container">
                                                            <div class="radio-item">
                                                                <input id="radio-9" name="radio4" type="radio">
                                                                <label for="radio-9" class="radio-label">Yes</label>
                                                            </div>
                                                            <div class="radio-item">
                                                                <input id="radio-10" name="radio4" type="radio">
                                                                <label for="radio-10" class="radio-label">No</label>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="report145">Report</a>
                                                    </div>
                                                </div>
                                                <div class="review_item">
                                                    <a href="#" class="more_reviews">See More Reviews</a>
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
    </div>
    @endsection