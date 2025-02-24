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
            <div class="mt-5 row">
                <div class="col-lg-6">
                    @if (session()->has('course_id'))
                        <a href="{{ route('course.edit', ['course' => session('course_id')]) }}" class="upload_btn">
                            Previous
                        </a>
                    @endif
                </div>
                <div class="col-lg-6 text-end">
                    <button id="test_next" class="main-btn">Next</button>
                </div>
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
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="nav-quizbasic" role="tabpanel">
                                        <form id="testForm" method="POST">
                                            @csrf
                                            @if (isset($course))
                                                <input type="hidden" name="course_id" id='course_id'
                                                    value="{{ $course->id }}">
                                            @endif 
                                            <div class="new-section">
                                                <!-- Quiz Title -->
                                                <div class="form_group mt-30">
                                                    <label class="label25">Quiz Title*</label>
                                                    <input class="form_input_1 form-control" type="text"
                                                        name="test_title" id="test_title" placeholder="Title here">
                                                    <div class="invalid-feedback" id="test_title_error"></div>
                                                </div>
                                            </div>

                                            <div class="container">
                                                <div class="row">
                                                    <!-- Passing Marks -->
                                                    <div class="ui search focus lbel25 mt-30 col-sm-6">
                                                        <label>Passing Marks*</label>
                                                        <input class="form_input_1 form-control" type="text"
                                                            name="passing_mark" id="passing_mark"
                                                            placeholder="Passing Mark here">
                                                        <div class="invalid-feedback" id="passing_mark_error"></div>
                                                    </div>

                                                    <div class="ui search focus lbel25 mt-30 col-sm-6">
                                                        <label>Total Time*</label>
                                                        <input class="form_input_1 form-control" type="text" name="time"
                                                            id="time" placeholder="Time here">
                                                        <div class="invalid-feedback" id="time_error"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- question --}}
                                            <div class="add-ques-dt" id="questions-section">
                                                <div class="lecture-video-dt mt-30">
                                                    <span class="video-info">Question Type</span>
                                                    <div class="video-category" id="question-container">
                                                        <!-- Question input section will go here -->
                                                    </div>
                                                    <button type="button" class="main-btn color btn-hover mt-30"
                                                        id="add-question-btn">Add Question</button>
                                                </div>
                                            </div>
                                            <div class="share-submit-btns ps-0 pb-0 mb-4 text-end">
                                                <button type="submit" class="main-btn color btn-hover" id="saveBtn">
                                                    <i class="fas fa-save me-2"></i>Save Question
                                                </button>
                                            </div>
                                        </form>
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

<!-- Add Quiz End -->


<script>
    $(document).ready(function () {
        let questionIndex = 0;

        // Function to add a new question
        $('#add-question-btn').on('click', function () {
            questionIndex++;

            // Dynamically create a new question section
            const questionHTML = `
            <div class="question-section" id="question-${questionIndex}">
                <div class="form_group mt-30">
                    <label class="label25 text-left">Question Title*</label>
                    <input class="form_input_1" type="text" name="questions[${questionIndex}][question_text]" placeholder="Write question title">
                </div>
                <div class="form_group mt-30">
                    <label class="label25 text-left">Score*</label>
                    <input class="form_input_1" type="number" name="questions[${questionIndex}][score]" placeholder="Score">
                </div>

                <!-- Options for the question -->
                <div class="ans-box" id="options-section-${questionIndex}">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <button type="button" class="main-btn color btn-hover mt-30" id="add-option-btn-${questionIndex}">Add Option</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

            $('#question-container').append(questionHTML);

            // Function to add an option dynamically for each question
            $(`#add-option-btn-${questionIndex}`).on('click', function () {
                const optionHTML = `
                <div class="option-item">
                    <div class="opt-title">
                        <h4>Option</h4>
                        <span class="opt-del"><i class="fas fa-trash-alt"></i></span>
                    </div>
                    <div class="option-wrap">
                        <div class="form_group">
                            <label class="label25 text-left">Option Title*</label>
                            <input class="form_input_1" type="text" name="questions[${questionIndex}][options][option_text][]" placeholder="Option title">
                        </div>
                        <div class="agree_checkbox">
                            <!-- Checkbox for 'Correct answer' -->
                            <input type="checkbox" id="correct-option-${questionIndex}" name="questions[${questionIndex}][options][is_correct][]">
                            <label for="correct-option-${questionIndex}">Correct answer</label>
                        </div>
                    </div>
                </div>
            `;

                // Append the new option to the respective question's options section
                $(`#options-section-${questionIndex}`).append(optionHTML);
            });
        });

        // Handle form submission
        $('#testForm').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            const quizData = {
                course_id: $('#course_id').val(),
                test: $('#test_title').val(),
                passing: $('#passing_mark').val(),
                time: $('#time').val(),
                questions: []
            };

            // Loop through each question and gather the data
            $('#question-container .question-section').each(function () {
                const questionData = {
                    name: $(this).find('input[name^="questions"]')[0].value, // Question text
                    score: $(this).find('input[name^="questions"]')[1].value, // Score
                    options: []
                };

                // Gather options for each question
                $(this).find('.option-item').each(function () {
                    const optionData = {
                        value: $(this).find('input[name^="questions"]')[0].value, // Option text
                        is_correct: $(this).find('input[type="checkbox"]').is(':checked') // Correct answer
                    };
                    questionData.options.push(optionData);
                });

                quizData.questions.push(questionData);
            });

            // Send the data to the server using AJAX
            $.ajax({
                url: '{{route('test.store')}}',
                type: 'POST',
                data: JSON.stringify(quizData),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log('Quiz saved successfully:', response);
                    alert('Quiz saved successfully!');
                },
                error: function (xhr, status, error) {
                    console.error('Error saving quiz:', error);
                    alert('Error saving quiz. Please try again.');
                }
            });
        });
    });

</script>