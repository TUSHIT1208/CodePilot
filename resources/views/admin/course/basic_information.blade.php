<div class="step-tab-panel step-tab-info active" id="tab_step1">
    <div class="tab-from-content">
        <div class="title-icon">
            <h3 class="title"><i class="uil uil-info-circle"></i>Basic Information</h3>
        </div>
        <div class="course__form">
            <div class="general_info10">
                <form action="{{ isset($course) ? route('course.update', ['course' => $course->id]) : route('course.store') }}" method="POST" id="courseForm" novalidate class="basic-validation" enctype="multipart/form-data">
                    @csrf
                    @if(isset($course))
                        @method('PUT')
                    @endif
                    <div class="row">
                        {{-- <div class="col-lg-12 col-md-12">
                            <div class="ui search focus mt-30 lbel25">
                                <label for="title-field">Course Title*</label>
                                <div class="ui left icon input swdh19">
                                    <input type="text" 
                                           class="prompt srch_explore form-control" 
                                           id="title-field"
                                           placeholder="Course title here" 
                                           name="title" 
                                           required minlength="10" maxlength="100"
                                           value="{{ old('title', $course->title ?? '') }}">
                                    <div class="invalid-feedback">Course Title must be between 10 and 100 characters.</div>
                                </div>
                                <div class="help-block">(Please make this a maximum of 100 characters and unique.)</div>
                            </div>                                 
                        </div> --}}

                        <div class="col-lg-12 col-md-12">
                            <div class="ui search focus lbel25 mt-30">
                                <label for="title-field">Course Title*</label>
                                <div class="ui left icon">
                                    <input type="text" name="title" id="title-field"  
                                           class="prompt srch_explore form-control"  
                                           placeholder="Course title here"   
                                           required minlength="3" maxlength="255"
                                           value="{{ old('title', $course->title ?? '') }}">
                                    <div class="invalid-feedback">Course Title must be between 3 and 255 characters.</div>
                                </div>
                            </div>
                        </div>
                        
                    
                        <div class="col-lg-12 col-md-12">
                            <div class="ui search focus lbel25 mt-30">
                                <label for="description-field">Short Description*</label>
                                <div class="ui form swdh30">
                                    <div class="field">
                                        <textarea rows="3" name="description" 
                                                  class="form-control" 
                                                  id="description-field"
                                                  required minlength="10" maxlength="1000"
                                                  placeholder="Item description here...">{{ old('description', $course->description ?? '') }}</textarea>
                                        <div class="invalid-feedback">Short Description must be between 10 and 1000 characters.</div>
                                    </div>
                                </div>
                                
                            </div>                                 
                        </div>
                        
                
                        <div class="course_des_textarea mt-30 lbel25">
                            <label>Course Description*</label>
                            <div class="text-editor">
                                <textarea id="editor1" class="form-control" 
                                          name="course_description" placeholder="Item description here" required>{{ old('course_description', $course->course_description ?? '') }}</textarea>
                            </div>
                            <div class="invalid-feedback">Course Description is required.</div>
                        </div>
                
                         <!-- What will students learn? -->
                        <div class="col-lg-6 col-md-12">
                            <div class="ui search focus lbel25 mt-30">
                                <label for="learn-field">What will students learn in your course?*</label>
                                <div class="ui form swdh30">
                                    <div class="field">
                                        <textarea rows="3" name="learn_in_course" 
                                                class="form-control"
                                                id="learn-field"
                                                required minlength="10" maxlength="1000"
                                                placeholder="Enter learning outcomes...">{{ old('learn_in_course', $course->learn_in_course ?? '') }}</textarea>
                                        <div class="invalid-feedback">Learning outcomes must be between 10 and 1000 characters.</div>
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
                                        <textarea rows="3" name="requirement" 
                                                class="form-control"
                                                id="requirement-field"
                                                required minlength="10" maxlength="1000"
                                                placeholder="Enter course requirements...">{{ old('requirement', $course->requirement ?? '') }}</textarea>
                                        <div class="invalid-feedback">Requirements must be between 10 and 1000 characters.</div>
                                    </div>
                                </div>
                            </div>                                 
                        </div>
                
                        <div class="col-lg-6 col-md-12">
                            <div class="mt-30 lbel25">
                                <label>Course Level*</label>
                            </div>
                            <select class="selectpicker _dlor1 form-control" name="course_level" id="selectlevel" required>
                                <option value="" hidden>Select Course Level</option>
                                <option value="Beginner" {{ old('course_level', $course->course_level ?? '') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="Intermediate" {{ old('course_level', $course->course_level ?? '') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="Expert" {{ old('course_level', $course->course_level ?? '') == 'Expert' ? 'selected' : '' }}>Expert</option>
                            </select>
                            <div class="invalid-feedback">Course Level is required.</div>
                        </div>
                
                        <div class="col-lg-6 col-md-12">
                            <div class="mt-30 lbel25">
                                <label>Course Type*</label>
                            </div>
                            <select class="selectpicker _dlor1 form-control" name="course_type" id="selectcourse_type" required>
                                <option value="" hidden>Select Course type</option>
                                <option value="text" {{ old('course_type', $course->course_type ?? '') == 'text' ? 'selected' : '' }}>Text</option>
                                <option value="video" {{ old('course_type', $course->course_type ?? '') == 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                            <div class="invalid-feedback">Course Type is required.</div>
                        </div>
                        
                        <div class="col-lg-6 col-md-12">
                            <div class="mt-30 lbel25">
                                <label>Category Name*</label>
                            </div>
                            <select class="selectpicker _dlor1 form-control" name="category_id" id="selectcategory" onchange="loadSubCategories()" required>
                                <option value="" selected hidden>Select Category</option>
                                @if(isset($subcategories))
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" 
                                        {{ old('sub_category_id', $course->sub_category_id ?? '') == $subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->name }}
                                    </option>
                                @endforeach
                            @endif
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $course->category_id ?? '') == $category->id ? 'selected' : '' }}>
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
                            <select class="selectpicker _dlor1 form-control" name="sub_category_id" id="selectsub_category" data-live-search="true" required>
                                <option value="" selected hidden>Select Sub-category</option>
                            </select>
                            <div class="invalid-feedback">Course Sub-Category is required.</div>
                        </div> 
                        <div class="col-lg-6 col-md-6">
                            <div class="ui search focus lbel25 mt-30">
                                <label for="title-field">Meta Keyword*</label>
                                <div class="ui left icon">
                                    <input type="text" name="meta_keyword" id="meta_keyword-field"  
                                           class="prompt srch_explore form-control"  
                                           placeholder="Course meta keyword here"   
                                           required minlength="3" maxlength="255"
                                           value="{{ old('title', $course->meta_keyword ?? '') }}">
                                    <div class="invalid-feedback">Course Meta Keyword must be between 3 and 255 characters.</div>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-lg-6 col-md-6">
                            <div class="ui search focus lbel25 mt-30">
                                <label for="title-field">Meta Title*</label>
                                <div class="ui left icon">
                                    <input type="text" name="meta title" id="meta-title-field"  
                                           class="prompt srch_explore form-control"  
                                           placeholder="Course meta title here"   
                                           required minlength="3" maxlength="255"
                                           value="{{ old('meta_title', $course->meta_title ?? '') }}">
                                    <div class="invalid-feedback">Course Meta Title must be between 3 and 255 characters.</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="ui search focus lbel25 mt-30">
                                <label for="description-field">Meta Description*</label>
                                <div class="ui form swdh30">
                                    <div class="field">
                                        <textarea rows="3" name="meta_description" 
                                                  class="form-control" 
                                                  id="meta-description-field"
                                                  required minlength="10" maxlength="1000"
                                                  placeholder="Item meta description here...">{{ old('meta_description', $course->meta_description ?? '') }}</textarea>
                                        <div class="invalid-feedback">Meta Description must be between 10 and 1000 characters.</div>
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
                                        <div class="upload-btn">
                                            <input class="uploadBtn-main-input" type="file" id="IntroFile__input--source"
                                                name="introduction_video" accept=".mp4"
                                                value="{{ old('url', $course->courseattachment->url ?? '') }}"
                                                {{ isset($course) ? '' : 'required' }} onchange="previewVideo(event)">
                                            <label for="IntroFile__input--source" title="Zip">Upload Video</label> 
                                    
                                            <!-- Video Preview Section -->
                                            <video width="100%" id="video-preview" controls {{ isset($course->courseattachment->url) ? '' : 'hidden' }}>
                                                <source id="video-source" 
                                                    src="{{ isset($course->courseattachment->url) ? asset('courseVideo/' . $course->courseattachment->url) : '' }}" 
                                                    type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
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
                                        <img src="{{ isset($course->courseattachment->thumbnail_url) && $course->courseattachment->thumbnail_url != null ? asset('courseThumbnail/' . $course->courseattachment->thumbnail_url) : asset('images/thumbnail-demo.jpg') }}" alt="Course Thumbnail" id="thumbnail-preview">
                                        <div class="thumb-dt">
                                            <div class="upload-btn">
                                                <input class="uploadBtn-main-input" type="file"
                                                    id="ThumbFile__input--source" name="introduction_thumbnail" accept=".jpg,.jpeg,.png" value="{{ old('thumbnail_url', $course->courseattachment->thumbnail_url ?? '') }}" {{ isset($course) ? '' : 'required' }}>
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
                    {{-- @endif   --}}
                    <button type="submit" class="main-btn mt-3" id="submitButton">{{ isset($course) ? 'Update' : 'Next' }}</button>
{{--                    
                    <div class="mt-5 row">
                        <div class="col-lg-12">
                        </div>
                        
                    </div> --}}
                </form>
                <div class="row">
                    <div class="col-lg-12 text-end">
                        @if (request()->route('course'))
                            <button id="basic_next" class="main-btn mt-3">Next</button>
                        @endif
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
                            url: '{{ url("admin/course/subcategories") }}',
                            type: 'GET',
                            data: { category_id: categoryId },
                            success: function(response) {
                                var subCategorySelect = $('#selectsub_category');
                                subCategorySelect.empty();
                                subCategorySelect.append('<option value="" selected hidden>Select Sub-category</option>');
                
                                if (response.length) {
                                    response.forEach(function(subCategory) {
                                        var selected = (subCategory.id == selectedSubCategoryId) ? 'selected' : '';
                                        subCategorySelect.append('<option value="' + subCategory.id + '" ' + selected + '>' + subCategory.name + '</option>');
                                    });
                                } else {
                                    subCategorySelect.append('<option value="">No subcategories available</option>');
                                }
                
                                subCategorySelect.selectpicker('refresh');
                            },
                            error: function() {
                                console.log('Error fetching subcategories');
                            }
                        });
                    }
                
                    $(document).ready(function() {
                        // Auto-load subcategories when editing a course
                        if ("{{ isset($course) ? 'true' : 'false' }}" === "true") {
                            loadSubCategories();
                        }
                    });
                // validation
                    document.addEventListener("DOMContentLoaded", function () {
                        const form = document.querySelector(".basic-validation");

                        form.addEventListener("submit", function (event) {
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add("was-validated");
                        }, false);
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<script>
    function previewThumbnail(event) {
        var output = document.getElementById('thumbnail-preview');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
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
    .was-validated .form-control:invalid{
        border-color: #dc3545 !important;
    }
    /* .was-validated .form-control:valid{
        border:none;
    } */
</style>