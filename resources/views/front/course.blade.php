@extends('front.layout.master')

@section('title')
    Courses
@endsection

@section('content')

    <main class="main">
        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Courses</h1>
                            <p class="mb-0">A course is a structured program of study on a specific subject, typically
                                offered by schools, universities, or online
                                platforms. Courses can be short or long and may include lectures, assignments, exams, and
                                practical exercises.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li class="current">Courses</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Courses Section -->
        <section id="courses" class="courses section">
            <a href="">
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
                                                    <h1 class="default_avtar">{{ substr($courseItem->user->first_name, 0, 1) }}</h1>
                                                @endif
                                                {{-- <img
                                                    src="{{ isset($courseItem->user->profile_picture_url) && $courseItem->user->profile_picture_url != null ? asset($courseItem->user->profile_picture_url) : 'https://via.placeholder.com/150/0000FF/808080?Text=' . strtoupper(substr($courseItem->user->first_name, 0, 1)) }}"
                                                    class="img-fluid small-logo" alt="User Photo"> --}}

                                                <!-- Display the user's name -->
                                                <h4>
                                                    {{ $courseItem->user->first_name }} {{ $courseItem->user->last_name }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Course Item-->
                        @endforeach
                    </div>

                </div>
            </a>
        </section><!-- /Courses Section -->

    </main>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>
@endsection