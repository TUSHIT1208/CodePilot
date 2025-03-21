@extends('admin.layouts.master')

@section('title')
    Code Debugger
@endsection

@section('content')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
<<<<<<< HEAD
                {{-- <a href="{{ route('course.show',$course_detail->course_id) }}"><button class="main-btn">Back to Course</button></a> --}}
=======
                <a href="{{ route('course.show', $course_detail->course_id) }}"><button class="main-btn">Back to
                        Course</button></a>
>>>>>>> d0963a6947b685594484da7936e8c664fa721f02
                <div style="display: flex; gap: 20px;" class="mt-4">
                    <div style="flex: 1;">
                        <div class="video-container">
                            <video controls width="100%">
                                <source src="{{ asset('courseVideo/' . $course_detail->url) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <h2>{{ $course_detail->title }}</h2>
                            <p>{{ $course_detail->discription }}</p>
                        </div>
                    </div>
                    <div style="flex: 1;">
<<<<<<< HEAD
                        @if($title->title == "Python")
                        <iframe id="code-iframe" src="https://onecompiler.com/embed/python" width="100%" height="500px"
                            frameborder="0" allowfullscreen>
                        </iframe>
                        @elseif($title->title == "Php")
                        <iframe id="code-iframe" src="https://onecompiler.com/embed/php" width="100%" height="500px"
                            frameborder="0" allowfullscreen>
                        </iframe>
                        @elseif($title->title == "Html")
                        <iframe id="code-iframe" src="https://onecompiler.com/embed/html" width="100%" height="500px"
                            frameborder="0" allowfullscreen>
                        </iframe>
=======
                        @if ($title->title === 'Python')
                            <iframe id="code-iframe" src="https://onecompiler.com/embed/python" width="100%"
                                height="500px" frameborder="0" allowfullscreen>
                            </iframe>
                        @elseif($title->title === 'Php')
                            <iframe id="code-iframe" src="https://onecompiler.com/embed/php" width="100%" height="500px"
                                frameborder="0" allowfullscreen>
                            </iframe>
                        @elseif($title->title === 'Html')
                            <iframe id="code-iframe" src="https://onecompiler.com/embed/html" width="100%" height="500px"
                                frameborder="0" allowfullscreen>
                            </iframe>
                        @else
                        <iframe id="code-iframe" src="https://onecompiler.com/embed/python" width="100%"
                                height="500px" frameborder="0" allowfullscreen>
                            </iframe>
>>>>>>> d0963a6947b685594484da7936e8c664fa721f02
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
