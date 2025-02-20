<div class="step-tab-panel step-tab-gallery" id="tab_step2">
    <div class="tab-from-content">
        <div class="title-icon">
            <h3 class="title"><i class="uil uil-notebooks"></i>Curriculum</h3>
        </div>
        <div class="curriculum-section">
            <div class="row">
                <div class="col-md-12">

                    <div class="added-section-item">
                        <div class="section-header">
                            <h4><i class="fas fa-bars me-2"></i>Introduction</h4>
                            <div class="section-edit-options">
                                <button class="btn-152" type="button" data-toggle="collapse"
                                    data-target="#edit-section"><i class="fas fa-edit"></i></button>
                                <button class="btn-152" type="button"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                        <div id="edit-section" class="collapse">
                            <div class="new-section smt-25">
                                <div class="form_group">
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Section Name*</label>
                                        <div class="ui left icon input swdh19">
                                            <input class="prompt srch_explore" type="text" placeholder="" name="title"
                                                maxlength="60" id="main[title]" value="Introduction">
                                        </div>
                                    </div>
                                </div>
                                <div class="share-submit-btns ps-0">
                                    <button class="main-btn color btn-hover"><i class="fas fa-save me-2"></i>Update
                                        Section</button>
                                </div>
                            </div>
                        </div>
                        <div class="section-group-list sortable">

                            <div class="section-list-item">
                                <div class="section-item-title">
                                    <i class="fas fa-stream me-2"></i>
                                    <span class="section-item-title-text">Quiz Title</span>
                                </div>
                                <button type="button" class="section-item-tools"><i class="fas fa-edit"></i></button>
                                <button type="button" class="section-item-tools"><i
                                        class="fas fa-trash-alt"></i></button>
                                <button type="button" class="section-item-tools ml-auto"><i
                                        class="fas fa-bars"></i></button>
                            </div>
                            <div class="section-list-item">
                                <div class="section-item-title">
                                    <i class="fas fa-clipboard-list me-2"></i>
                                    <span class="section-item-title-text">Assignment Title</span>
                                </div>
                                <button type="button" class="section-item-tools"><i class="fas fa-edit"></i></button>
                                <button type="button" class="section-item-tools"><i
                                        class="fas fa-trash-alt"></i></button>
                                <button type="button" class="section-item-tools ml-auto"><i
                                        class="fas fa-bars"></i></button>
                            </div>
                        </div>
                        <div class="section-add-item-wrap p-3">

                            <button class="add_quiz" data-bs-toggle="modal" data-bs-target="#add_quiz_model"><i
                                    class="far fa-plus-square me-2"></i>Quiz</button>
                            <button class="add_assignment" data-bs-toggle="modal"
                                data-bs-target="#add_assignment_model"><i
                                    class="far fa-plus-square me-2"></i>Assignment</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="mt-5">
                @if (session()->has('course_id'))
                    <a href="{{ route('course.edit', ['course' => session('course_id')]) }}" class="upload_btn">
                        Previous
                    </a>
                @endif
            </div>

        </div>
    </div>
</div>



<!-- Add Quiz Start -->
<div class="modal fade" id="add_quiz_model" tabindex="-1" aria-labelledby="lectureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lectureModalLabel">Add Quiz</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="new-section-block">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="course-main-tabs">
                                <div class="nav nav-pills flex-column flex-sm-row nav-tabs" role="tablist">
                                    <a class="flex-sm-fill text-sm-center nav-link active" data-bs-toggle="tab"
                                        href="#nav-quizbasic" role="tab" aria-selected="true"><i
                                            class="fas fa-file-alt me-2"></i>Basic</a>
                                    <a class="flex-sm-fill text-sm-center nav-link" data-bs-toggle="tab"
                                        href="#nav-questions" role="tab" aria-selected="false"><i
                                            class="fas fa-question-circle me-2"></i>Questions</a>
                                    <a class="flex-sm-fill text-sm-center nav-link" data-bs-toggle="tab"
                                        href="#nav-setting" role="tab" aria-selected="false"><i
                                            class="fas fa-cog me-2"></i>Setting</a>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="nav-quizbasic" role="tabpanel">
                                        <form id="testForm">
                                            @csrf
                                            <div class="new-section">
                                                <!-- Quiz Title -->
                                                <div class="form_group mt-30">
                                                    <label class="label25">Quiz Title*</label>
                                                    <input class="form_input_1 form-control" type="text"
                                                        name="test_title" id="test_title" placeholder="Title here">
                                                    <div class="invalid-feedback" id="test_title_error"></div>
                                                </div>
                                            </div>

                                            <!-- Passing Marks -->
                                            <div class="ui search focus lbel25 mt-30">
                                                <label>Passing Marks*</label>
                                                <input class="form_input_1 form-control" type="text" name="passing_mark"
                                                    id="passing_mark" placeholder="Passing Mark here">
                                                <div class="invalid-feedback" id="passing_mark_error"></div>
                                            </div>

                                            <!-- Success Message -->
                                            {{-- <div class="alert alert-success mt-3 d-none" id="successMessage"></div>
                                            --}}

                                            <div class="modal-footer">
                                                <button type="button" class="main-btn cancel"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="main-btn" id="nextButton">Next</button>
                                            </div>
                                        </form>

                                    </div>

                                    <div class="tab-pane fade" id="nav-questions" role="tabpanel">
                                        <div class="lecture-video-dt mt-30">
                                            <div class="add-ques-dt">
                                                {{-- <button type="button" class="main-btn color btn-hover w-100"
                                                    data-bs-toggle="collapse" data-bs-target="#add-ques"><i
                                                        class="far fa-plus-square me-2"></i>Add Question</button> --}}
                                                {{-- <div id="add-ques" class="collapse"> --}}
                                                    <div class="lecture-video-dt mt-30">
                                                        <span class="video-info">Question Type</span>
                                                        <div class="video-category">
                                                            {{-- <label>
                                                                <input type="radio" name="colorRadio" value="schoice">
                                                                <span>
                                                                    <i class="far fa-dot-circle me-2"></i>Single
                                                                    Choice
                                                                </span>
                                                            </label> --}}
                                                            {{-- <label>
                                                                <input type="radio" name="colorRadio" value="mchoice">
                                                                <span>
                                                                    <i class="far fa-check-circle me-2"></i>Multiple
                                                                    Choice
                                                                </span>
                                                            </label>
                                                            <label><input type="radio" name="colorRadio" value="sline">
                                                                <span><i class="far fa-edit me-2"></i>Single Line
                                                                    Text</span></label>
                                                            <label><input type="radio" name="colorRadio"
                                                                    value="mline"><span><i
                                                                        class="far fa-file-alt me-2"></i>Milti Line
                                                                    Text</span></label> --}}
                                                            {{-- <div class="schoice quiz-box"> --}}
                                                                <div class="ques-box">
                                                                    <form id="question-form" method="POST"
                                                                        action="{{ route('testquestion.store') }}">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col-lg-7 col-md-9">
                                                                                <div class="form_group mt-30">
                                                                                    <label
                                                                                        class="label25 text-left">Question
                                                                                        Title*</label>
                                                                                    <input class="form_input_1"
                                                                                        type="text" name="question_text"
                                                                                        placeholder="Write question title"
                                                                                        value="{{ old('question_text') }}">
                                                                                    @error('question_text')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3 col-md-12">
                                                                                <div class="form_group mt-30">
                                                                                    <label
                                                                                        class="label25 text-left">Score*</label>
                                                                                    <input class="form_input_1"
                                                                                        type="number" name="score"
                                                                                        placeholder="Score"
                                                                                        value="{{ old('score') }}">
                                                                                    @error('score')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2 col-md-2">
                                                                                <div class="form_group mt-30">
                                                                                    <button type="submit"
                                                                                        class="main-btn color btn-hover mt-30">Save</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <!-- Success message display -->
                                                                <div id="success-message"
                                                                    style="display:none; color:green;"></div>

                                                                <div class="ans-box">
                                                                    <form method="POST"
                                                                        action="{{ route('testoption.store') }}">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12">
                                                                                <button type="submit"
                                                                                    id="add-option-btn"
                                                                                    class="main-btn color btn-hover mt-30">Add
                                                                                    Option</button>

                                                                            </div>
                                                                            <div class="col-lg-12 col-md-12">
                                                                                <div class="option-item">
                                                                                    <div class="opt-title">
                                                                                        <h4>1. Option</h4>
                                                                                        <span class="opt-del"><i
                                                                                                class="fas fa-trash-alt"></i></span>
                                                                                    </div>
                                                                                    <div class="option-wrap">
                                                                                        <div class="form_group">
                                                                                            <label
                                                                                                class="label25 text-left">Option
                                                                                                Title*</label>
                                                                                            <input class="form_input_1"
                                                                                                type="text"
                                                                                                name="option_text"
                                                                                                placeholder="Option title"
                                                                                                required>
                                                                                        </div>
                                                                                        <div class="agree_checkbox">
                                                                                            <!-- Checkbox for 'Correct answer' -->
                                                                                            <input type="checkbox"
                                                                                                id="check1"
                                                                                                name="is_correct">
                                                                                            <label for="check1">Correct
                                                                                                answer</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                {{--
                                                            </div> --}}
                                                            <div class="mchoice quiz-box">
                                                                <div class="ques-box">
                                                                    <div class="row">
                                                                        <div class="col-lg-7 col-md-9">
                                                                            <div class="form_group mt-30">
                                                                                <label
                                                                                    class="label25 text-left">Question
                                                                                    Title*</label>
                                                                                <input class="form_input_1" type="text"
                                                                                    placeholder="Write question title">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 col-md-12">
                                                                            <div class="form_group mt-30">
                                                                                <label
                                                                                    class="label25 text-left">Score*</label>
                                                                                <input class="form_input_1"
                                                                                    type="number" placeholder="Score">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="ans-box">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12">
                                                                            <button
                                                                                class="main-btn color btn-hover mt-30">Add
                                                                                Option</button>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12">
                                                                            <div class="option-item">
                                                                                <div class="opt-title">
                                                                                    <h4>1. Option</h4>
                                                                                    <span class="opt-del"><i
                                                                                            class="fas fa-trash-alt"></i></span>
                                                                                </div>
                                                                                <div class="option-wrap">
                                                                                    <div class="form_group">
                                                                                        <label
                                                                                            class="label25 text-left">Option
                                                                                            Title*</label>
                                                                                        <input class="form_input_1"
                                                                                            type="text"
                                                                                            placeholder="Option title">
                                                                                    </div>
                                                                                    <div class="agree_checkbox">
                                                                                        <input type="checkbox"
                                                                                            id="check2">
                                                                                        <label for="check2">Correct
                                                                                            answer</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="sline quiz-box">
                                                                <div class="ques-box">
                                                                    <div class="row">
                                                                        <div class="col-lg-2 col-md-2">
                                                                            <div class="form_group mt-30">
                                                                                <label
                                                                                    class="label25 text-left">Image*</label>
                                                                                <div class="upload-thumb">
                                                                                    <input
                                                                                        class="uploadBtn-input-preview"
                                                                                        type="file" accept="image/png"
                                                                                        id="thumbnail_source2">
                                                                                    <label class="mx-0 my-0"
                                                                                        for="thumbnail_source2"
                                                                                        title="Image"><img
                                                                                            class="img-thumbnail"
                                                                                            src="images/placeholder-image.png"
                                                                                            alt=""></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-7 col-md-9">
                                                                            <div class="form_group mt-30">
                                                                                <label
                                                                                    class="label25 text-left">Question
                                                                                    Title*</label>
                                                                                <input class="form_input_1" type="text"
                                                                                    placeholder="Write question title">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 col-md-12">
                                                                            <div class="form_group mt-30">
                                                                                <label
                                                                                    class="label25 text-left">Score*</label>
                                                                                <input class="form_input_1"
                                                                                    type="number" placeholder="Score">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mline quiz-box">
                                                                <div class="ques-box">
                                                                    <div class="row">
                                                                        <div class="col-lg-2 col-md-2">
                                                                            <div class="form_group mt-30">
                                                                                <label
                                                                                    class="label25 text-left">Image*</label>
                                                                                <div class="upload-thumb">
                                                                                    <input
                                                                                        class="uploadBtn-input-preview"
                                                                                        type="file" accept="image/png"
                                                                                        id="thumbnail_source3">
                                                                                    <label class="mx-0 my-0"
                                                                                        for="thumbnail_source3"
                                                                                        title="Image"><img
                                                                                            class="img-thumbnail"
                                                                                            src="images/placeholder-image.png"
                                                                                            alt=""></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-7 col-md-9">
                                                                            <div class="form_group mt-30">
                                                                                <label
                                                                                    class="label25 text-left">Question
                                                                                    Title*</label>
                                                                                <input class="form_input_1" type="text"
                                                                                    placeholder="Write question title">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 col-md-12">
                                                                            <div class="form_group mt-30">
                                                                                <label
                                                                                    class="label25 text-left">Score*</label>
                                                                                <input class="form_input_1"
                                                                                    type="number" placeholder="Score">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="share-submit-btns ps-0 pb-0">
                                                        <button class="main-btn color btn-hover"><i
                                                                class="fas fa-save me-2"></i>Save Question</button>
                                                    </div>
                                                    {{--
                                                </div> --}}

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="main-btn cancel"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="main-btn"
                                                id="nextToSettingsButton">Next</button>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-setting" role="tabpanel">
                                        <div class="new-section mt-30">
                                            <div class="quiz-cogs-step">
                                                <label class="label25 quiz-st-ft text-left">Gradable</label>
                                                <div class="cogs-toggle">
                                                    <label class="switch">
                                                        <input type="checkbox" id="gradable_quiz" value="">
                                                        <span></span>
                                                    </label>
                                                    <label for="gradable_quiz" class="lbl-quiz">Quiz Gradable</label>
                                                </div>
                                                <p>If this quiz test affect on the students grading system for this
                                                    course.</p>
                                            </div>
                                            <div class="quiz-cogs-step mt-30">
                                                <label class="label25 quiz-st-ft text-left">Remaining time
                                                    display</label>
                                                <div class="cogs-toggle">
                                                    <label class="switch">
                                                        <input type="checkbox" id="show_time" value="">
                                                        <span></span>
                                                    </label>
                                                    <label for="show_time" class="lbl-quiz">Show Time</label>
                                                </div>
                                                <p>By enabling this option, quiz taker will show remaining time during
                                                    attempt.</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form_group mt-30">
                                                        <label class="label25">Time Limit*</label>
                                                        <div class="input-group">
                                                            <input class="form_input_1 white-bg" type="number"
                                                                placeholder="">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text int4856">Minutes</span>
                                                            </div>
                                                            <span class="alt-text">Set zero to disable time
                                                                limit.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form_group mt-30">
                                                        <label class="label25">Passing Score(%)*</label>
                                                        <input class="form_input_1" type="number" placeholder="">
                                                        <span class="alt-text">Student have to collect this score in
                                                            percent for the pass this quiz.</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form_group mt-30">
                                                        <label class="label25">Questions Limit*</label>
                                                        <input class="form_input_1" type="number" placeholder="">
                                                        <span class="alt-text">The number of questions student have to
                                                            answer in this quiz.</span>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="main-btn cancel"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="main-btn">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="main-btn cancel" data-bs-dismiss="modal">Close</button>
                <button type="button" class="main-btn">Next</button>
            </div> --}}
        </div>
    </div>
</div>
<!-- Add Quiz End -->


<script>
    // When the "Next" button is clicked and validation
    document.getElementById('nextButton').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default behavior of the button (form submission)

        // Reset previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');

        // Get form data
        var course_id = $('#course_id').val();
        var test_title = $('#test_title').val();
        var passing_mark = $('#passing_mark').val();

        var isValid = true;

        // Validate Course IDsession()->get('course_id')
        // Validate Test Title
        if (!test_title) {
            $('#test_title').addClass('is-invalid');
            $('#test_title_error').text('Quiz Title is required.');
            isValid = false;
        }

        // Validate Passing Mark
        if (!passing_mark || isNaN(passing_mark) || passing_mark <= 0) {
            $('#passing_mark').addClass('is-invalid');
            $('#passing_mark_error').text('Please provide a valid Passing Mark.');
            isValid = false;
        }

        // If validation fails, stop the navigation and show error messages
        if (!isValid) {
            return; // Stop the navigation process
        }

        // If validation passes, submit the form via AJAX
        var formData = new FormData($('#testForm')[0]);

        $.ajax({
            url: "{{ route('test.store') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#nextButton').prop('disabled', true).text('Submitting...');
            },
            success: function (response) {
                $('#nextButton').prop('disabled', false).text('Next');
                $('#successMessage').removeClass('d-none').text(response.success);

                // Move to the next tab (questions tab) after successful form submission
                $('#nav-quizbasic').removeClass('show active');
                $('#nav-questions').addClass('show active');

                // Update active tab UI
                $('.nav-link').removeClass('active').attr('aria-selected', 'false');
                $('a[href="#nav-questions"]').addClass('active').attr('aria-selected', 'true');
            },
            error: function (response) {
                $('#nextButton').prop('disabled', false).text('Next');
                let errors = response.responseJSON.errors;

                if (errors) {
                    $.each(errors, function (key, value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key + '_error').text(value[0]);
                    });
                }
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('question-form');

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Create a FormData object to capture the form data
            const formData = new FormData(form);

            // Send the form data using Axios via POST request
            axios.post(form.action, formData)
                .then(function (response) {
                    if (response.data.success) {
                        // Display the success message dynamically
                        const successMessage = document.getElementById('success-message');
                        successMessage.innerText = response.data.message;
                        successMessage.style.display = 'block'; // Show the success message

                        // Optionally, reset the form or handle the UI as needed
                        //form.reset();
                    }
                })
                .catch(function (error) {
                    console.error(error);
                    alert('Failed to add question');
                });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const optionForm = document.querySelector('.ans-box form'); // Select the option form
        const questionForm = document.querySelector('#question-form'); // Select the question form
        const addButton = document.getElementById('add-option-btn'); // Add option button
        const optionsContainer = document.querySelector('.ans-box .row'); // Container for options

        function loadOptions() {
            let questionId = "{{ session()->get('question_id') }}"; // Ensure questionId is properly formatted

            axios.get(`/options/list/${questionId}`)  // Fetch options dynamically
                .then(response => {
                    optionsContainer.innerHTML = response.data; // Update options without reloading the page

                    if (response.data.optionCount >= 4) {
                        optionForm.reset(); // Reset only the option form
                        addButton.disabled = true; // Disable button when 4 options exist
                    } else {
                        addButton.disabled = false;
                    }
                })
                .catch(error => console.error('Error fetching options:', error));
        }

        optionForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            let formData = new FormData(optionForm);

            axios.post(optionForm.action, formData)
                .then(response => {
                    if (response.status === 201) {
                        loadOptions(); // Reload only the options list
                        optionForm.reset(); // Reset the form fields
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        questionForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default submission

            let formData = new FormData(questionForm);

            axios.post(questionForm.action, formData)
                .then(response => {
                    if (response.status === 201) {
                        questionForm.reset(); // Reset the question form
                        optionsContainer.innerHTML = ''; // Clear options for new question
                        addButton.disabled = false; // Enable add button for new options
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        loadOptions(); // Load options when the page is ready
    });
</script>