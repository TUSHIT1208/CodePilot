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
                                        <input class="prompt srch_explore form-contol" type="text" name="video_title"
                                            placeholder="Video title" required>
                                        <div class="invalid-feedback">
                                            Please provide a video title.
                                        </div>
                                    </div>
                                    <label class="mt-4">video description*</label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea rows="3" class="form-contol" name="video_discription"
                                                placeholder="Video description" required></textarea>
                                            <div class="invalid-feedback">
                                                Please provide a video description.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12">
                                    <div class="upload-file-dt mt-30">
                                        <div class="upload-btn">
                                            <input class="playlist_video_media" type="file" id="video_play"
                                                name="playlist_video" accept="video/mp4" required>
                                            <label for="video_play" title="Zip">Upload Video</label>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please upload a video file (MP4 format).
                                        </div>
                                        <span class="uploadBtn-main-file">File Format: .mp4</span>
                                        <span class="uploaded-id-preview"></span>
                                    </div>
                                </div>
                                <div class="thumbnail-into mt-5">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <label class="label25 text-left">Course thumbnail*</label>
                                            <div class="thumb-item-preview">
                                                <img src="{{ asset('images/thumbnail-demo.jpg') }}" alt=""
                                                    style="width : 100%;">
                                                <div class="thumb-dt">
                                                    <div class="upload-btn">
                                                        <input class="playlist_thumbnail_media" type="file"
                                                            id="video_thumbnail" name="playlist_thumbnail"
                                                            accept="image/jpg,image/jpeg,image/png" required>
                                                        <label for="video_thumbnail" title="Zip">Choose
                                                            Thumbnail</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please choose a thumbnail image.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="main-btn mt-3" id="submitButton">Save</button>
                        </div>
                    </form>
                </div>

                {{-- @if ($video->isEmpty())
                <div class="no-categories-container text-center fade-in-animation footer mt-5">
                    <i class="uil uil-folder-minus bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                    <h3 class="mt-3 scale-in-text" style="color: #777;">No Video Found</h3>
                    <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                        video yet. Add one now to get started!</p>
                </div> --}}
                {{-- @else --}}
                <div class="col-lg-12 mt-4">
                    <table id="videoTable" class="ucp-table">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Video</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                {{-- @endif --}}
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
    (function () {
        'use strict'

        // Fetch all the forms we want to apply validation styles to
        var forms = document.querySelectorAll('#videoForm')

        // Loop over them and prevent submission if invalid
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()

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
                    $('.uploaded-id-preview').empty();
                    $('.thumb-item-preview img').attr('src',
                        '{{ asset('images/thumbnail-demo.jpg') }}');
                    $('#videoTable').DataTable().ajax.reload(); // Reload the video table
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
            columns: [{
                data: 'thumbnail_url',
                name: 'thumbnail_url'
            },
            {
                data: 'video_url',
                name: 'video_url'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
            ]
        });

        // Handle Delete Video Click Event
        $(document).on('click', '.deleteVideo', function () {
            let videoId = $(this).data('id');
            if (confirm('Are you sure you want to delete this video?')) {
                $.ajax({
                    url: '{{ route('video.destroy', '') }}/' + videoId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.success, 'Success');
                            $('#videoTable').DataTable().ajax.reload();
                        } else {
                            toastr.error('Failed to delete the video!', 'Error');
                        }
                    },
                    error: function (xhr) {
                        toastr.error('Something went wrong!', 'Error');
                    }
                });
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Video Preview
        document.getElementById("video_play").addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const videoPreview = document.createElement("video");
                videoPreview.src = URL.createObjectURL(file);
                videoPreview.controls = true;
                videoPreview.style.maxWidth = "50%";
                videoPreview.style.height = "auto";

                const previewContainer = document.querySelector(".uploaded-id-preview");
                previewContainer.innerHTML = "";
                previewContainer.appendChild(videoPreview);
            }
        });

        // Thumbnail Preview
        document.getElementById("video_thumbnail").addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector(".thumb-item-preview img").src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>