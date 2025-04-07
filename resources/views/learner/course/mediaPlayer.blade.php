@extends('learner.layout.master')

@section('title')
    Media
@endsection

@section('content_learner')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="video-container">
                    <video controls width="100%" controls controlsList="nodownload">
                        <source src="{{ asset('courseVideo/' . $course_detail->url) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <h2>{{ $course_detail->title }}</h2>
                    <p>{{ $course_detail->discription }}</p>
                </div>
                <a href="{{ route('editor-media', $course_detail->id) }}"><button class="upload_btn">Try with
                        yourself</button></a>
            </div>
        </div>
        @include('learner.layout.footer')
    </div>


    <script>
        $(document).ready(function() {
            let video = document.querySelector(".video-container video");
            let courseAttachmentId = "{{ $course_detail->id }}";
            let userId = "{{ auth()->id() }}";
            let interval;

            function sendTrackingData(eventType) {
                console.log("Sending tracking data:", eventType, "at", video.currentTime);
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
                        console.log("Tracking updated successfully:", response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Tracking error:", xhr.responseText);
                    }
                });
            }

            if (video) {
                video.addEventListener("play", function() {
                    sendTrackingData("play");
                    if (!interval) {
                        interval = setInterval(() => sendTrackingData("progress"),
                        30000); // Every 30 seconds
                    }
                });

                video.addEventListener("pause", function() {
                    sendTrackingData("pause");
                    clearInterval(interval);
                    interval = null;
                });

                video.addEventListener("ended", function() {
                    sendTrackingData("ended");
                    clearInterval(interval);
                    interval = null;
                });

                setInterval(() => {
                    console.log("Video is playing:", !video.paused, "Time:", video.currentTime);
                }, 10000);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            let video = document.querySelector(".video-container video");
            let courseAttachmentId = "{{ $course_detail->id }}";
            let userId = "{{ auth()->id() }}";

            // Fetch Last Progress Time
            $.ajax({
                url: "/get-progress/" + userId + "/" + courseAttachmentId,
                type: "GET",
                success: function(response) {
                    if (response.success) {
                       // alert("Resuming video from: " + response.time);
                        video.currentTime = response.time;
                        console.log("Resuming video from:", response.time);
                    }
                },
                error: function(xhr) {
                    console.error("Error fetching progress:", xhr.responseText);
                }
            });
        });
    </script>
@endsection
