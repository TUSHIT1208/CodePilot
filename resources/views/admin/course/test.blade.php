<div class="step-tab-panel step-tab-gallery" id="tab_step2">
    <div class="tab-from-content">
        <div class="title-icon">
            <h3 class="title"><i class="uil uil-notebooks"></i>Test</h3>
        </div>
        <div class="curriculum-section">
            <div class="row">
                <div class="col-md-12">
                    {{-- <div class="curriculum-add-item">
                        <h4 class="section-title mt-0"><i class="fas fa-th-list me-2"></i>Curriculum</h4>
                        <button class="main-btn color btn-hover ml-left add-section-title" data-bs-toggle="modal"
                            data-bs-target="#add_section_model">New Section</button>
                    </div> --}}
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
                            {{-- <div class="section-list-item">
                                <div class="section-item-title">
                                    <i class="fas fa-file-alt me-2"></i>
                                    <span class="section-item-title-text">lecture Title</span>
                                </div>
                                <button type="button" class="section-item-tools"><i class="fas fa-edit"></i></button>
                                <button type="button" class="section-item-tools"><i
                                        class="fas fa-trash-alt"></i></button>
                                <button type="button" class="section-item-tools ml-auto"><i
                                        class="fas fa-bars"></i></button>
                            </div> --}}
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
                            {{-- <button class="add_lecture" data-bs-toggle="modal"
                                data-bs-target="#add_lecture_model"><i
                                    class="far fa-plus-square me-2"></i>Lecture</button> --}}
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

{{-- add quiz and & W --}}
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
                                        <div class="new-section">
                                            <div class="form_group mt-30">
                                                <label class="label25">Quiz Title*</label>
                                                <input class="form_input_1" type="text" placeholder="Title here">
                                            </div>
                                        </div>
                                        <div class="ui search focus lbel25 mt-30">
                                            <label>Description*</label>
                                            <div class="text-editor">
                                                <div id="editor3"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-questions" role="tabpanel">
                                        <div class="lecture-video-dt mt-30">
                                            <div class="add-ques-dt">
                                                <button type="button" class="main-btn color btn-hover w-100"
                                                    data-bs-toggle="collapse" data-bs-target="#add-ques"><i
                                                        class="far fa-plus-square me-2"></i>Add Question</button>
                                                <div id="add-ques" class="collapse">
                                                    <div class="lecture-video-dt mt-30">
                                                        <span class="video-info">Question Type</span>
                                                        <div class="video-category">
                                                            <label><input type="radio" name="colorRadio"
                                                                    value="schoice"><span><i
                                                                        class="far fa-dot-circle me-2"></i>Single
                                                                    Choice</span></label>
                                                            <label><input type="radio" name="colorRadio"
                                                                    value="mchoice"><span><i
                                                                        class="far fa-check-circle me-2"></i>Multiple
                                                                    Choice</span></label>
                                                            <label><input type="radio" name="colorRadio"
                                                                    value="sline"><span><i
                                                                        class="far fa-edit me-2"></i>Single Line
                                                                    Text</span></label>
                                                            <label><input type="radio" name="colorRadio"
                                                                    value="mline"><span><i
                                                                        class="far fa-file-alt me-2"></i>Milti Line
                                                                    Text</span></label>
                                                            <div class="schoice quiz-box">
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
                                                                                        id="thumbnail_source">
                                                                                    <label class="mx-0 my-0"
                                                                                        for="thumbnail_source"
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
                                                                                            id="check1">
                                                                                        <label for="check1">Correct
                                                                                            answer</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mchoice quiz-box">
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
                                                                                        id="thumbnail_source1">
                                                                                    <label class="mx-0 my-0"
                                                                                        for="thumbnail_source1"
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
                                                </div>
                                                <div class="added-ques">
                                                    <div class="section-group-list ps-0 pe-0 sortable">
                                                        <div class="section-list-item">
                                                            <div class="section-item-title">
                                                                <i class="far fa-dot-circle me-2"></i>
                                                                <span class="section-item-title-text">Question
                                                                    Title</span>
                                                            </div>
                                                            <button type="button" class="section-item-tools"><i
                                                                    class="fas fa-edit"></i></button>
                                                            <button type="button" class="section-item-tools"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                            <button type="button" class="section-item-tools ml-auto"><i
                                                                    class="fas fa-bars"></i></button>
                                                        </div>
                                                        <div class="section-list-item">
                                                            <div class="section-item-title">
                                                                <i class="far fa-check-circle me-2"></i>
                                                                <span class="section-item-title-text">Question
                                                                    Title</span>
                                                            </div>
                                                            <button type="button" class="section-item-tools"><i
                                                                    class="fas fa-edit"></i></button>
                                                            <button type="button" class="section-item-tools"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                            <button type="button" class="section-item-tools ml-auto"><i
                                                                    class="fas fa-bars"></i></button>
                                                        </div>
                                                        <div class="section-list-item">
                                                            <div class="section-item-title">
                                                                <i class="far fa-edit me-2"></i>
                                                                <span class="section-item-title-text">Question
                                                                    Title</span>
                                                            </div>
                                                            <button type="button" class="section-item-tools"><i
                                                                    class="fas fa-edit"></i></button>
                                                            <button type="button" class="section-item-tools"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                            <button type="button" class="section-item-tools ml-auto"><i
                                                                    class="fas fa-bars"></i></button>
                                                        </div>
                                                        <div class="section-list-item">
                                                            <div class="section-item-title">
                                                                <i class="far fa-file-alt me-2"></i>
                                                                <span class="section-item-title-text">Question
                                                                    Title</span>
                                                            </div>
                                                            <button type="button" class="section-item-tools"><i
                                                                    class="fas fa-edit"></i></button>
                                                            <button type="button" class="section-item-tools"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                            <button type="button" class="section-item-tools ml-auto"><i
                                                                    class="fas fa-bars"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="main-btn cancel" data-bs-dismiss="modal">Close</button>
                <button type="button" class="main-btn">Add Quiz</button>
            </div>
        </div>
    </div>
</div>


<!-- Add Assignment Start and & W-->
<div class="modal fade" id="add_assignment_model" tabindex="-1" aria-labelledby="lectureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lectureModalLabel">Add Assignment</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="new-section-block main-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="new-section">
                                <div class="form_group">
                                    <label class="label25">Assignment Title*</label>
                                    <input class="form_input_1" type="text" placeholder="Assignment title here">
                                </div>
                                <div class="form_group mt-30">
                                    <label class="label25">Description*</label>
                                    <div class="text-editor">
                                        <div id="editor4"></div>
                                    </div>
                                </div>
                                <div class="form_group mt-30">
                                    <div class="row g-4">
                                        <div class="col-lg-4 mt-30">
                                            <label class="label25">Time Duration*</label>
                                            <div class="row no-gutters">
                                                <div class="col-6">
                                                    <input class="form_input_1" type="number" value="0" placeholder="">
                                                </div>
                                                <div class="col-6 pl-2">
                                                    <select
                                                        class="ui hj145 dropdown cntry152 assignment prompt srch_explore">
                                                        <option value="">Select</option>
                                                        <option>Weeks</option>
                                                        <option>Days</option>
                                                        <option>Hours</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <span class="alt-text">Assignment time duration, set 0 for no limit.</span>
                                        </div>
                                        <div class="col-lg-4 mt-30">
                                            <label class="label25">Total Number*</label>
                                            <input class="form_input_1" type="number" value="10" placeholder="">
                                            <span class="alt-text">Maximum points a student can score</span>
                                        </div>
                                        <div class="col-lg-4 mt-30">
                                            <label class="label25">Minimum Pass Number*</label>
                                            <input class="form_input_1" type="number" value="5" placeholder="">
                                            <span class="alt-text">Minimum points required for the student to pass this
                                                assignment.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="assgn152 mt-30 pt-30">
                                    <div class="row g-6">
                                        <div class="col-lg-6 mt-30">
                                            <label class="label25">Upload attachment limit*</label>
                                            <input class="form_input_1" type="text" value="1" placeholder="">
                                            <span class="alt-text">Maximum attachment size limit</span>
                                        </div>
                                        <div class="col-lg-6 mt-30">
                                            <label class="label25">Maximum attachment size limit</label>
                                            <input class="form_input_1" type="text" value="10" placeholder="">
                                            <span class="alt-text">Define maximum attachment size in MB</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="upload-file-dt mt-30">
                                    <div class="upload-btn">
                                        <input class="uploadBtn-main-input" type="file"
                                            id="AssignmentFile__input--source">
                                        <label for="AssignmentFile__input--source" title="Zip"><i
                                                class="far fa-plus-square me-2"></i>Attachment</label>
                                    </div>
                                    <span class="uploadBtn-main-file">Supports: jpg, jpeg, png, pdf or .zip</span>
                                    <div class="add-attachments-dt">
                                        <div class="attachment-items">
                                            <div class="attachment_id">Uploaded ID: 5</div>
                                            <button class="cancel-btn" type="button"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </div>
                                        <div class="attachment-items">
                                            <div class="attachment_id">Uploaded ID: 6</div>
                                            <button class="cancel-btn" type="button"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="main-btn cancel" data-bs-dismiss="modal">Close</button>
                <button type="button" class="main-btn">Add Assignment</button>
            </div>
        </div>
    </div>
</div>
<!-- Add Assignment End -->