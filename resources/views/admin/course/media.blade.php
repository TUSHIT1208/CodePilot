<div class="step-tab-panel step-tab-location" id="tab_step3">
    <div class="tab-from-content">
        <div class="title-icon">
            <h3 class="title"><i class="uil uil-image"></i>Media</h3>
        </div>
        <div class="lecture-video-dt mb-30">
            <div class="row">
                <!-- Video Upload Form (Left Section) -->
                <div class="col-lg-8">
                    <form id="videoForm" action="{{ route('video.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($course))
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                        @endif
                        <div class="mp4 intro-box" style="display: block;">
                            <div class="row">
                                <div class="ui search focus mt-30 lbel25">
                                    <label class="mt-4">video title*</label>
                                    <div class="ui left icon input swdh19">
                                        <input class="prompt srch_explore" type="text" name="video_title"
                                            placeholder="Video title" required>
                                    </div>
                                    <label class="mt-4">video description*</label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea rows="3" name="video_discription" placeholder="Video description"
                                                required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12">
                                    <div class="upload-file-dt mt-30">
                                        <div class="upload-btn">
                                            <input class="uploadBtn-main-input" type="file"
                                                id="IntroFile__input--source" name="playlist_video" accept="video/mp4"
                                                required>
                                            <label for="IntroFile__input--source" title="Zip">Upload Video</label>
                                        </div>
                                        <span class="uploadBtn-main-file">File Format: .mp4</span>
                                        <span class="uploaded-id"></span>
                                    </div>
                                </div>
                                <div class="thumbnail-into mt-5">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <label class="label25 text-left">Course thumbnail*</label>
                                            <div class="thumb-item">
                                                <img src="{{ asset('images/thumbnail-demo.jpg') }}" alt="">
                                                <div class="thumb-dt">
                                                    <div class="upload-btn">
                                                        <input class="uploadBtn-main-input" type="file"
                                                            id="ThumbFile__input--source" name="playlist_thumbnail"
                                                            accept="image/jpg,image/jpeg,image/png" required>
                                                        <label for="ThumbFile__input--source" title="Zip">Choose
                                                            Thumbnail</label>
                                                    </div>
                                                    <span class="uploadBtn-main-file">Size: 590x300 pixels. Supports:
                                                        jpg,jpeg, or png</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="main-btn mt-3" id="submitButton">Save</button>
                        </div>
                    </form>
                </div>

                <!-- Video List (Right Section) -->
                <div class="col-lg-4">
                    <table id="videoTable" class="ucp-table">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Video</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="mt-5 row">
                <div class="col-lg-6">
                    @if (request()->route('course'))
                        <a href="{{ route('course.edit', ['course' => request()->route('course')]) }}" class="upload_btn">
                            Previous
                        </a>
                    @endif
                </div>
                <div class="col-lg-6 text-end">
                    <button id="media_next" class="main-btn">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#videoForm').on('submit', function (event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.success, 'Success');
                    } else {
                        toastr.error('Something went wrong!', 'Error');
                    }

                    $('#videoForm')[0].reset();
                    $('.uploaded-id').empty();
                    $('.thumb-item img').attr('src', '{{ asset('images/thumbnail-demo.jpg') }}');
                },
                error: function (xhr) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#videoTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('video.index') }}',
            columns: [
                {
                    data: 'thumbnail_url',
                    name: 'thumbnail_url',
                },
                {
                    data: 'video_url',
                    name: 'video_url',
                }
            ]
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Video Preview
        document.getElementById("IntroFile__input--source").addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const videoPreview = document.createElement("video");
                videoPreview.src = URL.createObjectURL(file);
                videoPreview.controls = true;
                videoPreview.style.maxWidth = "50%";
                videoPreview.style.height = "auto";

                const previewContainer = document.querySelector(".uploaded-id");
                previewContainer.innerHTML = "";
                previewContainer.appendChild(videoPreview);
            }
        });

        // Thumbnail Preview
        document.getElementById("ThumbFile__input--source").addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector(".thumb-item img").src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>