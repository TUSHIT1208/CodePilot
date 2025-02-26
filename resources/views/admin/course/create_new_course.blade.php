@include('admin.layouts.master')
{{-- @section('title') Course @endsection
@section('content') --}}
<div class="wrapper">
    <div class="sa4d25">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="st_title"><i class="uil uil-analysis"></i> Create New Course</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="course_tabs_1">
                        <div id="add-course-tab" class="step-app">
                            <ul class="step-steps">
                                <li class="active">
                                    <a href="#tab_step1">
                                        <span class="number"></span>
                                        <span class="step-name">Basic</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_step2">
                                        <span class="number"></span>
                                        <span class="step-name">Curriculum</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_step3">
                                        <span class="number"></span>
                                        <span class="step-name">Media</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_step4">
                                        <span class="number"></span>
                                        <span class="step-name">Price</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_step5">
                                        <span class="number"></span>
                                        <span class="step-name">Publish</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="step-content">
                                @include('admin.course.basic_information') 									    
                                @include('admin.course.test')
                                @include('admin.course.media')								
                                @include('admin.course.price')								
                                <div class="step-tab-panel step-tab-location" id="tab_step5">
                                    <div class="tab-from-content">
                                        <div class="title-icon">
                                            <h3 class="title"><i class="uil uil-upload"></i>Submit</h3>
                                        </div>
                                    </div>
                                    <div class="publish-block">
                                        <i class="far fa-edit"></i>
                                        <p>Your course is in a draft state. Students cannot view, purchase or enroll in
                                            this course. For students that are already enrolled, this course will not
                                            appear on their student Dashboard.</p>
                                    </div>
                                    <div class="mt-5 row">
                                        <div class="col-lg-6">
                                            {{-- @if (request()->route('course'))
                                            <a href="{{ route('course.edit', ['course' => request()->route('course')]) }}"
                                                class="upload_btn">
                                                Previous
                                            </a>
                                            @endif --}}
                                        </div>
                                        <div class="col-lg-6 text-end">
                                            <button id="final_submit" class="main-btn">Submit for Review</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step-footer step-tab-pager">
                                <button data-direction="prev" class="main-btn">PREVIOUS</button>
                                <button data-direction="next" class="main-btn">Next</button>
                                <button data-direction="finish" class="main-btn">Submit for Review</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- hide button --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Select all buttons inside the step-footer
            var buttons = document.querySelectorAll('.step-footer .main-btn');

            buttons.forEach(function (button) {
                button.style.visibility = "hidden"; // Hide each button
            });
        });

        // step_js
        // document.addEventListener("DOMContentLoaded", function () {
        //     var stepLinks = document.querySelectorAll(".step-steps li a");

        //     stepLinks.forEach(function (link) {
        //         link.addEventListener("click", function (event) {
        //             var isBasicCompleted = sessionStorage.getItem("basic_completed");

        //             if (!isBasicCompleted && link.getAttribute("href") !== "#tab_step1") {
        //                 event.preventDefault();
        //                 alert("Please complete the Basic Information step first.");

        //                 // Forcefully redirect to Basic tab after alert
        //                 setTimeout(function () {
        //                     document.querySelector('[href="#tab_step1"]').click();
        //                 }, 0);
        //             }
        //         });
        //     });

        //     document.getElementById("basic_form").addEventListener("submit", function () {
        //         sessionStorage.setItem("basic_completed", "true");
        //     });
        // });
        // Initialize CKEditor instances
        ClassicEditor.create(document.querySelector('#editor1'))
            .then(editor => {
                window.editor1 = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
        // Steps wizard initialization
        $('#add-course-tab').steps({
            onFinish: function () {
                alert('Course Completed');

            }
        });

        // Make sortable
        $(function () {
            $(".sortable").sortable();
            $(".sortable").disableSelection();
        });

        // Triggering the next button for both Basic Information and Course Creation
        $(document).ready(function () {
            // Check if the success message exists in the session (after redirect)
            if ('{{ session('success') }}') {
                // Trigger the next button automatically after receiving success
                $('#add-course-tab .step-footer button[data-direction="next"]').click();
            }
            $('#test_next').click(function () {
                $('#add-course-tab .step-footer button[data-direction="next"]').click();
            });

            $('#basic_next').click(function () {
                $('#add-course-tab .step-footer button[data-direction="next"]').click();
            });

            $('#media_next').click(function () {
                $('#add-course-tab .step-footer button[data-direction="next"]').click();
            });

            $('#price_next').click(function () {
                $('#add-course-tab .step-footer button[data-direction="next"]').click();
            });

            $('#final_submit').click(function () {
                $('#add-course-tab .step-footer button[data-direction="finish"]').click();
            });

            if (course) {
                $('#add-course-tab .step-footer button[data-direction="prev"]').click();
            }


        });
    </script>
    {{-- @endsection --}}