<div class="step-tab-panel step-tab-info active" id="tab_step1">
    <div class="tab-from-content">
        <div class="title-icon">
            <h3 class="title"><i class="uil uil-info-circle"></i>Basic Information</h3>
        </div>
        <div class="course__form">
            <div class="general_info10">
                <form action="{{ isset($course) ? route('course.update', ['course' => $course->id]) : route('course.store') }}" method="POST">
                    @csrf
                    @if(isset($course))
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="ui search focus mt-30 lbel25">
                                <label>Course Title*</label>
                                <div class="ui left icon input swdh19">
                                    <input class="prompt srch_explore @error('title') is-invalid @enderror" type="text" 
                                           placeholder="Course title here" name="title" maxlength="60" 
                                           value="{{ old('title', $course->title ?? '') }}">
                                    <div class="badge_num">60</div>
                                </div>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="help-block">(Please make this a maximum of 100 characters and unique.)</div>
                            </div>                                 
                        </div>
                
                        <div class="col-lg-12 col-md-12">
                            <div class="ui search focus lbel25 mt-30">
                                <label>Short Description*</label>
                                <div class="ui form swdh30">
                                    <div class="field">
                                        <textarea rows="3" name="description" 
                                                  class="form-control @error('description') is-invalid @enderror"
                                                  placeholder="Item description here...">{{ old('description', $course->description ?? '') }}</textarea>
                                    </div>
                                </div>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="help-block">220 words</div>
                            </div>                                 
                        </div>
                
                        <div class="course_des_textarea mt-30 lbel25">
                            <label>Course Description*</label>
                            <div class="text-editor">
                                <textarea id="editor1" class="form-control @error('course_description') is-invalid @enderror" 
                                          name="course_description" placeholder="Item description here">{{ old('course_description', $course->course_description ?? '') }}</textarea>
                            </div>
                            @error('course_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="col-lg-6 col-md-12">
                            <div class="ui search focus lbel25 mt-30">
                                <label>What will students learn in your course?*</label>
                                <div class="ui form swdh30">
                                    <div class="field">
                                        <textarea rows="3" name="learn_in_course" 
                                                  class="form-control @error('learn_in_course') is-invalid @enderror"
                                                  placeholder="">{{ old('learn_in_course', $course->learn_in_course ?? '') }}</textarea>
                                    </div>
                                </div>
                                @error('learn_in_course')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>                                 
                        </div>
                
                        <div class="col-lg-6 col-md-12">
                            <div class="ui search focus lbel25 mt-30">
                                <label>Requirements*</label>
                                <div class="ui form swdh30">
                                    <div class="field">
                                        <textarea rows="3" name="requirement" 
                                                  class="form-control @error('requirement') is-invalid @enderror"
                                                  placeholder="">{{ old('requirement', $course->requirement ?? '') }}</textarea>
                                    </div>
                                </div>
                                @error('requirement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>                                 
                        </div>
                
                        <div class="col-lg-6 col-md-12">
                            <div class="mt-30 lbel25">
                                <label>Course Level*</label>
                            </div>
                            <select class="selectpicker _dlor1 form-control @error('course_level') is-invalid @enderror"
                                    name="course_level" id="selectlevel">
                                <option value="" hidden>Select Course Level</option>
                                <option value="Beginner" {{ old('course_level', $course->course_level ?? '') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="Intermediate" {{ old('course_level', $course->course_level ?? '') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="Expert" {{ old('course_level', $course->course_level ?? '') == 'Expert' ? 'selected' : '' }}>Expert</option>
                            </select>
                            @error('course_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="col-lg-6 col-md-12">
                            <div class="mt-30 lbel25">
                                <label>Course Type*</label>
                            </div>
                            <select class="selectpicker _dlor1 form-control @error('course_type') is-invalid @enderror"
                                    name="course_type" id="selectcourse_type">
                                <option value="" hidden>Select Course type</option>
                                <option value="text" {{ old('course_type', $course->course_type ?? '') == 'text' ? 'selected' : '' }}>Text</option>
                                <option value="video" {{ old('course_type', $course->course_type ?? '') == 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                            @error('course_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mt-30 lbel25">
                                <label>Category Name*</label>
                            </div>
                            <select class="selectpicker _dlor1 form-control @error('category_id') is-invalid @enderror" name="category_id" id="selectcategory" onchange="loadSubCategories()">
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
                        </div>
                        <!-- Subcategory Selection -->
                        <div class="col-lg-6 col-md-6">
                            <div class="mt-30 lbel25">
                                <label>Sub Category*</label>
                            </div>
                            <select class="selectpicker _dlor1 form-control @error('sub_category_id') is-invalid @enderror" name="sub_category_id" id="selectsub_category" data-live-search="true">
                                <option value="" selected hidden>Select Sub-category</option>
                            </select>
                            @error('sub_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> 
                    </div>
                    <button type="submit" class="main-btn mt-3" id="submitButton">{{ isset($course) ? 'Update' : 'Next' }}</button>
                </form>
                                                               
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
            </script>
            
        </div>
    </div>
</div>
