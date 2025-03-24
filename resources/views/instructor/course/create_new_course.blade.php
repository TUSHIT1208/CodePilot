@include('instructor.layouts.master')
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
                                @include('instructor.course.basic_information') 									    
                                @include('instructor.course.test')
                                @include('instructor.course.media')								
                                @include('instructor.course.price')								
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

                                </div>
                            </div>
                            <div class="step-footer step-tab-pager mb-3">
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
    <style>
        .step-steps li.disabled {
            pointer-events: none;
            /* Prevent clicking */
            opacity: 0.5;
            /* Make it look inactive */
            cursor: not-allowed;
            /* Show not-allowed cursor */
        }
        .loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.6);
            /* Dark background */
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loader {
            width: 48px;
            height: 48px;
            position: absolute;
            top: 50%;
            /* Center vertically */
            left: 50%;
            /* Center horizontally */
            transform: translate(-50%, -50%);
            /* Adjust positioning to center perfectly */
        }

        .loader:before {
            content: '';
            width: 48px;
            height: 5px;
            background: #dc354580;
            /* Red with opacity */
            position: absolute;
            top: 60px;
            left: 0;
            border-radius: 50%;
            animation: shadow324 0.5s linear infinite;
        }

        .loader:after {
            content: '';
            width: 100%;
            height: 100%;
            background: #ed2a26;
            /* 🔴 Red color */
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 4px;
            animation: jump7456 0.5s linear infinite;
        }

        @keyframes jump7456 {
            15% {
                border-bottom-right-radius: 3px;
            }

            25% {
                transform: translateY(9px) rotate(22.5deg);
            }

            50% {
                transform: translateY(18px) scale(1, .9) rotate(45deg);
                border-bottom-right-radius: 40px;
            }

            75% {
                transform: translateY(9px) rotate(67.5deg);
            }

            100% {
                transform: translateY(0) rotate(90deg);
            }
        }

        @keyframes shadow324 {

            0%,
            100% {
                transform: scale(1, 1);
            }

            50% {
                transform: scale(1.2, 1);
            }
        }

        .blurred {
            filter: blur(4px);
            pointer-events: none;
        }
    </style>
    <script>
        $(document).ready(function () {


            // Disable all tabs except the first one
            $(".step-steps li:not(:first)").addClass("disabled");

            if (window.location.pathname.endsWith("/edit")) {
                $(".step-steps li").removeClass("disabled");
            };
        });

    </script>



    {{-- hide button --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Select all buttons inside the step-footer
            var buttons = document.querySelectorAll('.step-footer .main-btn');
            buttons.forEach(function (button) {
                button.style.visibility = "hidden"; // Hide each button
            });
        });


        // Initialize CKEditor instances
        // ClassicEditor.create(document.querySelector('#editor1'))
        //     .then(editor => {
        //         window.editor1 = editor;
        //     })
        //     .catch(err => {
        //         console.error(err.stack);
        //     });
        // Steps wizard initialization
        $('#add-course-tab').steps({
            onFinish: function () {
                alert('Course Completed');
                window.location.href = "{{ route('course.index') }}";
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
            // if ('{{ session('success') }}') {
            //     // Trigger the next button automatically after receiving success
            //     $('#add-course-tab .step-footer button[data-direction="next"]').click();
            // }



            if ('{{ session('success') }}') {

                $('#add-course-tab .step-footer button[data-direction="next"]').click();

            }
            if (window.location.pathname.endsWith("/edit")) {
                // Trigger the next button automatically after receiving success
                var buttons = document.querySelectorAll('.step-footer .main-btn');
                buttons.forEach(function (button) {
                    button.style.visibility = "visible"; // Hide each button
                });
            }


            if (course) {
                $('#add-course-tab .step-footer button[data-direction="prev"]').click();
            }


        });
    </script>