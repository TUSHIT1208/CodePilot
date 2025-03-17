@extends('learner.layout.master')

@section('title')
    Code Debugger
@endsection

@section('content_learner')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <a href="{{ route('course.show', $course_detail->course_id) }}"><button class="main-btn">Back to
                        Course</button></a>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let video = document.querySelector(".video-container video");
            let courseAttachmentId = "{{ $course_detail->id }}";
            let userId = "{{ auth()->id() }}";
            let interval;

            function sendTrackingData(eventType) {
                $.ajax({
                    url: "{{ route('video.progress.track') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: userId,
                        course_attachment_id: courseAttachmentId,
                        current_time: video.currentTime,
                        created_by: userId,
                        event: eventType
                    },
                    success: function(response) {
                        console.log("Tracking updated:", response);
                    },
                    error: function(error) {
                        console.error("Tracking error:", error);
                    }
                });
            }

            if (video) {
                video.addEventListener("play", function() {
                    sendTrackingData("play");
                    interval = setInterval(() => sendTrackingData("progress"), 30000);
                });

                video.addEventListener("pause", function() {
                    sendTrackingData("pause");
                    clearInterval(interval);
                });

                video.addEventListener("ended", function() {
                    sendTrackingData("ended");
                    clearInterval(interval);
                });
            }
        });
    </script>
@endsection
