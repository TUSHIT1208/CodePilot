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
                                        <input type="text" name="video_title" id="title-field"
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
                                            <div class="thumb-item-preview">
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
                    <div class="attachments-section">
                        <div id="attachmentsList"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="loader-overlay" id="loader">
        <div class="loader"></div>
    </div>

</div>

<script>
    $(document).ready(function() {
        // Set global Toastr options
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "2000",
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
            $('#loader').show();
            $('.tab-from-content').addClass('blurred');
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": "2000",
                "extendedTimeOut": "2000",
                "positionClass": "toast-top-right",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
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
                },
                complete: function() {
                    // 👉 Hide loader and remove blur
                    $('#loader').hide();
                    $('.tab-from-content').removeClass('blurred');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
    function loadAttachments() {
        var courseId = $('input[name="course_id"]').val();
        $.ajax({
            url: `/course/${courseId}/attachments`,
            type: 'GET',
            success: function (response) {
                var attachmentsContainer = $("#attachmentsList");
                attachmentsContainer.empty(); // Clear previous content

                if (response.length === 0) {
                    attachmentsContainer.append(`
                        <div class="text-center fade-in-animation footer mt-3">
                            <i class="uil uil-folder-minus bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                            <h3 class="mt-3 scale-in-text" style="color: #777;">No content Found</h3>
                            <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any content yet. Add one now to get started!</p>
                        </div>
                    `);
                    return;
                }

                response.forEach(attachment => {
                    var fileType = attachment.url.split('.').pop().toLowerCase();
                    var fileUrl = `/courseVideo/${attachment.url}`; // Ensure correct path
                    var previewElement = '';

                    if (fileType === 'mp4') {
                        previewElement = `
                            <a href="/codeDebugger/${attachment.id}" class="hf_img relative block">
                                <img src="/courseThumbnail/${attachment.thumbnail_url}" alt="${attachment.video_title}" class="w-full rounded-lg">
                                <div class="course-overlay absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 flex flex-col justify-end p-4 rounded-lg">
                                    <span class="play_btn1 text-white text-2xl"><i class="uil uil-play"></i></span>
                                </div>
                            </a>
                            <video id="temp-video-${attachment.id}" style="display:none;">
                                <source src="${fileUrl}" type="video/mp4">
                            </video>
                        `;
                    } else if (fileType === 'pdf') {
                        previewElement = `
                            <a href="/courseAssignments/${attachment.url}" target="_blank" class="hf_img">
                                <div class="pdf-thumbnail bg-gray-200 flex items-center justify-center rounded-2xl h-40">
                                    <img src="/images/PDF_file_icon.svg.webp" alt="PDF Document" class="w-24">
                                </div>
                            </a>
                            <div class="eps_dots eps_dots10 more_dropdown relative">
                                <i class="uil uil-ellipsis-v text-lg cursor-pointer"></i>
                                <div class="dropdown-content hidden absolute bg-white shadow-lg rounded-lg p-2">
                                    <a href="/courseAssignments/${attachment.url}" download="${attachment.title}" class="bg-blue-500 text-white px-4 py-2 rounded-2xl">Download</a>
                                </div>
                            </div>
                        `;
                    } else {
                        previewElement = `<a href="${fileUrl}" target="_blank">Download File</a>`;
                    }

                    attachmentsContainer.append(`
                        <div class="crse_content container">
                            <div class="fcrse_1 flex flex-col md:flex-row items-start gap-4">
                                <div class="w-full md:w-1/3">
                                    ${previewElement}
                                </div>
                                <div class="hs_content w-full md:w-2/3">
                                    <div class="vdtodt">
                                        <span class="vdt14">${attachment.views ?? '0'} views</span>
                                    </div>
                                    <a href="javascript:void(0);" class="crse14s title900 text-lg font-bold">
                                        ${attachment.title} | ${attachment.category ?? 'Uncategorized'}
                                    </a>
                                    <p class="text-gray-700">${attachment.discription}</p>
                                    <div class="auth1lnkprce">
                                        <p>By <a href="javascript:;" class="text-blue-500">{{ auth()->user()->first_name . " " . auth()->user()->last_name ?? 'Unknown' }}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                });
            },
            error: function () {
                toastr.error('Failed to load attachments', 'Error');
            }
        });
    }

    // Call function to load attachments
    loadAttachments();

    // Refresh attachments list after uploading a file
    $('#submitVideoButton').on('click', function () {
        setTimeout(loadAttachments, 2000);
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
