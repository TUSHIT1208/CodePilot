<div class="step-tab-panel step-tab-gallery" id="tab_step2">
    <div class="tab-from-content">
        <div class="title-icon">
            <h3 class="title"><i class="uil uil-notebooks"></i>Quiz</h3>
        </div>
        <div class="curriculum-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="added-section-item">
                        {{-- <div class="section-header">
                            <h4><i class="fas fa-bars me-2"></i>Introduction</h4>
                            <div class="section-edit-options">
                                <button class="btn-152" type="button" data-toggle="collapse"
                                    data-target="#edit-section"><i class="fas fa-edit"></i></button>
                                <button class="btn-152" type="button"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div> --}}
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
                        {{-- <div class="section-group-list sortable">

                            {{-- <div class="">
                                <div class="section-item-title">
                                    <i class="fas fa-stream me-2"></i>
                                    <span class="section-item-title-text">Quiz Title</span>
                                </div>
                            </div> --}}
                            {{-- <div class="section-list-item">
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
                        </div> --}}
                        <form id="form">
                            @csrf
                            <div class="section-add-item-wrap p-3">

                                <button type="button" class="add_quiz" data-bs-toggle="modal"
                                    data-bs-target="#add_quiz_model">
                                    <i class="{{ isset($tests) ? '' : 'far fa-plus-square me-2'}}"></i>
                                </button>Quiz
                                @if(isset($tests))
                                    <a class="btn-sm edit-quiz">
                                        <i class="uil uil-edit-alt ucp-table "></i>
                                    </a>
                                    <a class="btn-sm delete-quiz">
                                        <i class="uil uil-trash-alt ucp-table"></i>
                                    </a>
                                @endif
                                {{-- <button class="add_assignment" data-bs-toggle="modal"
                                    data-bs-target="#add_assignment_model"><i
                                        class="far fa-plus-square me-2"></i>Assignment</button> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="curriculum-section mt-5">
                <div class="row">
                    <div class="col-md-12">

                    </div>
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
                                        <form id="quizForm" class="needs-validation"
                                            acition="{{ isset($tests) ? route('test.update', ['quiz' => $tests->id]) : route('test.store') }}"
                                            novalidate>
                                            @csrf
                                            {{-- @method('PUT') --}}
                                            @if (isset($course))
                                                <input type="hidden" name="course_id" id='course_id'
                                                    value="{{ $course->id }}">
                                            @endif 
                                            @if(isset($tests))
                                                <input type="hidden" name="quiz_id" id="quiz_id" value="{{ $tests->id }}">
                                            @endif

                                            <div class="new-section">
                                                <!-- Quiz Title -->
                                                <div class="form_group mt-30">
                                                    <label class="label25">Quiz Title*</label>
                                                    <input class="form_input_1 form-control" type="text"
                                                        name="test_title" id="test_title" placeholder="Title here"
                                                        required>
                                                    <div class="invalid-feedback" id="test_title_error">Please enter
                                                        quiz title.</div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- Passing Marks -->
                                                <div class="ui search focus lbel25 mt-30 col-sm-4">
                                                    <label>Passing Marks*</label>
                                                    <input class="form_input_1 form-control" type="text"
                                                        name="passing_mark" id="passing_mark"
                                                        placeholder="Passing Mark here" required>
                                                    <div class="invalid-feedback" id="passing_mark_error">
                                                        passing marks below than total marks</div>
                                                </div>

                                                <div class="ui search focus lbel25 mt-30 col-sm-4">
                                                    <label>Total Marks*</label>
                                                    <input class="form_input_1 form-control" type="text"
                                                        name="total_marks" id="total_marks"
                                                        placeholder="total marks here" required>
                                                    <div class="invalid-feedback" id="total_marks_error">Please enter
                                                        total marks.</div>
                                                </div>

                                                <div class="ui search focus lbel25 mt-30 col-sm-4">
                                                    <label>Total Time*</label>
                                                    <input class="form_input_1 form-control" type="text" name="time"
                                                        id="time" placeholder="Time here" required>
                                                    <div class="invalid-feedback" id="time_error">Please enter total
                                                        time.</div>
                                                </div>
                                            </div>
                                        </form>
                                        <form id="questionForm" method="POST" class="needs-validation" novalidate>
                                            @csrf
                                            {{-- question --}}
                                            <div class="question-section" id="question">
                                                <div class="form_group mt-30">
                                                    <label class="label25 text-left">Question Title*</label>
                                                    <input class="form_input_1 form-control" type="text"
                                                        id="question_text" name="question_text"
                                                        placeholder="Write question title" required>
                                                    <div class="invalid-feedback" id="question_text_error">Please enter
                                                        question title.</div>
                                                </div>
                                                <div class="form_group mt-30">
                                                    <label class="label25 text-left">Score*</label>
                                                    <input class="form_input_1 form-control" type="number"
                                                        id="question_score" name="question_score" placeholder="Score"
                                                        required>
                                                    <div class="invalid-feedback" id="question_score_error">Please
                                                        enter score.</div>
                                                </div>

                                                <!-- Options for the question -->
                                                <div class="ans-box" id="options-section">
                                                    <div class="row option-item">
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="opt-title">
                                                                <h4>Option</h4>
                                                                <span class="opt-del"><i
                                                                        class="fas fa-trash-alt"></i></span>
                                                            </div>
                                                            <div class="option-wrap">
                                                                <div class="form_group">
                                                                    <label class="label25 text-left">Option
                                                                        Title*</label>
                                                                    <input class="form_input_1 form-control" type="text"
                                                                        name="option_text[]" placeholder="Option title"
                                                                        required>
                                                                    <div class="invalid-feedback" id="option_error">
                                                                        Please enter option.</div>
                                                                </div>
                                                                <div class="agree_checkbox">
                                                                    <!-- Checkbox for 'Correct answer' -->
                                                                    <input type="checkbox" name="is_correct[]">
                                                                    <label>Correct answer</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <button type="button" class="main-btn color btn-hover mt-30"
                                                                id="add-option-btn">Add Option</button>
                                                        </div>
                                                        <div class="col-sm-6 text-end">
                                                            <button type="button" class="main-btn color btn-hover mt-30"
                                                                id="saveBtn">
                                                                Save Question & Option
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- DataTable to display quiz data -->
                                        @if(!isset($test))
                                            <table id="quizDataTable" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Questions</th>
                                                        <th>Score</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Quiz data will be populated here -->
                                                </tbody>
                                            </table>
                                        @else
                                            {{-- <table id="testTable" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Test Title</th>
                                                        <th>Passing Mark</th>
                                                        <th>Total Marks</th>
                                                        <th>Time</th>
                                                        <th>Questions</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table> --}}
                                        @endif
                                        <div class="mt-4 text-end">
                                            <button type="button" class="main-btn color btn-hover"
                                                id="{{ isset($tests) ? 'edit-quiz' : 'save-all' }}">
                                                <i class="fas fa-save me-2"></i>{{ isset($tests) ? 'Update' : 'Save' }}
                                            </button>
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
</div>
<!-- Add Quiz End -->

<script>
    $(document).ready(function () {
        // Handle the edit button click

        $(document).on('click', '.edit-quiz', function () {
            var quizId = document.getElementById('quiz_id').value; // Get the quiz ID
            // Perform an AJAX request to fetch the quiz data
            console.log(quizId);
            // console.log(testdata, "testdata");

            var $course_id = document.getElementById('course_id').value;
            $.ajax({
                url: '{{route('test.show', '')}}/' + quizId,
                method: 'GET',
                success: function (response) {
                    // Populate the modal fields with the response data
                    $('#test_title').val(response.id);
                    $('#test_title').val(response.test_title);
                    $('#passing_mark').val(response.passing_mark);
                    $('#total_marks').val(response.total_marks);
                    $('#time').val(response.time);
                    //testdata
                    // Show the modal

                    $('#add_quiz_model').modal('show');
                },
                error: function (xhr, status, error) {
                    toastr.error('An error occurred while fetching quiz data.', 'Error');
                }
            });

        });

        // Handle the save changes button click
        $('#edit-quiz').on('click', function (event) {
            var form = $('#add_quiz_model')[0]; // Get the form element
            var quizId = document.getElementById('quiz_id').value; // Get the quiz ID
            console.log("hello");


            // Apply Bootstrap validation
            // if (!form.checkValidity()) {
            //     event.preventDefault();
            //     event.stopPropagation();
            //     $(form).addClass('was-validated');
            //     return; // Stop execution if validation fails
            // }

            // Custom validation
            var isValid = true;
            var totalMarks = parseFloat($('#total_marks').val());
            var passingMarks = parseFloat($('#passing_mark').val());
            var title = $('#test_title').val().trim();
            var time = $('#time').val().trim();

            // Check if title and time are required
            if (!title) {
                $('#test_title').addClass('is-invalid');
                $('#test_title_error').show();
                isValid = false;
            } else {
                $('#test_title').removeClass('is-invalid');
                $('#test_title_error').hide();
            }

            if (!time) {
                $('#time').addClass('is-invalid');
                $('#time_error').show();
                isValid = false;
            } else {
                $('#time').removeClass('is-invalid');
                $('#time_error').hide();
            }

            // Check if passing marks are greater than total marks
            if (passingMarks > totalMarks || isNaN(passingMarks) || isNaN(totalMarks)) {
                $('#passing_mark').addClass('is-invalid');
                $('#passing_mark_error').show();
                isValid = false;
            } else {
                $('#passing_mark').removeClass('is-invalid');
                $('#passing_mark_error').hide();
            }

            // If validation fails, stop execution
            if (!isValid) {
                return;
            }

            // Proceed with AJAX request if everything is valid
            $.ajax({
                url: '{{route('test.update', '')}}/' + quizId,
                method: 'PUT',
                data: $('#quizForm').serialize(),
                success: function (response) {
                    // Update the DataTable and close the modal
                    $('#quizTable').DataTable().ajax.reload();
                    $('#add_quiz_model').modal('hide');
                    toastr.success('Quiz updated successfully');

                    // Reset Bootstrap validation state after successful update
                    $(form).removeClass('was-validated');
                },
                error: function () {
                    toastr.error('Failed to update quiz. Please try again.');
                }
            });
        });


        // Handle the delete button click
        $(document).on('click', '.delete-quiz', function (event) {
            event.preventDefault();
            var quizId = document.getElementById('quiz_id').value; // Get the quiz ID
            //var row = $(this).closest('tr'); // Get the row of the clicked button

            // Use SweetAlert2 to ask for confirmation before deleting
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this quiz. This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the AJAX request to delete the quiz
                    $.ajax({
                        url: '{{route('test.destroy', '')}}/' + quizId,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            // If successful, reload the page
                            location.reload(); // This will refresh the page
                            //#3085d6form.reset();
                        },
                        error: function (xhr, status, error) {
                            toastr.error('An error occurred. Please try again.', 'Error');
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    // Initialize the quizData object
    let quizData = {
        title: '',
        passingMark: '',
        totalTime: '',
        totalmarks: '',
        questions: []
    };


    // Add a new option dynamically
    document.getElementById('add-option-btn').addEventListener('click', function () {
        const optionItem = document.createElement('div');
        optionItem.classList.add('row', 'option-item');
        optionItem.innerHTML = `
            <div class="col-lg-12 col-md-12">
                <div class="opt-title">
                    <h4>Option</h4>
                    <span class="opt-del"><i class="fas fa-trash-alt"></i></span>
                </div>
                <div class="option-wrap">
                    <div class="form_group">
                        <label class="label25 text-left">Option Title*</label>
                        <input class="form_input_1" type="text" name="option_text[]" placeholder="Option title" required>
                        <div class="invalid-feedback">Please enter option title.</div>
                    </div>
                    <div class="agree_checkbox">
                        <input type="checkbox" name="is_correct[]">
                        <label>Correct answer</label>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('options-section').appendChild(optionItem);

        optionItem.querySelector('.opt-del').addEventListener('click', function () {
            optionItem.remove();
        });
    });

    // Save a question with options
    // Save a question with options
    document.getElementById('saveBtn').addEventListener('click', function (event) {
        quizData.course_id = document.getElementById('course_id').value;
        quizData.title = document.getElementById('test_title').value;
        quizData.passingMark = document.getElementById('passing_mark').value;
        quizData.totalmarks = document.getElementById('total_marks').value;
        quizData.totalTime = document.getElementById('time').value;

        const questionForm = document.getElementById('questionForm');

        // Apply Bootstrap validation using checkValidity()
        if (!questionForm.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            questionForm.classList.add('was-validated');
            return; // Stop execution if validation fails
        }

        // Validate the question form fields manually
        const questionText = document.querySelector('input[name="question_text"]');
        const questionScore = document.querySelector('input[name="question_score"]');
        const optionInputs = document.querySelectorAll('input[name="option_text[]"]');
        const correctAnswers = document.querySelectorAll('input[name="is_correct[]"]');

        let isValid = true;

        // Check if question text is provided
        if (!questionText.value.trim()) {
            questionText.classList.add('is-invalid');
            isValid = false;
        } else {
            questionText.classList.remove('is-invalid');
        }

        // Check if question score is provided
        if (!questionScore.value.trim()) {
            questionScore.classList.add('is-invalid');
            isValid = false;
        } else {
            questionScore.classList.remove('is-invalid');
        }

        // Check if at least one option is provided
        const hasValidOption = Array.from(optionInputs).some(input => input.value.trim());
        if (!hasValidOption) {
            optionInputs.forEach(input => input.classList.add('is-invalid'));
            isValid = false;
        } else {
            optionInputs.forEach(input => input.classList.remove('is-invalid'));
        }

        // Ensure that only one correct answer is selected
        const selectedCorrectAnswers = Array.from(correctAnswers).filter(input => input.checked);
        if (selectedCorrectAnswers.length !== 1) {
            correctAnswers.forEach(input => input.classList.add('is-invalid'));
            toastr.warning("pleas one option");
            setTimeout(function () {
            }, 2000);//alert("Please select exactly one correct answer.");

            isValid = false;
        } else {
            correctAnswers.forEach(input => input.classList.remove('is-invalid'));
        }

        if (!isValid) {
            return; // Stop execution if validation fails
        }

        const questionData = {
            questionText: questionText.value.trim(),
            questionScore: parseFloat(questionScore.value),
            options: []
        };

        // Collect options and correct answers
        optionInputs.forEach((input, index) => {
            if (input.value.trim()) {
                questionData.options.push({
                    text: input.value.trim(),
                    is_correct: correctAnswers[index].checked
                });
            }
        });

        // Reset the form fields and Bootstrap validation state
        quizData.questions.push(questionData);
        console.log('Updated Quiz Data:', quizData);

        // Reset the form fields and Bootstrap validation state
        questionForm.reset();
        document.getElementById('options-section').innerHTML = ''; // Clear options

        const table = $('#quizDataTable').DataTable();

        // Add the question to the DataTable
        table.row.add([
            questionData.questionText,
            questionData.questionScore,
            '<button class="btn btn-danger delete-btn">Delete</button>'
        ]).draw();
    });

    // Ensure that only one correct answer can be selected
    document.addEventListener('change', function (event) {
        if (event.target.name === 'is_correct[]') {
            document.querySelectorAll('input[name="is_correct[]"]').forEach(input => {
                if (input !== event.target) {
                    input.checked = false; // Uncheck all other checkboxes
                }
            });
        }
    });



    $('#quizDataTable').on('click', '.delete-btn', function () {
        const row = $(this).closest('tr'); // Get the row where the delete button was clicked
        const rowIndex = row.index(); // Get the index of the row

        // Remove the question from quizData based on the row index
        quizData.questions.splice(rowIndex, 1);

        // Remove the row from the DataTable
        const table = $('#quizDataTable').DataTable();
        table.row(row).remove().draw();

        console.log('Updated Quiz Data after deletion:', quizData);
    });



    // Save quiz data to DataTable and reset the form
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();

    document.getElementById('save-all').addEventListener('click', function (event) {
        event.preventDefault();
        var quizForm = document.getElementById('quizForm');

        // Check form validity using Bootstrap validation
        if (!quizForm.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            quizForm.classList.add('was-validated');
            return; // Stop execution if validation fails
        }

        // Validate that passing marks are less than total marks
        const passingMark = document.getElementById('passing_mark');
        const totalMarks = document.getElementById('total_marks');

        if (parseFloat(passingMark.value) >= parseFloat(totalMarks.value)) {
            passingMark.classList.add('is-invalid');
            passingMark.nextElementSibling.textContent = "Passing marks must be less than total marks.";
            return;
        } else {
            passingMark.classList.remove('is-invalid');
        }

        // Validate that the total score of all questions matches the total marks
        const totalScore = quizData.questions.reduce((sum, question) => sum + question.questionScore, 0);
        if (totalScore !== parseFloat(totalMarks.value)) {
            toastr.warning("Total score of questions must match total marks.");
            return;
        }

        // Log the quiz data to the console
        console.log('Quiz Data:', quizData);
        testdata = quizData;

        // Send data to server
        $.ajax({
            url: '{{route('test.store')}}', // Replace with actual endpoint
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify(quizData),
            success: function (response) {
                console.log(response.message);
                console.log("testdata", testdata);

                // Reset the form and validation state
                //quizForm.reset();
                quizForm.classList.remove('was-validated');
                document.getElementById('questionForm').reset();
                // quizData = { title: '', passingMark: '', totalTime: '', questions: [] };
                $('#add_quiz_model').modal('hide');
                toastr.success("Quiz created successfully");
                setTimeout(function () {
                    location.reload();
                }, 2000);
                // $('#quizDataTable').DataTable().clear().draw();
            },
            error: function (xhr, status, error) {
                console.error(error);
                toastr.error("Error saving quiz data. Please try again.");
            }
        });
    });

</script>
<script>
    $('#testTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('test.index') }}' // Update with the correct route
                        columns: [
            {
                data: 'test_title',
                name: 'test_title'
            },
            {
                data: 'passing_mark',
                name: 'passing_mark'
            },
            {
                data: 'total_marks',
                name: 'total_marks'
            },
            {
                data: 'time',
                name: 'time'
            },
            {
                data: 'questions',
                name: 'questions',
                orderable: false,
                searchable: false
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });
</script>