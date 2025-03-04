<div class="step-tab-panel step-tab-location" id="tab_step3">
    <div class="tab-from-content">
        <div class="title-icon">
            <h3 class="title"><i class="uil uil-image"></i>Media</h3>
        </div>
        <div class="lecture-video-dt mb-30">
            <div class="row">
                <!-- Video Upload Form (Left Section) -->
                <div class="col-lg-12">
                    <form id="videoForm" enctype="multipart/form-data">
                        @csrf
                        @if (isset($course))
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                        @endif
                        <div class="mp4 intro-box" style="display: block;">
                            <div class="row">
                                <div class="ui search focus mt-30 lbel25">
                                    <label for="title-field">Video Title*</label>
                                    <div class="ui left icon">
                                        <input type="text" name="video_title" id="meta_keyword-field"  
                                               class="prompt srch_explore form-control"  
                                               placeholder="Course meta keyword here"   
                                               required>
                                        <div class="invalid-feedback">Video Title is required.</div>
                                    </div>


                                    <label class="mt-4">Video Description*</label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea rows="3" class="form-control" name="video_discription" placeholder="Video description" required></textarea>
                                            <div class="invalid-feedback">
                                                The video Discription is required.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="mt-4">Video Upload*</label>
                                <div class="col-lg-5 col-md-12 mt-2">
                                    <div class="upload-file-dt">
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
                                            <label class="label25 text-left">Course Thumbnail*</label>
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
                            <button type="button" class="main-btn mt-3" id="submitVideoButton">Save</button>
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
                                <th>video title</th>
                                <th>video Discription</th>
                                <th>Video</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                {{-- @endif --}}
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#submitVideoButton').on('click', function(event) {

            var form = document.getElementById('videoForm')
            if (!form.checkValidity()) {

                form.classList.add('was-validated')
                return;
            }
            var formData = new FormData(form);

            $.ajax({
                url: "{{ route('video.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
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
                error: function(xhr) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#videoTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('video.index') }}',
            columns: [{
                    data: 'video_title',
                    name: 'video_title'
                },
                {
                    data: 'description',
                    name: 'description'
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

        // Handle Delete Video Click Event with Swal.fire
        $(document).on('click', '.deleteVideo', function() {
            let videoId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this video. This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send the delete request via AJAX
                    $.ajax({
                        url: '{{ route('video.destroy', '') }}/' + videoId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.success, 'Success');
                                $('#videoTable').DataTable().ajax.reload();
                            } else {
                                toastr.error('Failed to delete the video!',
                                'Error');
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Something went wrong!', 'Error');
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Video Preview
        document.getElementById("video_play").addEventListener("change", function(event) {
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
        document.getElementById("video_thumbnail").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector(".thumb-item-preview img").src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
