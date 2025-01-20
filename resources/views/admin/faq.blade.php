@include('admin.layouts.master')
<!-- Body Start -->
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="st_title"><i class="uil uil-question-circle"></i> Frequently Asked Questions (FAQ)</h2>
                </div>
            </div>
            <!-- Add Question Button -->
            <div class="row mt-4">
                <div class="col-lg-12 text-end">
                    <a data-bs-toggle="modal" data-bs-target="#addFaqModal" class="upload_btn" title="Add a Question">
                        <i class="uil uil-plus-circle"></i> Add a Question
                    </a>
                </div>
            </div>
            <!-- FAQ List -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="accordion" id="faqAccordion">
                        <!-- Example FAQ Item -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                    <i class="uil uil-info-circle"></i> How do I create a new course?
                                </button>
                            </h2>
                            <div id="faqCollapse1" class="accordion-collapse collapse show footer" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>To create a new course, click on the "Create Your Course" button on the dashboard, fill in the required details, and submit your course for review.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Add more FAQs dynamically here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding FAQ -->
    <div class="modal fade" id="addFaqModal" tabindex="-1" aria-labelledby="addFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFaqModalLabel"><i class="uil uil-plus-circle"></i> Add a New FAQ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" class="form-control" id="question" name="question" placeholder="Enter the FAQ question" required>
                            @error('question')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="answer" class="form-label">Answer</label>
                            <textarea class="form-control" id="answer" name="answer" rows="4" placeholder="Enter the FAQ answer" required></textarea>
                            @error('answer')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="upload_btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="upload_btn">Add FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('admin.footer')
</div>
<!-- Body End -->

