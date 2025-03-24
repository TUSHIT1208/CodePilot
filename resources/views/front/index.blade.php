@extends('front.layout.master')

@section('title')
    Index
@endsection

@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

            <div class="container">
                <h2 data-aos="fade-up" data-aos-delay="100">Learning Today,<br>Leading Tomorrow</h2>
                {{-- <p data-aos="fade-up" data-aos-delay="200">We are team of talented designers making websites with
                    Bootstrap</p> --}}
                <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('course') }}" class="btn-get-started">Get Started</a>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                        <img src="assets/img/about.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                        <h2>CodePilot</h2>
                        <p class="fst-italic">

                            CodePilot is an online coding education platform that enables users to learn, code, and debug in
                            real-time while
                            watching instructional videos.
                            This platform is free to explore, offering a simple and effective
                            way to enhance coding
                            skills through interactive learning.
                        <p>
                            A Stage to Learn, Code, and Grow with CodePilot, users can practice coding while watching
                            videos, ensuring a hands-on
                            learning experience.
                            The platform supports learners in developing coding skills and gaining
                            expertise through real-time
                            debugging and practical exercises.
                        <p>
                            CodePilot is more than just a coding platform. It provides a structured learning path designed
                            to guide learners from
                            beginner to advanced levels in Front-End, Back-End, and Full-Stack Development.
                        <p>
                            After completing a course, learners can take tests to check their knowledge. If they pass, they
                            get a certificate, which
                            they can use to showcase their skills.
                        </p>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Counts Section -->
        <section id="counts" class="section counts light-background">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $learnerCount }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Students</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-4 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $courseCount }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Courses</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-4 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="{{ $instructorCount }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Trainers</p>
                        </div>
                    </div><!-- End Stats Item -->

                </div>

            </div>

        </section><!-- /Counts Section -->

        <!-- Why Us Section -->
        <section id="why-us" class="section why-us">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="why-box">
                            <h3>Why Choose Our Courses?</h3>
                            <p>
                                Courses is Stage to Learn, Code, and Grow with CodePilot, users can practice coding while
                                watching videos, ensuring a hands-on
                                learning experience. The platform supports learners in developing coding skills and gaining
                                expertise through real-time
                                debugging and practical exercises.

                            </p>
                        </div>
                    </div><!-- End Why Box -->

                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

                            <div class="col-xl-4">
                                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                    <i class="bi bi-clipboard-data"></i>
                                    <h4>Test</h4>
                                    <p>learners can take tests to check their knowledge. If they pass, they get a
                                        certificate, which
                                        they can use to showcase their skills.
                                    </p>
                                </div>
                            </div><!-- End Icon Box -->

                            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                    <i class="bi bi-gem"></i>
                                    <h4>Subscribtion</h4>
                                    <p>A subscription can be either paid or free, depending on the user's preference. Users
                                        can choose a course based on their
                                        needs and availability.</p>
                                </div>
                            </div><!-- End Icon Box -->

                            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                    <i class="bi bi-inboxes"></i>
                                    <h4>Learning Path</h4>
                                    <p>learning path designed to guide learners from beginner to advanced levels in
                                        Front-End, Back-End, and Full-Stack
                                        Development.</p>
                                </div>
                            </div><!-- End Icon Box -->

                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Why Us Section -->

        <!-- Features Section -->
        {{-- <section id="features" class="features section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="features-item">
                            <i class="bi bi-eye" style="color: #ffbb2c;"></i>
                            <h3><a href="" class="stretched-link">Lorem Ipsum</a></h3>
                        </div>
                    </div><!-- End Feature Item -->

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="features-item">
                            <i class="bi bi-infinity" style="color: #5578ff;"></i>
                            <h3><a href="" class="stretched-link">Dolor Sitema</a></h3>
                        </div>
                    </div><!-- End Feature Item -->

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="features-item">
                            <i class="bi bi-mortarboard" style="color: #e80368;"></i>
                            <h3><a href="" class="stretched-link">Sed perspiciatis</a></h3>
                        </div>
                    </div><!-- End Feature Item -->

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="features-item">
                            <i class="bi bi-nut" style="color: #e361ff;"></i>
                            <h3><a href="" class="stretched-link">Magni Dolores</a></h3>
                        </div>
                    </div><!-- End Feature Item -->

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="500">
                        <div class="features-item">
                            <i class="bi bi-shuffle" style="color: #47aeff;"></i>
                            <h3><a href="" class="stretched-link">Nemo Enim</a></h3>
                        </div>
                    </div><!-- End Feature Item -->

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="600">
                        <div class="features-item">
                            <i class="bi bi-star" style="color: #ffa76e;"></i>
                            <h3><a href="" class="stretched-link">Eiusmod Tempor</a></h3>
                        </div>
                    </div><!-- End Feature Item -->

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="700">
                        <div class="features-item">
                            <i class="bi bi-x-diamond" style="color: #11dbcf;"></i>
                            <h3><a href="" class="stretched-link">Midela Teren</a></h3>
                        </div>
                    </div><!-- End Feature Item -->

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="800">
                        <div class="features-item">
                            <i class="bi bi-camera-video" style="color: #4233ff;"></i>
                            <h3><a href="" class="stretched-link">Pira Neve</a></h3>
                        </div>
                    </div><!-- End Feature Item -->

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="900">
                        <div class="features-item">
                            <i class="bi bi-command" style="color: #b2904f;"></i>
                            <h3><a href="" class="stretched-link">Dirada Pack</a></h3>
                        </div>
                    </div><!-- End Feature Item -->

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="1000">
                        <div class="features-item">
                            <i class="bi bi-dribbble" style="color: #b20969;"></i>
                            <h3><a href="" class="stretched-link">Moton Ideal</a></h3>
                        </div>
                    </div><!-- End Feature Item -->

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="1100">
                        <div class="features-item">
                            <i class="bi bi-activity" style="color: #ff5828;"></i>
                            <h3><a href="" class="stretched-link">Verdo Park</a></h3>
                        </div>
                    </div><!-- End Feature Item -->

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="1200">
                        <div class="features-item">
                            <i class="bi bi-brightness-high" style="color: #29cc61;"></i>
                            <h3><a href="" class="stretched-link">Flavor Nivelanda</a></h3>
                        </div>
                    </div><!-- End Feature Item -->

                </div>

            </div>

        </section><!-- /Features Section --> --}}

        <!-- Courses Section -->

        <section id="courses" class="courses section">
            <a href="{{route('login')}}">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Courses</h2>
                    <p>Popular Courses</p>
                </div><!-- End Section Title -->
                <div class="container">
                    <div class="row">
                        @foreach($courses as $courseItem)
                            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                                data-aos-delay="100">
                                <div class="mt-5">
                                    <img src="{{ isset($courseItem->thumbnail_url) && $courseItem->thumbnail_url != null ? asset('courseThumbnail/' . $courseItem->thumbnail_url) : asset('images/courses/img-2.jpg') }}"
                                        alt="Course Thumbnail" class="thumbnail-course">

                                    <div class="course-content">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <p class="category">{{ $courseItem->title}}</p>
                                            <p class="price">{{ $courseItem->price == 0 ? 'FREE' : '₹' . $courseItem->price }}
                                            </p>
                                        </div>

                                        {{-- <h3><a href="{{ route('course.details', ['id' => $courseItem->id]) }}">{{
                                                $courseItem->title }}</a>
                                        </h3> --}}
                                        <p class="description">{{ Str::limit($courseItem->category->name, 100) }}</p>
                                        <p class="description">{{ Str::limit($courseItem->description, 100) }}</p>
                                        <div class="trainer d-flex justify-content-between align-items-center">
                                            <div class="trainer-profile d-flex align-items-center">
                                                <!-- Check if user has a profile photo, fall back to a default one -->
                                                @if(!empty($courseItem->user->profile_picture_url))
                                                    <img id="profile_picture"
                                                        src="{{  asset($courseItem->user->profile_picture_url) }}">
                                                @else
                                                    <h1 id="default_avtar">{{ substr($courseItem->user->first_name, 0, 1) }}</h1>
                                                @endif
                                                {{-- <img
                                                    src="{{ isset($courseItem->user->profile_picture_url) && $courseItem->user->profile_picture_url != null ? asset($courseItem->user->profile_picture_url) : 'https://via.placeholder.com/150/0000FF/808080?Text=' . strtoupper(substr($courseItem->user->first_name, 0, 1)) }}"
                                                    class="img-fluid small-logo" alt="User Photo"> --}}


                                                <!-- Display the user's name -->
                                                <a href="{{ route('user.learner_show', $courseItem->user->id) }}"
                                                    class="trainer-link">
                                                    {{ $courseItem->user->first_name }} {{ $courseItem->user->last_name }}
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Course Item-->

                        @endforeach

                    </div>

            </a>

        </section><!-- /Courses Section -->

        <!-- Trainers Index Section -->
        {{-- <section id="trainers-index" class="section trainers-index">

            <div class="container">

                <div class="row">

                    <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt="">
                            <div class="member-content">
                                <h4>Walter White</h4>
                                <span>Web Development</span>
                                <p>
                                    Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis
                                    quaerat qui aut aut aut
                                </p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                            <img src="assets/img/trainers/trainer-2.jpg" class="img-fluid" alt="">
                            <div class="member-content">
                                <h4>Sarah Jhinson</h4>
                                <span>Marketing</span>
                                <p>
                                    Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto
                                    rerum rerum temporibus
                                </p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="member">
                            <img src="assets/img/trainers/trainer-3.jpg" class="img-fluid" alt="">
                            <div class="member-content">
                                <h4>William Anderson</h4>
                                <span>Content</span>
                                <p>
                                    Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et
                                    laborum toro des clara
                                </p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                </div>

            </div>

        </section><!-- /Trainers Index Section --> --}}

    </main>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>
@endsection