@extends('admin.layouts.master')

@section('title') Admin Profile @endsection

@section('content')
<!-- Body Start -->
<div class="wrapper _bg4586">
    <div class="_216b01">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <div class="section3125 rpt145">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="#" class="_216b22">
                                    <span><i class="uil uil-cog"></i></span>Setting
                                </a>
                                <form action="{{ route('upload.profile.image') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="dp_dt150">
                                        <div class="img148">
                                            @if(!empty(auth()->user()->profile_picture_url))
                                                <img src="{{ asset(Auth::user()->profile_picture_url) }}" alt="Profile Image" id="profileImage" style="width:200px; height:200px; object-fit: cover;">
                                            @else
                                                <img src="" alt="Default Profile" id="profileImage" style="display:none;">
                                                <h1 class="profile-default" id="profileInitial">{{ substr(Auth::user()->username, 0, 1) }}</h1>
                                            @endif
                                        </div>
                                        <div class="prfledt1">
                                            <h2>{{ Auth::user()->username }}</h2>
                                            <i id="editProfileBtn" class="uil uil-camera"></i>
                                            <input type="file" id="fileInput" name="profile_image" style="display:none;" onchange="previewImage(event)">
                                            <button id="saveProfileBtn" class="upload_btn" style="display:none;">Save Profile</button>
                                        </div>
                                    </div>
                                </form> 
                                <ul class="_ttl120">
                                    <li>
                                        <div class="_ttl121">
                                            <div class="_ttl122">Enroll Students</div>
                                            <div class="_ttl123">612K</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="_ttl121">
                                            <div class="_ttl122">Courses</div>
                                            <div class="_ttl123">8</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="_ttl121">
                                            <div class="_ttl122">Reviews</div>
                                            <div class="_ttl123">11K</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="_ttl121">
                                            <div class="_ttl122">Subscriptions</div>
                                            <div class="_ttl123">452K</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <a href="{{ route('setting') }}" class="_216b12">
                                    <span><i class="uil uil-cog"></i></span>Setting
                                </a>
                                <ul class="_bty149 mt-5">
                                    
                                    <li><a href="{{ route('setting') }}"><button class="msg125 btn500">Edit</button></a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="_215b15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="course_tabs">
                        <nav>
                            <div class="nav nav-tabs tab_crse" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-about-tab" data-bs-toggle="tab"
                                    href="#nav-about" role="tab" aria-selected="true">About</a>
                                <a class="nav-item nav-link" id="nav-courses-tab" data-bs-toggle="tab"
                                    href="#nav-courses" role="tab" aria-selected="false">Courses</a>
                                <a class="nav-item nav-link" id="nav-purchased-tab" data-bs-toggle="tab"
                                    href="#nav-purchased" role="tab" aria-selected="false">Purchased</a>
                                <a class="nav-item nav-link" id="nav-reviews-tab" data-bs-toggle="tab"
                                    href="#nav-reviews" role="tab" aria-selected="false">Discussion</a>
                                <a class="nav-item nav-link" id="nav-subscriptions-tab" data-bs-toggle="tab"
                                    href="#nav-subscriptions" role="tab" aria-selected="false">Subscriptions</a>
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
                            <div class="tab-pane fade show active" id="nav-about" role="tabpanel">
                                <div class="_htg451">
                                    <div class="_htg452">
                                        <h3>About Me</h3>
                                        <p>{{ $adminData->adminprofile->short_discription }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-courses" role="tabpanel">
                                <div class="crse_content">
                                    <h3>My courses (8)</h3>
                                    <div class="_14d25">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4">
                                                <div class="fcrse_1 mt-30">
                                                    <a href="course_detail_view.html" class="fcrse_img">
                                                        <img src="images/courses/img-1.jpg" alt="">
                                                        <div class="course-overlay">
                                                            <div class="badge_seller">Bestseller</div>
                                                            <div class="crse_reviews">
                                                                <i class="uil uil-star"></i>4.5
                                                            </div>
                                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                            <div class="crse_timer">
                                                                25 hours
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="fcrse_content">
                                                        <div class="eps_dots more_dropdown">
                                                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <span><i class="uil uil-share-alt"></i>Share</span>
                                                                <span><i class="uil uil-edit-alt"></i>Edit</span>
                                                            </div>
                                                        </div>
                                                        <div class="vdtodt">
                                                            <span class="vdt14">109k views</span>
                                                            <span class="vdt14">15 days ago</span>
                                                        </div>
                                                        <a href="course_detail_view.html" class="crse14s">Complete
                                                            Python Bootcamp: Go from zero to hero in Python 3</a>
                                                        <a href="#" class="crse-cate">Web Development | Python</a>
                                                        <div class="auth1lnkprce">
                                                            <p class="cr1fot">By <a href="#">John Doe</a></p>
                                                            <div class="prce142">$10</div>
                                                            <button class="shrt-cart-btn" title="cart"><i
                                                                    class="uil uil-shopping-cart-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="fcrse_1 mt-30">
                                                    <a href="course_detail_view.html" class="fcrse_img">
                                                        <img src="images/courses/img-2.jpg" alt="">
                                                        <div class="course-overlay">
                                                            <div class="badge_seller">Bestseller</div>
                                                            <div class="crse_reviews">
                                                                <i class="uil uil-star"></i>4.5
                                                            </div>
                                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                            <div class="crse_timer">
                                                                28 hours
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="fcrse_content">
                                                        <div class="eps_dots more_dropdown">
                                                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <span><i class="uil uil-share-alt"></i>Share</span>
                                                                <span><i class="uil uil-edit-alt"></i>Edit</span>
                                                            </div>
                                                        </div>
                                                        <div class="vdtodt">
                                                            <span class="vdt14">5M views</span>
                                                            <span class="vdt14">15 days ago</span>
                                                        </div>
                                                        <a href="course_detail_view.html" class="crse14s">The Complete
                                                            JavaScript Course 2020: Build Real Projects!</a>
                                                        <a href="#" class="crse-cate">Development | JavaScript</a>
                                                        <div class="auth1lnkprce">
                                                            <p class="cr1fot">By <a href="#">John Doe</a></p>
                                                            <div class="prce142">$5</div>
                                                            <button class="shrt-cart-btn" title="cart"><i
                                                                    class="uil uil-shopping-cart-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="fcrse_1 mt-30">
                                                    <a href="course_detail_view.html" class="fcrse_img">
                                                        <img src="images/courses/img-20.jpg" alt="">
                                                        <div class="course-overlay">
                                                            <div class="crse_reviews">
                                                                <i class="uil uil-star"></i>5.0
                                                            </div>
                                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                            <div class="crse_timer">
                                                                21 hours
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="fcrse_content">
                                                        <div class="eps_dots more_dropdown">
                                                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <span><i class="uil uil-share-alt"></i>Share</span>
                                                                <span><i class="uil uil-edit-alt"></i>Edit</span>
                                                            </div>
                                                        </div>
                                                        <div class="vdtodt">
                                                            <span class="vdt14">200 Views</span>
                                                            <span class="vdt14">4 days ago</span>
                                                        </div>
                                                        <a href="course_detail_view.html" class="crse14s">WordPress
                                                            Development - Themes, Plugins &amp; Gutenberg</a>
                                                        <a href="#" class="crse-cate">Design | Wordpress</a>
                                                        <div class="auth1lnkprce">
                                                            <p class="cr1fot">By <a href="#">John Doe</a></p>
                                                            <div class="prce142">$14</div>
                                                            <button class="shrt-cart-btn" title="cart"><i
                                                                    class="uil uil-shopping-cart-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="fcrse_1 mt-30">
                                                    <a href="course_detail_view.html" class="fcrse_img">
                                                        <img src="images/courses/img-4.jpg" alt="">
                                                        <div class="course-overlay">
                                                            <div class="badge_seller">Bestseller</div>
                                                            <div class="crse_reviews">
                                                                <i class="uil uil-star"></i>5.0
                                                            </div>
                                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                            <div class="crse_timer">
                                                                1 hour
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="fcrse_content">
                                                        <div class="eps_dots more_dropdown">
                                                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <span><i class="uil uil-share-alt"></i>Share</span>
                                                                <span><i class="uil uil-edit-alt"></i>Edit</span>
                                                            </div>
                                                        </div>
                                                        <div class="vdtodt">
                                                            <span class="vdt14">153k views</span>
                                                            <span class="vdt14">3 months ago</span>
                                                        </div>
                                                        <a href="course_detail_view.html" class="crse14s">The Complete
                                                            Digital Marketing Course - 12 Courses in 1</a>
                                                        <a href="#" class="crse-cate">Digital Marketing | Marketing</a>
                                                        <div class="auth1lnkprce">
                                                            <p class="cr1fot">By <a href="#">John Doe</a></p>
                                                            <div class="prce142">$12</div>
                                                            <button class="shrt-cart-btn" title="cart"><i
                                                                    class="uil uil-shopping-cart-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="fcrse_1 mt-30">
                                                    <a href="course_detail_view.html" class="fcrse_img">
                                                        <img src="images/courses/img-13.jpg" alt="">
                                                        <div class="course-overlay">
                                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                            <div class="crse_timer">
                                                                30 hours
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="fcrse_content">
                                                        <div class="eps_dots more_dropdown">
                                                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <span><i class="uil uil-share-alt"></i>Share</span>
                                                                <span><i class="uil uil-edit-alt"></i>Edit</span>
                                                            </div>
                                                        </div>
                                                        <div class="vdtodt">
                                                            <span class="vdt14">20 Views</span>
                                                            <span class="vdt14">1 day ago</span>
                                                        </div>
                                                        <a href="course_detail_view.html" class="crse14s">The Complete
                                                            Node.js Developer Course (3rd Edition)</a>
                                                        <a href="#" class="crse-cate">Development | Node.js</a>
                                                        <div class="auth1lnkprce">
                                                            <p class="cr1fot">By <a href="#">John Doe</a></p>
                                                            <div class="prce142">$3</div>
                                                            <button class="shrt-cart-btn" title="cart"><i
                                                                    class="uil uil-shopping-cart-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="fcrse_1 mt-30">
                                                    <a href="course_detail_view.html" class="fcrse_img">
                                                        <img src="images/courses/img-7.jpg" alt="">
                                                        <div class="course-overlay">
                                                            <div class="badge_seller">Bestseller</div>
                                                            <div class="crse_reviews">
                                                                <i class="uil uil-star"></i>5.0
                                                            </div>
                                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                            <div class="crse_timer">
                                                                5.4 hours
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="fcrse_content">
                                                        <div class="eps_dots more_dropdown">
                                                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <span><i class="uil uil-share-alt"></i>Share</span>
                                                                <span><i class="uil uil-edit-alt"></i>Edit</span>
                                                            </div>
                                                        </div>
                                                        <div class="vdtodt">
                                                            <span class="vdt14">109k views</span>
                                                            <span class="vdt14">15 days ago</span>
                                                        </div>
                                                        <a href="course_detail_view.html" class="crse14s">WordPress for
                                                            Beginners: Create a Website Step by Step</a>
                                                        <a href="#" class="crse-cate">Design | Wordpress</a>
                                                        <div class="auth1lnkprce">
                                                            <p class="cr1fot">By <a href="#">John Doe</a></p>
                                                            <div class="prce142">$18</div>
                                                            <button class="shrt-cart-btn" title="cart"><i
                                                                    class="uil uil-shopping-cart-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="fcrse_1 mt-30">
                                                    <a href="course_detail_view.html" class="fcrse_img">
                                                        <img src="images/courses/img-8.jpg" alt="">
                                                        <div class="course-overlay">
                                                            <div class="badge_seller">Bestseller</div>
                                                            <div class="crse_reviews">
                                                                <i class="uil uil-star"></i>4.0
                                                            </div>
                                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                            <div class="crse_timer">
                                                                23 hours
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="fcrse_content">
                                                        <div class="eps_dots more_dropdown">
                                                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <span><i class="uil uil-share-alt"></i>Share</span>
                                                                <span><i class="uil uil-edit-alt"></i>Edit</span>
                                                            </div>
                                                        </div>
                                                        <div class="vdtodt">
                                                            <span class="vdt14">196k views</span>
                                                            <span class="vdt14">1 month ago</span>
                                                        </div>
                                                        <a href="course_detail_view.html" class="crse14s">CSS - The
                                                            Complete Guide 2020 (incl. Flexbox, Grid &amp; Sass)</a>
                                                        <a href="#" class="crse-cate">Design | CSS</a>
                                                        <div class="auth1lnkprce">
                                                            <p class="cr1fot">By <a href="#">John Doe</a></p>
                                                            <div class="prce142">$10</div>
                                                            <button class="shrt-cart-btn" title="cart"><i
                                                                    class="uil uil-shopping-cart-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="fcrse_1 mt-30">
                                                    <a href="course_detail_view.html" class="fcrse_img">
                                                        <img src="images/courses/img-16.jpg" alt="">
                                                        <div class="course-overlay">
                                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                            <div class="crse_timer">
                                                                22 hours
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="fcrse_content">
                                                        <div class="eps_dots more_dropdown">
                                                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <span><i class="uil uil-share-alt"></i>Share</span>
                                                                <span><i class="uil uil-edit-alt"></i>Edit</span>
                                                            </div>
                                                        </div>
                                                        <div class="vdtodt">
                                                            <span class="vdt14">11 Views</span>
                                                            <span class="vdt14">5 Days ago</span>
                                                        </div>
                                                        <a href="course_detail_view.html" class="crse14s">Vue JS 2 - The
                                                            Complete Guide (incl. Vue Router &amp; Vuex)</a>
                                                        <a href="#" class="crse-cate">Development | Vue JS</a>
                                                        <div class="auth1lnkprce">
                                                            <p class="cr1fot">By <a href="#">John Doe</a></p>
                                                            <div class="prce142">$10</div>
                                                            <button class="shrt-cart-btn" title="cart"><i
                                                                    class="uil uil-shopping-cart-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="nav-purchased" role="tabpanel">
                                <div class="_htg451">
                                    <div class="_htg452">
                                        <h3>Purchased Courses</h3>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="fcrse_1 mt-20">
                                                    <a href="course_detail_view.html" class="hf_img">
                                                        <img src="images/courses/img-1.jpg" alt="">
                                                        <div class="course-overlay">
                                                            <div class="badge_seller">Bestseller</div>
                                                            <div class="crse_reviews">
                                                                <i class="uil uil-star"></i>4.5
                                                            </div>
                                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                            <div class="crse_timer">
                                                                25 hours
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="hs_content">
                                                        <div class="eps_dots eps_dots10 more_dropdown">
                                                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <span><i
                                                                        class="uil uil-download-alt"></i>Download</span>
                                                                <span><i class="uil uil-trash-alt"></i>Delete</span>
                                                            </div>
                                                        </div>
                                                        <div class="vdtodt">
                                                            <span class="vdt14">109k views</span>
                                                            <span class="vdt14">15 days ago</span>
                                                        </div>
                                                        <a href="course_detail_view.html"
                                                            class="crse14s title900">Complete Python Bootcamp: Go from
                                                            zero to hero in Python 3</a>
                                                        <a href="#" class="crse-cate">Web Development | Python</a>
                                                        <div class="purchased_badge">Purchased</div>
                                                        <div class="auth1lnkprce">
                                                            <p class="cr1fot">By <a href="#">John Doe</a></p>
                                                            <div class="prce142">$10</div>
                                                            <button class="shrt-cart-btn" title="cart"><i
                                                                    class="uil uil-shopping-cart-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fcrse_1 mt-30">
                                                    <a href="course_detail_view.html" class="hf_img">
                                                        <img src="images/courses/img-2.jpg" alt="">
                                                        <div class="course-overlay">
                                                            <div class="badge_seller">Bestseller</div>
                                                            <div class="crse_reviews">
                                                                <i class="uil uil-star"></i>4.5
                                                            </div>
                                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                            <div class="crse_timer">
                                                                28 hours
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="hs_content">
                                                        <div class="eps_dots eps_dots10 more_dropdown">
                                                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <span><i
                                                                        class="uil uil-download-alt"></i>Download</span>
                                                                <span><i class="uil uil-trash-alt"></i>Delete</span>
                                                            </div>
                                                        </div>
                                                        <div class="vdtodt">
                                                            <span class="vdt14">5M views</span>
                                                            <span class="vdt14">15 days ago</span>
                                                        </div>
                                                        <a href="course_detail_view.html" class="crse14s title900">The
                                                            Complete JavaScript Course 2020: Build Real Projects!</a>
                                                        <a href="#" class="crse-cate">Development | JavaScript</a>
                                                        <div class="purchased_badge">Purchased</div>
                                                        <div class="auth1lnkprce">
                                                            <p class="cr1fot">By <a href="#">Jassica William</a></p>
                                                            <div class="prce142">$5</div>
                                                            <button class="shrt-cart-btn" title="cart"><i
                                                                    class="uil uil-shopping-cart-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fcrse_1 mt-30">
                                                    <a href="course_detail_view.html" class="hf_img">
                                                        <img src="images/courses/img-3.jpg" alt="">
                                                        <div class="course-overlay">
                                                            <div class="badge_seller">Bestseller</div>
                                                            <div class="crse_reviews">
                                                                <i class="uil uil-star"></i>4.5
                                                            </div>
                                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                            <div class="crse_timer">
                                                                12 hours
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="hs_content">
                                                        <div class="eps_dots eps_dots10 more_dropdown">
                                                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <span><i
                                                                        class="uil uil-download-alt"></i>Download</span>
                                                                <span><i class="uil uil-trash-alt"></i>Delete</span>
                                                            </div>
                                                        </div>
                                                        <div class="vdtodt">
                                                            <span class="vdt14">1M views</span>
                                                            <span class="vdt14">18 days ago</span>
                                                        </div>
                                                        <a href="course_detail_view.html"
                                                            class="crse14s title900">Beginning C++ Programming - From
                                                            Beginner to Beyond</a>
                                                        <a href="#" class="crse-cate">Development | C++</a>
                                                        <div class="purchased_badge">Purchased</div>
                                                        <div class="auth1lnkprce">
                                                            <p class="cr1fot">By <a href="#">Joginder Singh</a></p>
                                                            <div class="prce142">$13</div>
                                                            <button class="shrt-cart-btn" title="cart"><i
                                                                    class="uil uil-shopping-cart-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fcrse_1 mt-30">
                                                    <a href="course_detail_view.html" class="hf_img">
                                                        <img src="images/courses/img-4.jpg" alt="">
                                                        <div class="course-overlay">
                                                            <div class="badge_seller">Bestseller</div>
                                                            <div class="crse_reviews">
                                                                <i class="uil uil-star"></i>5.0
                                                            </div>
                                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                            <div class="crse_timer">
                                                                1 hours
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="hs_content">
                                                        <div class="eps_dots eps_dots10 more_dropdown">
                                                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <span><i
                                                                        class="uil uil-download-alt"></i>Download</span>
                                                                <span><i class="uil uil-trash-alt"></i>Delete</span>
                                                            </div>
                                                        </div>
                                                        <div class="vdtodt">
                                                            <span class="vdt14">153k views</span>
                                                            <span class="vdt14">3 months ago</span>
                                                        </div>
                                                        <a href="course_detail_view.html" class="crse14s title900">The
                                                            Complete Digital Marketing Course - 12 Courses in 1</a>
                                                        <a href="#" class="crse-cate">Digital Marketing | Marketing</a>
                                                        <div class="purchased_badge">Purchased</div>
                                                        <div class="auth1lnkprce">
                                                            <p class="cr1fot">By <a href="#">Poonam Verma</a></p>
                                                            <div class="prce142">$12</div>
                                                            <button class="shrt-cart-btn" title="cart"><i
                                                                    class="uil uil-shopping-cart-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-reviews" role="tabpanel">
                                <div class="student_reviews">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="review_right">
                                                <div class="review_right_heading">
                                                    <h3>Discussions</h3>
                                                </div>
                                            </div>
                                            <div class="cmmnt_1526">
                                                <div class="cmnt_group">
                                                    <div class="img160">
                                                        <img src="images/hd_dp.jpg" alt="">
                                                    </div>
                                                    <textarea class="_cmnt001"
                                                        placeholder="Add a public comment"></textarea>
                                                </div>
                                                <button class="cmnt-btn" type="submit">Comment</button>
                                            </div>
                                            <div class="review_all120">
                                                <div class="review_item">
                                                    <div class="review_usr_dt">
                                                        <img src="images/left-imgs/img-1.jpg" alt="">
                                                        <div class="rv1458">
                                                            <h4 class="tutor_name1">John Doe</h4>
                                                            <span class="time_145">2 hour ago</span>
                                                        </div>
                                                        <div class="eps_dots more_dropdown">
                                                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <span><i
                                                                        class='uil uil-comment-alt-edit'></i>Edit</span>
                                                                <span><i class='uil uil-trash-alt'></i>Delete</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="rvds10">Nam gravida elit a velit rutrum, eget dapibus ex
                                                        elementum. Interdum et malesuada fames ac ante ipsum primis in
                                                        faucibus. Fusce lacinia, nunc sit amet tincidunt venenatis.</p>
                                                    <div class="rpt101">
                                                        <a href="#" class="report155"><i class='uil uil-thumbs-up'></i>
                                                            10</a>
                                                        <a href="#" class="report155"><i
                                                                class='uil uil-thumbs-down'></i> 1</a>
                                                        <a href="#" class="report155"><i class='uil uil-heart'></i></a>
                                                        <a href="#" class="report155 ml-3">Reply</a>
                                                    </div>
                                                </div>
                                                <div class="review_reply">
                                                    <div class="review_item">
                                                        <div class="review_usr_dt">
                                                            <img src="images/left-imgs/img-3.jpg" alt="">
                                                            <div class="rv1458">
                                                                <h4 class="tutor_name1">Rock Doe</h4>
                                                                <span class="time_145">1 hour ago</span>
                                                            </div>
                                                            <div class="eps_dots more_dropdown">
                                                                <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                                <div class="dropdown-content">
                                                                    <span><i class='uil uil-trash-alt'></i>Delete</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="rvds10">Fusce lacinia, nunc sit amet tincidunt
                                                            venenatis.</p>
                                                        <div class="rpt101">
                                                            <a href="#" class="report155"><i
                                                                    class='uil uil-thumbs-up'></i> 4</a>
                                                            <a href="#" class="report155"><i
                                                                    class='uil uil-thumbs-down'></i> 2</a>
                                                            <a href="#" class="report155"><i
                                                                    class='uil uil-heart'></i></a>
                                                            <a href="#" class="report155 ml-3">Reply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="nav-subscriptions" role="tabpanel">
                                <div class="_htg451">
                                    <div class="_htg452">
                                        <h3>Subscriptions</h3>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4">
                                                <div class="fcrse_1 mt-30">
                                                    <div class="tutor_img">
                                                        <a href="#"><img src="images/left-imgs/img-1.jpg" alt=""></a>
                                                    </div>
                                                    <div class="tutor_content_dt">
                                                        <div class="tutor150">
                                                            <a href="#" class="tutor_name">John Doe</a>
                                                            <div class="mef78" title="Verify">
                                                                <i class="uil uil-check-circle"></i>
                                                            </div>
                                                        </div>
                                                        <div class="tutor_cate">Wordpress &amp; Plugin Tutor</div>
                                                        <ul class="tutor_social_links">
                                                            <li><button class="sbbc145">Subscribed</button></li>
                                                            <li><button class="sbbc146"><i
                                                                        class="uil uil-bell"></i></button></li>
                                                        </ul>
                                                        <div class="tut1250">
                                                            <span class="vdt15">100K Students</span>
                                                            <span class="vdt15">15 Courses</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="fcrse_1 mt-30">
                                                    <div class="tutor_img">
                                                        <a href="#"><img src="images/left-imgs/img-2.jpg" alt=""></a>
                                                    </div>
                                                    <div class="tutor_content_dt">
                                                        <div class="tutor150">
                                                            <a href="#" class="tutor_name">Kerstin Cable</a>
                                                            <div class="mef78" title="Verify">
                                                                <i class="uil uil-check-circle"></i>
                                                            </div>
                                                        </div>
                                                        <div class="tutor_cate">Language Learning Coach, Writer, Online
                                                            Tutor</div>
                                                        <ul class="tutor_social_links">
                                                            <li><button class="sbbc145">Subscribed</button></li>
                                                            <li><button class="sbbc146"><i
                                                                        class="uil uil-bell"></i></button></li>
                                                        </ul>
                                                        <div class="tut1250">
                                                            <span class="vdt15">14K Students</span>
                                                            <span class="vdt15">11 Courses</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="fcrse_1 mt-30">
                                                    <div class="tutor_img">
                                                        <a href="#"><img src="images/left-imgs/img-3.jpg" alt=""></a>
                                                    </div>
                                                    <div class="tutor_content_dt">
                                                        <div class="tutor150">
                                                            <a href="#" class="tutor_name">Jose Portilla</a>
                                                            <div class="mef78" title="Verify">
                                                                <i class="uil uil-check-circle"></i>
                                                            </div>
                                                        </div>
                                                        <div class="tutor_cate">Head of Data Science, Pierian Data Inc.
                                                        </div>
                                                        <ul class="tutor_social_links">
                                                            <li><button class="sbbc145">Subscribed</button></li>
                                                            <li><button class="sbbc146"><i
                                                                        class="uil uil-bell"></i></button></li>
                                                        </ul>
                                                        <div class="tut1250">
                                                            <span class="vdt15">1M Students</span>
                                                            <span class="vdt15">25 Courses</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="fcrse_1 mt-30">
                                                    <div class="tutor_img">
                                                        <a href="#"><img src="images/left-imgs/img-3.jpg" alt=""></a>
                                                    </div>
                                                    <div class="tutor_content_dt">
                                                        <div class="tutor150">
                                                            <a href="#" class="tutor_name">Jose Portilla</a>
                                                            <div class="mef78" title="Verify">
                                                                <i class="uil uil-check-circle"></i>
                                                            </div>
                                                        </div>
                                                        <div class="tutor_cate">Head of Data Science, Pierian Data Inc.
                                                        </div>
                                                        <ul class="tutor_social_links">
                                                            <li><button class="sbbc145">Subscribed</button></li>
                                                            <li><button class="sbbc146"><i
                                                                        class="uil uil-bell"></i></button></li>
                                                        </ul>
                                                        <div class="tut1250">
                                                            <span class="vdt15">1M Students</span>
                                                            <span class="vdt15">25 Courses</span>
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
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
         // When the "Edit Profile" button is clicked, trigger file input
         document.getElementById('editProfileBtn').addEventListener('click', function () {
             console.log("Edit Profile button clicked!");
             document.getElementById('fileInput').click(); // Open file picker dialog
         });
 
         // Function to handle file input change event
         function previewImage(event) {
             const file = event.target.files[0]; // Get selected file
             const saveButton = d
             profileImage = document.getElementById('profileImage');
             
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
     </script>
@endsection