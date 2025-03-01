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
            <div class="curriculum-section mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <table id="quizTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Quiz Title</th>
                                    <th>Passing Marks</th>
                                    <th>Total Marks</th>
                                    <th>Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be populated by DataTable via AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
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
                                        <form id="quizForm" method="POST" class="needs-validation" novalidate>
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
                                        <div class="mt-4 text-end">
                                            <button type="button" class="main-btn color btn-hover" id="save-all">
                                                <i class="fas fa-save me-2"></i>Save All
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

<!-- Edit Quiz Modal -->
<div class="modal fade" id="editQuizModal" tabindex="-1" role="dialog" aria-labelledby="editQuizModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editQuizModalLabel">Edit Quiz</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="editQuizForm" class="needs-validation" novalidate>
                    @csrf
                    {{-- @method('PUT') <!-- Use PUT method for updating --> --}}
                    @if (isset($course))
                        <input type="hidden" name="course_id" id='course_id' value="{{ $course->id }}">
                    @endif 

                    <input type="hidden" name="quiz_id" id="quiz_id">

                    <div class="form_group mt-30">
                        <label class="label25">Quiz Title*</label>
                        <input class="form_input_1 form-control" type="text" name="test_title" id="edit_test_title"
                            placeholder="Title here" required>
                        <div class="invalid-feedback" id="edit_test_title_error">Please enter quiz title.</div>
                    </div>

                    <div class="row">
                        <div class="ui search focus lbel25 mt-30 col-sm-4">
                            <label>Passing Marks*</label>
                            <input class="form_input_1 form-control" type="text" name="passing_mark"
                                id="edit_passing_mark" placeholder="Passing Mark here" required>
                            <div class="invalid-feedback" id="edit_passing_mark_error">Passing marks below than total
                                marks</div>
                        </div>

                        <div class="ui search focus lbel25 mt-30 col-sm-4">
                            <label>Total Marks*</label>
                            <input class="form_input_1 form-control" type="text" name="total_marks"
                                id="edit_total_marks" placeholder="Total marks here" required>
                            <div class="invalid-feedback" id="edit_total_marks_error">Please enter total marks.</div>
                        </div>

                        <div class="ui search focus lbel25 mt-30 col-sm-4">
                            <label>Total Time*</label>
                            <input class="form_input_1 form-control" type="text" name="time" id="edit_time"
                                placeholder="Time here" required>
                            <div class="invalid-feedback" id="edit_time_error">Please enter total time.</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="main-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="main-btn" id="saveChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        // Initialize the DataTable
        $('#quizTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('test.index') }}',
            columns: [
                { data: 'test_title', name: 'test_title' },
                { data: 'passing_mark', name: 'passing_mark' },
                { data: 'total_marks', name: 'total_marks' },
                { data: 'time', name: 'time' },
                {
                    data: 'id',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `
                        <a class="btn-sm edit-quiz" data-id="${data}"> <i class="uil uil-edit-alt ucp-table"></i></a>
                        <a class="btn-sm delete-quiz" data-id="${data}"><i class="uil uil-trash-alt ucp-table"></i></a>`;
                    }
                }
            ]
        });

        // Handle the edit button click
        $('#quizTable').on('click', '.edit-quiz', function () {
            var quizId = $(this).data('id'); // Get the quiz ID
            // Perform an AJAX request to fetch the quiz data
            $.ajax({
                url: '{{route('test.show', '')}}/' + quizId,
                method: 'GET',
                success: function (response) {
                    // Populate the modal fields with the response data
                    $('#quiz_id').val(response.id);
                    $('#edit_test_title').val(response.test_title);
                    $('#edit_passing_mark').val(response.passing_mark);
                    $('#edit_total_marks').val(response.total_marks);
                    $('#edit_time').val(response.time);

                    // Show the modal
                    $('#editQuizModal').modal('show');
                },
                error: function (xhr, status, error) {
                    toastr.error('An error occurred while fetching quiz data.', 'Error');
                }
            });
        });

        // Handle the save changes button click
        $('#saveChanges').on('click', function (event) {
            var form = $('#editQuizForm')[0]; // Get the form element
            var quizId = $('#quiz_id').val(); // Get the quiz ID

            // Apply Bootstrap validation
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                $(form).addClass('was-validated');
                return; // Stop execution if validation fails
            }

            // Custom validation
            var isValid = true;
            var totalMarks = parseFloat($('#edit_total_marks').val());
            var passingMarks = parseFloat($('#edit_passing_mark').val());
            var title = $('#edit_test_title').val().trim();
            var time = $('#edit_time').val().trim();

            // Check if title and time are required
            if (!title) {
                $('#edit_test_title').addClass('is-invalid');
                $('#edit_test_title_error').show();
                isValid = false;
            } else {
                $('#edit_test_title').removeClass('is-invalid');
                $('#edit_test_title_error').hide();
            }

            if (!time) {
                $('#edit_time').addClass('is-invalid');
                $('#edit_time_error').show();
                isValid = false;
            } else {
                $('#edit_time').removeClass('is-invalid');
                $('#edit_time_error').hide();
            }

            // Check if passing marks are greater than total marks
            if (passingMarks > totalMarks || isNaN(passingMarks) || isNaN(totalMarks)) {
                $('#edit_passing_mark').addClass('is-invalid');
                $('#edit_passing_mark_error').show();
                isValid = false;
            } else {
                $('#edit_passing_mark').removeClass('is-invalid');
                $('#edit_passing_mark_error').hide();
            }

            // If validation fails, stop execution
            if (!isValid) {
                return;
            }

            // Proceed with AJAX request if everything is valid
            $.ajax({
                url: '{{route('test.update', '')}}/' + quizId,
                method: 'PUT',
                data: $('#editQuizForm').serialize(),
                success: function (response) {
                    // Update the DataTable and close the modal
                    $('#quizTable').DataTable().ajax.reload();
                    $('#editQuizModal').modal('hide');
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
        $('#quizTable').on('click', '.delete-quiz', function () {
            var quizId = $(this).data('id'); // Get the quiz ID
            var row = $(this).closest('tr'); // Get the row of the clicked button

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
                            // If successful, remove the row from the table
                            row.fadeOut(500, function () {
                                $(this).remove();
                            });
                            toastr.success('Quiz Deleted successfully');
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
    // // Bootstrap Form Validation
    // (function () {
    //     'use strict';
    //     var forms = document.querySelectorAll('.needs-validation');

    //     Array.prototype.slice.call(forms).forEach(function (form) {
    //         form.addEventListener('submit', function (event) {
    //             if (!form.checkValidity()) {
    //                 event.preventDefault();
    //                 event.stopPropagation();
    //             }
    //             form.classList.add('was-validated');
    //         }, false);
    //     });
    // })();

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
    document.getElementById('saveBtn').addEventListener('click', function (event) {
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

        if (!isValid) {
            return; // Stop execution if validation fails
        }

        // Assign quiz details
        quizData.course_id = document.getElementById('course_id').value;
        quizData.title = document.getElementById('test_title').value;
        quizData.passingMark = document.getElementById('passing_mark').value;
        quizData.totalmarks = document.getElementById('total_marks').value;
        quizData.totalTime = document.getElementById('time').value;

        const questionData = {
            questionText: questionText.value.trim(),
            questionScore: parseFloat(questionScore.value),
            options: []
        };

        // Collect options and correct answers
        const correctAnswers = document.querySelectorAll('input[name="is_correct[]"]');
        optionInputs.forEach((input, index) => {
            if (input.value.trim()) {
                questionData.options.push({
                    text: input.value.trim(),
                    is_correct: correctAnswers[index].checked
                });
            }
        });

        quizData.questions.push(questionData);
        console.log('Updated Quiz Data:', quizData);

        // Reset the form fields and Bootstrap validation state
        questionForm.reset();
        questionForm.classList.remove('was-validated');
        document.getElementById('options-section').innerHTML = ''; // Clear options

        const table = $('#quizDataTable').DataTable();

        // Add the question to the DataTable
        table.row.add([
            questionData.questionText,
            questionData.questionScore,
            '<button class="btn btn-warning edit-btn">Edit</button>' +
            '<button class="btn btn-danger delete-btn">Delete</button>'
        ]).draw();
    });


    // Event listeners for Edit and Delete buttons
    let editIndex = null;

    $(document).on('click', '.edit-btn', function () {
        const row = $(this).closest('tr');
        const rowData = $('#quizDataTable').DataTable().row(row).data();

        // Get the question data from the row
        const questionText = rowData[0]; // Question text (first column)
        const questionScore = rowData[1]; // Question score (second column)

        // Set the values in the form
        document.getElementById('question_text').value = questionText;
        document.getElementById('question_score').value = questionScore;

        // Get the index of the question in the quizData array
        editIndex = $('#quizDataTable').DataTable().row(row).index();

        // Get the corresponding question object from the quizData array
        const questionData = quizData.questions[editIndex];

        // Clear any existing options in the form
        document.getElementById('options-section').innerHTML = '';

        // Populate the options in the form
        questionData.options.forEach(option => {
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
                        <input class="form_input_1" type="text" name="option_text[]" placeholder="Option title" value="${option.text}" required>
                        <div class="invalid-feedback">Please enter option title.</div>
                    </div>
                    <div class="agree_checkbox">
                        <input type="checkbox" name="is_correct[]" ${option.is_correct ? 'checked' : ''}>
                        <label>Correct answer</label>
                    </div>
                </div>
            </div>
        `;
            document.getElementById('options-section').appendChild(optionItem);

            // Add delete event for this option
            optionItem.querySelector('.opt-del').addEventListener('click', function () {
                optionItem.remove();
            });
        });

        // Remove the question from quizData and the DataTable
        $('#quizDataTable').DataTable().row(row).remove().draw();
        quizData.questions.splice(editIndex, 1);

        // Reset editIndex after deleting the question
        editIndex = null;
    });


    $(document).on('click', '.delete-btn', function () {
        const row = $(this).closest('tr');
        const rowData = $('#quizDataTable').DataTable().row(row).data();

        // Find the index of the question in quizData
        const questionText = rowData[0]; // Assuming questionText is in the first column
        const questionIndex = quizData.questions.findIndex(q => q.questionText === questionText);

        if (questionIndex !== -1) {
            // Remove the question from quizData
            quizData.questions.splice(questionIndex, 1);
        }

        // Remove the row from DataTable
        $('#quizDataTable').DataTable().row(row).remove().draw();

        console.log('Updated Quiz Data:', quizData);
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

        // Send data to server
        $.ajax({
            url: '{{route('test.store')}}', // Replace with actual endpoint
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify(quizData),
            success: function (response) {
                console.log(response.message);
                toastr.success("Quiz created successfully");

                // Reset the form and validation state
                quizForm.reset();
                quizForm.classList.remove('was-validated');
                document.getElementById('questionForm').reset();
                quizData = { title: '', passingMark: '', totalTime: '', questions: [] };
                $('#quizDataTable').DataTable().clear().draw();
            },
            error: function (xhr, status, error) {
                console.error(error);
                toastr.error("Error saving quiz data. Please try again.");
            }
        });
    });

</script>