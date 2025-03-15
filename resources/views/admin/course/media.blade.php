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
                        <input type="hidden" name="type" id="fileType" value="video">

                        <div class="mp4 intro-box" style="display: block;">
                            <div class="row">
                                <div class="ui search focus mt-30 lbel25">
                                    <label for="title-field">Video Title*</label>
                                    <div class="ui left icon">
                                        <input type="text" name="video_title" id="meta_keyword-field"
                                            class="prompt srch_explore form-control"
                                            placeholder="Course meta keyword here" required>
                                        <div class="invalid-feedback">Video Title is required.</div>
                                    </div>

                                    <label class="mt-4">Video Description*</label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea rows="3" class="form-control" name="video_discription" placeholder="Video description" required></textarea>
                                            <div class="invalid-feedback">
                                                The video Description is required.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5 col-md-12 mt-2">
                                    <label class="mt-4" style="color: white;">Upload File*</label>
                                    <div class="upload-file-dt mt-2">
                                        <div class="upload-btn">
                                            <input class="playlist_media" type="file" id="file_upload"
                                                name="playlist_file" accept=".mp4,.pdf,.doc,.docx" required>
                                            <label for="file_upload">Upload File</label>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please upload a valid file (MP4, PDF, DOC, DOCX).
                                        </div>
                                        <span class="uploadBtn-main-file">Allowed Formats: .mp4, .pdf, .doc,
                                            .docx</span>
                                        <span class="uploaded-id-preview"></span>
                                    </div>
                                </div>

                                <div class="thumbnail-into mt-5">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <label class="label25 text-left">Course Thumbnail*</label>
                                            <div class="thumb-item-preview" style="background-color: #333 !important;">
                                                <img src="{{ asset('images/thumbnail-demo.jpg') }}" alt=""
                                                    style="width : 100%;">
                                                <div class="thumb-dt text-center">
                                                    <div class="upload-btn">
                                                        <input class="playlist_thumbnail_media" type="file"
                                                            id="video_thumbnail" name="playlist_thumbnail"
                                                            accept="image/jpg,image/jpeg,image/png" required>
                                                        <label for="video_thumbnail">Choose Thumbnail</label>
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

                <div class="col-lg-12 mt-4"
                    style="background-color: #333 !important; border-radius: 10px; padding: 2%;">
                    <table id="videoTable" class="ucp-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Discription</th>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Set global Toastr options
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "5000",
            "extendedTimeOut": "2000",
            "positionClass": "toast-top-right",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "onShown": function() {
                $('.toast-success').css({
                    'background-color': '#28a745', // Green for success
                    'opacity': '1' // Adjust opacity
                });
                $('.toast-error').css({
                    'background-color': '#dc3545', // Red for error
                    'opacity': '1'
                });
                $('.toast-warning').css({
                    'background-color': '#ffc107', // Yellow for warning
                    'opacity': '1'
                });
                $('.toast-info').css({
                    'background-color': '#17a2b8', // Blue for info
                    'opacity': '1'
                });
            }
        };

        $('#file_upload').on('change', function() {
            var file = this.files[0];
            if (file) {
                var fileType = file.type;
                if (fileType.includes("video")) {
                    $('#fileType').val('video');
                } else {
                    $('#fileType').val('document');
                }
            }
        });

        $('#submitVideoButton').on('click', function(event) {
            var form = document.getElementById('videoForm');
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }
            var formData = new FormData(form);

            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000",
                "extendedTimeOut": "2000",
                "positionClass": "toast-top-right",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "timeOut": "2000",
                "onShown": function() {
                    $('.toast-success').css({
                        'background-color': '#28a745',
                        'opacity': '1'
                    });
                    $('.toast-error').css({
                        'background-color': '#dc3545',
                        'opacity': '1'
                    });
                    $('.toast-warning').css({
                        'background-color': '#ffc107',
                        'opacity': '1'
                    });
                    $('.toast-info').css({
                        'background-color': '#17a2b8',
                        'opacity': '1'
                    });
                }
            };

            $.ajax({
                url: "{{ route('courseAttachment.store') }}",
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
                    $('#videoTable').DataTable().ajax.reload();
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
        // Set global Toastr options
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "5000",
            "extendedTimeOut": "2000",
            "positionClass": "toast-top-right",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "onShown": function() {
                $('.toast-success').css({
                    'background-color': '#28a745', // Green for success
                    'opacity': '1' // Adjust opacity
                });
                $('.toast-error').css({
                    'background-color': '#dc3545', // Red for error
                    'opacity': '1'
                });
                $('.toast-warning').css({
                    'background-color': '#ffc107', // Yellow for warning
                    'opacity': '1'
                });
                $('.toast-info').css({
                    'background-color': '#17a2b8', // Blue for info
                    'opacity': '1'
                });
            }
        };
        var courseId = $('input[name="course_id"]').val();

        $('#videoTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('courseAttachment.index') }}',
                data: {
                    course_id: courseId
                }
            },
            columns: [{
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'discription',
                    name: 'discription'
                },
                {
                    data: 'url',
                    name: 'url'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Handle Delete Click Event with Swal.fire
        $(document).on('click', '.deleteAttachment', function() {
            let attachmentId = $(this).data('id');
            let attachmentType = $(this).data('type'); // Get type: video or document

            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this ' + attachmentType +
                    '. This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('courseAttachment.destroy', '') }}/' +
                            attachmentId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                let successMessage = attachmentType === 'video' ?
                                    'Video deleted successfully!' :
                                    'Document deleted successfully!';
                                toastr.success(successMessage, 'Success');
                                $('#videoTable').DataTable().ajax.reload();
                            } else {
                                toastr.error('Failed to delete the ' +
                                    attachmentType + '!', 'Error');
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
        // File Preview (Video or Document)
        document.getElementById("file_upload").addEventListener("change", function(event) {
            const file = event.target.files[0];
            const previewContainer = document.querySelector(".uploaded-id-preview");

            if (file) {
                const fileType = file.type;
                previewContainer.innerHTML = ""; // Clear any existing preview

                if (fileType.includes("video")) {
                    const videoPreview = document.createElement("video");
                    videoPreview.src = URL.createObjectURL(file);
                    videoPreview.controls = true;
                    videoPreview.style.maxWidth = "50%";
                    videoPreview.style.height = "auto";
                    previewContainer.appendChild(videoPreview);
                } else if (fileType === "application/pdf") {
                    const pdfPreview = document.createElement("iframe");
                    pdfPreview.src = URL.createObjectURL(file);
                    pdfPreview.width = "100%";
                    pdfPreview.height = "400px";
                    previewContainer.appendChild(pdfPreview);
                } else if (fileType === "application/msword" ||
                    fileType ===
                    "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
                    const docMessage = document.createElement("p");
                    docMessage.textContent = "Document uploaded: " + file.name;
                    previewContainer.appendChild(docMessage);
                } else {
                    alert("Unsupported file format!");
                }
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
