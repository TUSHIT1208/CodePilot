@extends('front.layout.master')

@section('title')
    About
@endsection

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>About Us<br></h1>
                            <p class="mb-0">Welcome to CodePilot, your go-to platform for high-quality courses designed to
                                help you learn, grow, and
                                achieve your goals. Whether you're looking for free or paid courses, we provide a wide range
                                of options tailored to your
                                needs.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li class="current">About Us<br></li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- About Us Section -->
        <section id="about-us" class="section about-us">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                        <img src="assets/img/about-2.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                        <h3>Our Mission</h3>
                        At CodePilot, we believe that learning should be accessible, flexible, and engaging. Our goal is to
                        empower learners
                        with expertly crafted courses that enhance knowledge, improve skills, and drive career growth.
                        <h3 class="mt-2">Why Choose CodePilot?</h3>

                        <ul>
                            <li><i class="bi bi-check-circle"></i> <span>Diverse Course Selection - Covering programming,
                                    design, business, and more.</li>
                            <li><i class="bi bi-check-circle"></i> <span>Learn at Your Own Pace - Study anytime,
                                    anywhere.</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Expert Instructors - Industry professionals sharing
                                    real-world knowledge.</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Affordable & Free Options - Choose the best
                                    learning path for you.</span></li>

                        </ul>
                        <p class="fst-italic">
                            At CodePilot, we are committed to making learning accessible, flexible, and impactful. Whether
                            you're looking to
                            enhance your skills, start a new career, or simply explore new subjects, our expertly designed
                            courses are here to guide
                            you. Join us today and take charge of your learning journey with confidence!
                        </p>
                    </div>

                </div>

            </div>

        </section><!-- /About Us Section -->

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

        @if ($reviews->isNotEmpty())
            <section id="testimonials" class="testimonials section">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Testimonials</h2>
                    <p>What are they saying</p>
                </div><!-- End Section Title -->
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper init-swiper">
                        <script type="application/json" class="swiper-config">
                            {
                              "loop": true,
                              "speed": 600,
                              "autoplay": { "delay": 5000 },
                              "slidesPerView": "auto",
                              "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                              },
                              "breakpoints": {
                                "320": { "slidesPerView": 1, "spaceBetween": 40 },
                                "1200": { "slidesPerView": 2, "spaceBetween": 20 }
                              }
                            }
                        </script>
                        <div class="swiper-wrapper">
                            @foreach ($reviews as $review)
                                <div class="swiper-slide">
                                    <div class="testimonial-wrap">
                                        <div class="testimonial-item">
                                            {{-- <img src="{{ asset('assets/img/default-user.png') }}" class="testimonial-img" alt=""> --}}
                                            @if (!empty($review->user->profile_picture_url))
                                                <img class="testimonial-img"
                                                    src="{{ asset($review->user->profile_picture_url) }}">
                                            @else
                                                <div class=" testimonial-img thumbnail bg-danger text-white d-flex align-items-center justify-content-center"
                                                    style="width: 90px; height: 69px; font-size: 35px;">
                                                    {{ strtoupper(substr($review->user->first_name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <h3>{{ $review->user->first_name . $review->user->last_name }}</h3>
                                            <h4>Course : {{ $review->course->title }}</h4>
                                            <div class="stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                                @endfor
                                            </div>
                                            <p>
                                                <i class="bi bi-quote quote-icon-left"></i>
                                                <span>{{ $review->review }}</span>
                                                <i class="bi bi-quote quote-icon-right"></i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

            </section><!-- /Testimonials Section -->
        @endif

    </main>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>
@endsection
