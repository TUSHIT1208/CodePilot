<div class="step-tab-panel step-tab-info active" id="tab_step1">
    <div class="tab-from-content">
        <div class="title-icon">
            <h3 class="title"><i class="uil uil-info-circle"></i>Basic Information</h3>
        </div>
        <div class="course__form">
            <div class="general_info10">
                <form
                    action="{{ isset($course) ? route('course.update', ['course' => $course->id]) : route('course.store') }}"
                    method="POST" id="courseForm" novalidate class="basic-validation" enctype="multipart/form-data">
                    {{-- <form id="courseForm" novalidate class="basic-validation" enctype="multipart/form-data"> --}}
                        @csrf
                        @if (isset($course))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="ui search focus lbel25 mt-30">
                                    <label for="title-field">Course Title*</label>
                                    <div class="ui left icon">
                                        <input type="text" name="title" id="title-field"
                                            class="prompt srch_explore form-control" placeholder="Course title here"
                                            required minlength="3" maxlength="255"
                                            value="{{ old('title', $course->title ?? '') }}">
                                        <div class="invalid-feedback">Course Title must be between 3 and 255 characters.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="ui search focus lbel25 mt-30">
                                    <label for="description-field">Short Description*</label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea rows="3" name="description" class="form-control"
                                                id="description-field" required minlength="10" maxlength="1000"
                                                placeholder="course description here...">{{ old('description', $course->description ?? '') }}</textarea>
                                            <div class="invalid-feedback">Short Description must be between 10 and 1000
                                                characters.</div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="ui search focus lbel25 mt-30">
                                    <label for="description-field">Description*</label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea name="course_description" class="form-control"
                                                id="description-field" required
                                                placeholder="course description here...">{{ old('course_description', $course->course_description ?? '') }}</textarea>
                                            <div class="invalid-feedback">Course Description is required.</div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- What will students learn? -->
                            <div class="col-lg-6 col-md-12">
                                <div class="ui search focus lbel25 mt-30">
                                    <label for="learn-field">What will students learn in your course?*</label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea rows="3" name="learn_in_course" class="form-control editor1"
                                                id="learn-field" required minlength="10" maxlength="1000"
                                                placeholder="Enter learning outcomes...">{{ old('learn_in_course', $course->learn_in_course ?? '') }}</textarea>
                                            <div class="invalid-feedback">Learning outcomes must be between 10 and 1000
                                                characters.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Requirements -->
                            <div class="col-lg-6 col-md-12">
                                <div class="ui search focus lbel25 mt-30">
                                    <label for="requirement-field">Requirements*</label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea rows="3" name="requirement" class="form-control editor1"
                                                id="requirement-field" required minlength="10" maxlength="1000"
                                                placeholder="Enter course requirements...">{{ old('requirement', $course->requirement ?? '') }}</textarea>
                                            <div class="invalid-feedback">Requirements must be between 10 and 1000
                                                characters.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="mt-30 lbel25">
                                    <label>Course Level*</label>
                                </div>
                                <select class="selectpicker _dlor1 form-control" name="course_level" id="selectlevel"
                                    required>
                                    <option value="" hidden>Select Course Level</option>
                                    <option value="Beginner" {{ old('course_level', $course->course_level ?? '') ==
    'Beginner' ? 'selected' : '' }}>
                                        Beginner</option>
                                    <option value="Intermediate" {{ old('course_level', $course->course_level ?? '') ==
    'Intermediate' ? 'selected' : '' }}>
                                        Intermediate</option>
                                    <option value="Expert" {{ old('course_level', $course->course_level ?? '') == 'Expert' ?
    'selected' : '' }}>
                                        Expert</option>
                                </select>
                                <div class="invalid-feedback">Course Level is required.</div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="mt-30 lbel25">
                                    <label>Course Type*</label>
                                </div>
                                <select class="selectpicker _dlor1 form-control" name="course_type"
                                    id="selectcourse_type" required>
                                    <option value="" hidden>Select Course type</option>
                                    {{-- <option value="text" {{ old('course_type', $course->course_type ?? '') ==
                                        'text' ?
                                        'selected' : '' }}>Text</option> --}}
                                    <option value="video" {{ old('course_type', $course->course_type ?? '') == 'video' ?
    'selected' : '' }}>
                                        Video</option>
                                </select>
                                <div class="invalid-feedback">Course Type is required.</div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="ui search focus lbel25 mt-30">
                                    <label for="select_debugger">Debugger*</label>
                                    <select class="selectpicker _dlor1 form-control" name="debugger"
                                        id="select_debugger" required>
                                        <option value="" hidden>Select Course Debugger</option>

                                        <optgroup label="Web Development">
                                            <option value="https://onecompiler.com/embed/html" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/html" ? 'selected' : '' }}>HTML</option>
                                            <option value="https://onecompiler.com/embed/bootstrap" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/bootstrap" ? 'selected' : '' }}>Bootstrap</option>
                                            <option value="https://onecompiler.com/embed/jquery" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/jquery" ? 'selected' : '' }}>jQuery</option>
                                        </optgroup>

                                        <optgroup label="Frontend & Backend Programming">
                                            <option value="https://onecompiler.com/embed/javascript" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/javascript" ? 'selected' : '' }}>JavaScript</option>
                                            <option value="https://onecompiler.com/embed/nodejs" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/nodejs" ? 'selected' : '' }}>Node.js</option>
                                            <option value="https://onecompiler.com/embed/ejs" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/ejs" ? 'selected' : '' }}>Express.js</option>
                                        </optgroup>

                                        <optgroup label="General Programming Languages">
                                            <option value="https://onecompiler.com/embed/php" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/php" ? 'selected' : '' }}>PHP</option>
                                            <option value="https://onecompiler.com/embed/php" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/python" ? 'selected' : '' }}>Python</option>
                                            <option value="https://onecompiler.com/embed/java" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/java" ? 'selected' : '' }}>Java</option>
                                            <option value="https://onecompiler.com/embed/c" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/c" ? 'selected' : '' }}>C</option>
                                            <option value="https://onecompiler.com/embed/cpp" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/cpp" ? 'selected' : '' }}>C++</option>
                                            <option value="https://onecompiler.com/embed/c#" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/c#" ? 'selected' : '' }}>C#</option>
                                            <option value="https://onecompiler.com/embed/kotlin" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/kotlin" ? 'selected' : '' }}>Kotlin</option>
                                            <option value="https://onecompiler.com/embed/r" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/r" ? 'selected' : '' }}>R</option>
                                            <option value="https://onecompiler.com/embed/perl" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/perl" ? 'selected' : '' }}>Perl</option>
                                        </optgroup>

                                        <optgroup label="Databases">
                                            <option value="https://onecompiler.com/embed/mysql" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/mysql" ? 'selected' : '' }}>MySQL</option>
                                            <option value="https://onecompiler.com/embed/mongodb" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/mongodb" ? 'selected' : '' }}>MongoDB</option>
                                            <option value="https://onecompiler.com/embed/sqlite" {{ old('debugger', $course->debugger ?? '') == "https://onecompiler.com/embed/sqlite" ? 'selected' : '' }}>SQLite</option>
                                        </optgroup>
                                    </select>

                                </div>
                            </div>


                            <div class="col-lg-6 col-md-12">
                                <div class="mt-30 lbel25">
                                    <label>Category Name*</label>
                                </div>
                                <select class="selectpicker _dlor1 form-control" name="category_id" id="selectcategory"
                                    onchange="loadSubCategories()" required>
                                    <option value="" selected hidden>Select Category</option>
                                    @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}" {{ old('category_id', $course->category_id ?? '') ==
                                        $category->id ? 'selected' : '' }}>
                                                                        {{ $category->name }}
                                                                    </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Course Category is required.</div>
                            </div>

                            <!-- Subcategory Selection -->
                            <div class="col-lg-6 col-md-6">
                                <div class="mt-30 lbel25">
                                    <label>Sub Category*</label>
                                </div>
                                <select class="selectpicker _dlor1 form-control" name="sub_category_id"
                                    id="selectsub_category" data-live-search="true" required>
                                    <option value="" selected hidden>Select Sub-category</option>
                                </select>
                                <div class="invalid-feedback">Course Sub-Category is required.</div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="ui search focus lbel25 mt-30">
                                    <label for="title-field">Meta Keyword*</label>
                                    <div class="ui left icon">
                                        <input type="text" name="meta_keyword" id="title-field"
                                            class="prompt srch_explore form-control"
                                            placeholder="Course meta keyword here" required minlength="3"
                                            maxlength="255" value="{{ old('title', $course->meta_keyword ?? '') }}">
                                        <div class="invalid-feedback">Course Meta Keyword must be between 3 and 255
                                            characters.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="ui search focus lbel25 mt-30">
                                    <label for="title-field">Meta Title*</label>
                                    <div class="ui left icon">
                                        <input type="text" name="meta title" id="title-field"
                                            class="prompt srch_explore form-control"
                                            placeholder="Course meta title here" required minlength="3" maxlength="255"
                                            value="{{ old('meta_title', $course->meta_title ?? '') }}">
                                        <div class="invalid-feedback">Course Meta Title must be between 3 and 255
                                            characters.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="ui search focus lbel25 mt-30">
                                    <label for="description-field">Meta Description*</label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea rows="3" name="meta_description" class="form-control"
                                                id="meta-description-field" required minlength="10" maxlength="1000"
                                                placeholder="Item meta description here...">{{ old('meta_description', $course->meta_description ?? '') }}</textarea>
                                            <div class="invalid-feedback">Meta Description must be between 10 and 1000
                                                characters.</div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        {{-- @if (!request()->route('course')) --}}
                        {{-- media --}}
                        <div class="mp4 intro-box" style="display: block;">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="mt-30 lbel25">
                                        <label>Upload Video*</label>
                                    </div>
                                    <div class="upload-file-dt mt-28">
                                        <!-- Video Preview Section -->
                                        <video width="60%" id="video-preview" controls {{ isset($course->url) ? '' :
    'hidden' }}>
                                            <source id="video-source"
                                                src="{{ isset($course->url) ? asset('courseVideo/' . $course->url) : '' }}"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <div class="upload-btn">
                                            <input class="uploadBtn-main-input" type="file"
                                                id="IntroFile__input--source" name="introduction_video" accept=".mp4"
                                                value="{{ old('url', $course->url ?? '') }}" {{ isset($course) ? ''
    : 'required' }} onchange="previewVideo(event)">
                                            <label for="IntroFile__input--source" title="Zip">Upload Video</label>
                                        </div>

                                        <span class="uploadBtn-main-file">File Format: .mp4</span>

                                        <div class="invalid-feedback">Please upload a valid .mp4 video file.</div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mt-30 lbel25">
                                        <label>Course Thumbnail*</label>
                                    </div>
                                    <div class="thumb-item">
                                        <!-- Show Existing Thumbnail -->
                                        <img src="{{ isset($course->thumbnail_url) && $course->thumbnail_url != null ? asset('courseThumbnail/' . $course->thumbnail_url) : asset('images/thumbnail-demo.jpg') }}"
                                            alt="Course Thumbnail" id="thumbnail-preview" style="width : 60%;">
                                        <div class="thumb-dt">
                                            <div class="upload-btn">
                                                <input class="uploadBtn-main-input" type="file"
                                                    id="ThumbFile__input--source" name="introduction_thumbnail"
                                                    accept=".jpg,.jpeg,.png"
                                                    value="{{ old('thumbnail_url', $course->thumbnail_url ?? '') }}" {{
    isset($course) ? '' : 'required' }}
                                                    onchange="previewThumbnail(event)">
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
                        {{-- @endif --}}
                        <button type="submit" class="main-btn mt-3" id="submitButton">{{ isset($course) ? 'Update' : 'Save'
                        }}</button>
                    </form>
                    <div class="loader-overlay" id="loader">
                        <div class="loader"></div>
                    </div>


            </div>
        </div>
    </div>
</div>
<script>
    function loadSubCategories() {
        var categoryId = document.getElementById("selectcategory").value;
        var selectedSubCategoryId = "{{ old('sub_category_id', $course->sub_category_id ?? '') }}";

        if (!categoryId) {
            return;
        }

        $.ajax({
            url: '{{ url('admin/course/subcategories') }}',
            type: 'GET',
            data: {
                category_id: categoryId
            },
            success: function (response) {
                var subCategorySelect = $('#selectsub_category');
                subCategorySelect.empty();
                subCategorySelect.append('<option value="" selected hidden>Select Sub-category</option>');

                if (response.length) {
                    response.forEach(function (subCategory) {
                        var selected = (subCategory.id == selectedSubCategoryId) ? 'selected' : '';
                        subCategorySelect.append('<option value="' + subCategory.id + '" ' +
                            selected + '>' + subCategory.name + '</option>');
                    });
                } else {
                    subCategorySelect.append('<option value="">No subcategories available</option>');
                }


                //subCategorySelect.selectpicker('refresh'); // Refresh after initialization
                if (subCategorySelect.length) {
                    if ($.fn.selectpicker) {
                        subCategorySelect.selectpicker(); // Initialize if not already
                        subCategorySelect.selectpicker('refresh'); // Refresh dropdown
                    } else {
                        console.warn("Bootstrap Select is not loaded.");
                    }
                } else {
                    console.error("#sub_category_id select element not found.");
                }
            },
            error: function () {
                console.log('Error fetching subcategories');
            }
        });
    }

    $(document).ready(function () {
        // Auto-load subcategories when editing a course
        if ("{{ isset($course) ? 'true' : 'false' }}" === "true") {
            loadSubCategories();
        }
    });
    // // validation
    // document.addEventListener("DOMContentLoaded", function() {
    //     const form = document.querySelector(".basic-validation");

    //     form.addEventListener("submit", function(event) {
    //         if (!form.checkValidity()) {
    //             event.preventDefault();
    //             event.stopPropagation();
    //         }
    //         form.classList.add("was-validated");
    //     }, false);
    // });
</script>
<script>
    // $(document).ready(function () {
    // Ensure CKEditor data is added before form submission
    // for (instance in CKEDITOR.instances) {
    //     CKEDITOR.instances[instance].updateElement();
    // }
    $(document).ready(function () {
        const form = $(".basic-validation");

        form.submit(function (event) {
            event.preventDefault(); // Prevent default form submission

            if (!form[0].checkValidity()) {
                event.stopPropagation();
                form.addClass("was-validated");
                return;
            }

            let formAction = form.attr("action");
            let formMethod = form.attr("method").toUpperCase();
            let formData = new FormData(this);
            let submitButton = $("#submitButton");
            let loader = $("#loader");

            // Show loader and disable submit button
            loader.show();
            submitButton.prop("disabled", true).text("Saving...");

            $.ajax({
                url: formAction,
                type: formMethod,
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log("Server Response:", response);
                    loader.hide();
                    submitButton.prop("disabled", false).text("Save");

                    if (response.success && formMethod === "POST" && response.redirect_url) {
                        window.location.href = response.redirect_url;
                    } else {
                        //alert("Update");
                        console.log("update");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                    loader.hide();
                    submitButton.prop("disabled", false).text("Save");
                }
            });

            form.addClass("was-validated");
        });
    });

    // });
</script>
<script>
    // ckeditor
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".editor1").forEach((editorElement, index) => {
            ClassicEditor
                .create(editorElement, {
                    toolbar: {
                        items: [
                            'heading', '|', 'fontSize', 'fontFamily', 'fontColor',
                            'fontBackgroundColor',
                            '|', 'bold', 'italic', 'underline', 'strikethrough', 'subscript',
                            'superscript',
                            '|', 'alignment', 'outdent', 'indent', 'bulletedList',
                            'numberedList', 'blockQuote',
                            '|', 'insertTable', '|', 'undo', 'redo'
                        ]
                    },
                    heading: {
                        options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Heading 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Heading 6',
                            class: 'ck-heading_heading6'
                        }
                        ]
                    }
                })
                .then(editor => {
                    console.log(`Editor ${index + 1} initialized`);
                })
                .catch(error => {
                    console.error("Error initializing CKEditor:", error);
                });
        });
    });



</script>
<script>
    function previewThumbnail(event) {
        var output = document.getElementById('thumbnail-preview');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // Free up memory
        }
    }
    // Listen for changes on the video file input
    function previewVideo(event) {
        const file = event.target.files[0];
        if (file && file.type === "video/mp4") {
            const videoPreview = document.getElementById("video-preview");
            const videoSource = document.getElementById("video-source");
            const url = URL.createObjectURL(file);

            videoSource.src = url;
            videoPreview.load();
            videoPreview.hidden = false;
        } else {
            alert("Please upload a valid .mp4 video file.");
        }


    }
</script>
<style>
    .was-validated .form-control:invalid {
        border-color: #dc3545 !important;
    }
</style>