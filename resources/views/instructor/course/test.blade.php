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
                                        <form id="quizForm" method="POST">
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
                                                <div class="mt-4 text-end">
                                                    <button type="button" class="main-btn color btn-hover"
                                                        id="save-quiz">
                                                        Save Quiz
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <form id="questionForm">
                                            @csrf
                                            {{-- question --}}
                                            <div class="question-section" id="question">
                                                <div class="form_group mt-30">
                                                    <label class="label25 text-left">Question Title*</label>
                                                    <input class="form_input_1" type="text" id="question_text"
                                                        name="question_text" placeholder="Write question title">
                                                </div>
                                                <div class="form_group mt-30">
                                                    <label class="label25 text-left">Score*</label>
                                                    <input class="form_input_1" type="number" name="question_score"
                                                        placeholder="Score">
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
                                                                    <input class="form_input_1" type="text"
                                                                        name="option_text[]" placeholder="Option title">
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
                                                        <div class="col-sm-6 text-right">
                                                            <button type="button" class="main-btn color btn-hover mt-30"
                                                                id="add-option-btn">Add Option</button>
                                                        </div>
                                                        <div
                                                            class="col-sm-6 text-end share-submit-btns ps-0 pb-0 mb-4 text-end">
                                                            <button type="button" class="main-btn color btn-hover"
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
                                                    <th>Quiz Title</th>
                                                    <th>Passing Marks</th>
                                                    <th>Total Time</th>
                                                    <th>Questions</th>
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
<script>
    let quizData = {
        title: '',
        passingMark: '',
        totalTime: '',
        questions: []
    };

    document.getElementById('save-quiz').addEventListener('click', function () {
        // Save quiz data
        quizData.title = document.getElementById('test_title').value;
        quizData.passingMark = document.getElementById('passing_mark').value;
        quizData.totalTime = document.getElementById('time').value;

        // Log the quiz data to the console
        console.log('Quiz Data:', quizData);
    });

    document.getElementById('add-option-btn').addEventListener('click', function () {
        // Create a new option item
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
            <input class="form_input_1" type="text" name="option_text[]" placeholder="Option title">
        </div>
        <div class="agree_checkbox">
            <input type="checkbox" name="is_correct[]">
            <label>Correct answer</label>
        </div>
    </div>
</div>
`;

        // Append the new option item to the options section
        document.getElementById('options-section').appendChild(optionItem);

        // Add event listener to the delete button
        optionItem.querySelector('.opt-del').addEventListener('click', function () {
            optionItem.remove();
        });
    });

    document.getElementById('saveBtn').addEventListener('click', function () {
        // Gather question data
        const questionData = {
            questionText: document.querySelector('input[name="question_text"]').value,
            questionScore: document.querySelector('input[name="question_score"]').value,
            options: []
        };

        // Gather options
        const optionInputs = document.querySelectorAll('input[name="option_text[]"]');
        const correctAnswers = document.querySelectorAll('input[name="is_correct[]"]');

        optionInputs.forEach((input, index) => {
            questionData.options.push({
                text: input.value,
                is_correct: correctAnswers[index].checked
            });
        });

        // Add question data to quizData
        quizData.questions.push(questionData);

        // Log the updated quiz data to the console
        console.log('Updated Quiz Data:', quizData);

        // Clear the question and options after saving
        document.querySelector('input[name="question_text"]').value = '';
        document.querySelector('input[name="question_score"]').value = '';
        document.getElementById('options-section').innerHTML = ''; // Clear options
    });

    document.getElementById('save-all').addEventListener('click', function () {
        // Add the quiz data to the DataTable
        const table = $('#quizDataTable').DataTable();
        const questionTitles = quizData.questions.map(q => q.questionText).join(', ');

        table.row.add([
            quizData.title,
            quizData.passingMark,
            quizData.totalTime,
            questionTitles,
            `<button class="btn btn-warning edit-btn">Edit</button> 
            <button class="btn btn-danger delete-btn">Delete</button>`
        ]).draw();

        // Clear the quiz data variable
        quizData = {
            title: '',
            passingMark: '',
            totalTime: '',
            questions: []
        };

        // Clear the form fields
        document.getElementById('quizForm').reset();
        document.getElementById('questionForm').reset();
    });

    // Event listener for the Edit and Delete buttons
    let editIndex = null; // Store the index of the row being edited

    $(document).on('click', '.edit-btn', function () {
        const row = $(this).closest('tr');
        const rowData = $('#quizDataTable').DataTable().row(row).data();

        // Fill the form with the data to edit
        document.getElementById('test_title').value = rowData[0];
        document.getElementById('passing_mark').value = rowData[1];
        document.getElementById('time').value = rowData[2];
        document.getElementById('question_text').value = rowData[3];

        // Store the index of the row for later update
        editIndex = $('#quizDataTable').DataTable().row(row).index();

        // Remove the row (optional, if you want to edit in the same place)
        $('#quizDataTable').DataTable().row(row).remove().draw();
    });


    $(document).on('click', '.delete-btn', function () {
        // Delete the row from the DataTable
        const row = $(this).closest('tr');
        $('#quizDataTable').DataTable().row(row).remove().draw();
    });

    $(document).ready(function () {
        $('#quizDataTable').DataTable({
            processing: true,
            serverSide: false, // Set to false since we're adding data manually
            columns: [
                { title: "Quiz Title" },
                { title: "Passing Marks" },
                { title: "Total Time" },
                { title: "Questions" },
                { title: "Actions" }
            ]
        });
    });
</script>