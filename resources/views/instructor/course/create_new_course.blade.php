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
    pointer-events: none; /* Prevent clicking */
    opacity: 0.5; /* Make it look inactive */
    cursor: not-allowed; /* Show not-allowed cursor */
}
</style>
<script>
$(document).ready(function () {
    // Disable all tabs except the first one
    $(".step-steps li:not(:first)").addClass("disabled");
    
    // if ('{{ session('success') }}') {
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
    {{-- @endsection --}}