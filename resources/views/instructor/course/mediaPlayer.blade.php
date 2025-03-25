@extends('instructor.layouts.master')

@section('title')
    View saved course
@endsection

@section('content')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="video-container">
                    <video controls width="100%">
                        <source src="{{ asset('courseVideo/' . $course_detail->url) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <h2>{{ $course_detail->title }}</h2>
                    <p>{{ $course_detail->discription }}</p>
                </div>
                <a href="{{ route('editor-media',$course_detail->id) }}"><button class="upload_btn">Try with yourself</button></a>
            </div>
        </div>
        @include('instructor.layouts.footer')
    </div>
@endsection
