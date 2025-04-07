@extends('learner.course.certificate.master')

@section('title')
    Certificate Exam
@endsection

@section('content')
    <div class="wrapper _bg4586 _new89">
        <div class="_215b15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title125">
                            <div class="titleleft">
                                <div class="ttl121">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active" aria-current="page"><a
                                                    href="{{ route('learner.dashboard') }}">Home</a>
                                            </li>
                                            <li class="breadcrumb-item"><a
                                                    href="{{ route('certificate.center') }}">Certificate Center</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Test View</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                            <div class="titleright"><a href="{{ route('certificate.center') }}" class="blog_link"><i
                                        class="uil uil-angle-double-left"></i>Back to Certification Center</a></div>
                        </div>
                        <div class="title126">
                            <h2>Test View</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="faq1256">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="certi_form rght1528">
                        <div class="test_timer_bg">
                            <ul class="test_timer_left">
                                <li>
                                    <div class="timer_time">
                                        <h4>{{ $test->testquestion->count() }}</h4>
                                        <p>Questions</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="timer_time">
                                        <h4 id="timer">{{ $test->time }}</h4>
                                        <p>Minutes</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6">
                    <form id="testForm" action="{{ route('test.submit', $test->id) }}" method="POST">
                        @csrf
                        <div class="certi_form">
                            <div class="all_ques_lest">
                                @php
                                    $questionNumber = 1; // Initialize the question number counter
                                @endphp

                                @if ($test->testquestion->isNotEmpty())
                                    @foreach ($test->testquestion->sortBy('position') as $question)
                                        <div class="grouped fields">
                                            <div class="ques_title mt-3">
                                                <strong>Ques {{ $questionNumber++ }} :-</strong>
                                                <!-- Display question number properly -->
                                                {{ $question->question_text }}&nbsp;
                                                {{ '(' . intval($question->score) . ' Marks)' }}
                                            </div>

                                            @foreach ($question->testoption as $option)
                                                <div class="field">
                                                    <div class="ui radio checkbox">
                                                        <input type="radio" name="answers[{{ $question->id }}]"
                                                            value="{{ $option->id }}" tabindex="0" class="hidden">
                                                        <label>{{ $option->option_text }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @else
                                    <p>No questions available for this test.</p>
                                @endif

                            </div>
                            <button type="button" class="test_submit_btn" onclick="confirmSubmit()">Submit Test</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<<<<<<< HEAD
    </div>
    @include('learner.layout.footer')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const timerElement = document.getElementById('timer');
            let timeLeft;
    
            // Handle both "HH:MM:SS" and "minutes" format
            if (timerElement.textContent.includes(':')) {
                // Format: HH:MM:SS
                const timeParts = timerElement.textContent.split(':');
                let hours = parseInt(timeParts[0], 10) || 0;
                let minutes = parseInt(timeParts[1], 10) || 0;
                let seconds = parseInt(timeParts[2], 10) || 0;
                timeLeft = (hours * 3600) + (minutes * 60) + seconds;
            } else {
                // Format: Minutes only
                timeLeft = parseInt(timerElement.textContent, 10) * 60;
            }
    
            function updateTimerDisplay() {
                const displayHours = Math.floor(timeLeft / 3600);
                const displayMinutes = Math.floor((timeLeft % 3600) / 60);
                const displaySeconds = timeLeft % 60;
    
                timerElement.textContent =
                    `${displayHours.toString().padStart(2, '0')}:${displayMinutes.toString().padStart(2, '0')}:${displaySeconds.toString().padStart(2, '0')}`;
            }
    
            updateTimerDisplay();
    
            const timerInterval = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    Swal.fire({
                        title: 'Time’s Up!',
                        text: 'Your test time has ended. Submitting your answers now.',
                        icon: 'warning',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then(() => {
                        document.getElementById('testForm').submit();
                    });
                    return;
                }
    
                timeLeft--;
                updateTimerDisplay();
            }, 1000);
        });
    
        function confirmSubmit() {
            // Get all question blocks
            const questionBlocks = document.querySelectorAll('.grouped.fields');
    
            let unanswered = [];
    
            questionBlocks.forEach((block, index) => {
                const inputs = block.querySelectorAll('input[type="radio"]');
                const questionId = inputs.length > 0 ? inputs[0].name : null;
                const answered = [...inputs].some(input => input.checked);
    
                if (!answered && questionId) {
                    unanswered.push(index + 1); // store question number (1-based)
                }
            });
    
            if (unanswered.length > 0) {
                Swal.fire({
                    title: 'Unanswered Questions!',
                    text: `You have not answered question(s): ${unanswered.join(', ')}.`,
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }
    
            // If all questions are answered, confirm submit
            Swal.fire({
                title: 'Submit Test?',
                text: 'Are you sure you want to submit your test?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Submit',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('testForm').submit();
                }
            });
        }
    </script>
    
@endsection
=======
        @include('learner.layout.footer')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const timerElement = document.getElementById('timer');
                let timeLeft;

                // Handle both "HH:MM:SS" and "minutes" format
                if (timerElement.textContent.includes(':')) {
                    // Format: HH:MM:SS
                    const timeParts = timerElement.textContent.split(':');
                    let hours = parseInt(timeParts[0], 10) || 0;
                    let minutes = parseInt(timeParts[1], 10) || 0;
                    let seconds = parseInt(timeParts[2], 10) || 0;
                    timeLeft = (hours * 3600) + (minutes * 60) + seconds;
                } else {
                    // Format: Minutes only
                    timeLeft = parseInt(timerElement.textContent, 10) * 60;
                }

                function updateTimerDisplay() {
                    const displayHours = Math.floor(timeLeft / 3600);
                    const displayMinutes = Math.floor((timeLeft % 3600) / 60);
                    const displaySeconds = timeLeft % 60;

                    timerElement.textContent =
                        `${displayHours.toString().padStart(2, '0')}:${displayMinutes.toString().padStart(2, '0')}:${displaySeconds.toString().padStart(2, '0')}`;
                }

                updateTimerDisplay();

                const timerInterval = setInterval(() => {
                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        Swal.fire({
                            title: 'Time’s Up!',
                            text: 'Your test time has ended. Submitting your answers now.',
                            icon: 'warning',
                            confirmButtonText: 'OK',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then(() => {
                            document.getElementById('testForm').submit();
                        });
                        return;
                    }

                    timeLeft--;
                    updateTimerDisplay();
                }, 1000);
            });

            function confirmSubmit() {
    // Get all question blocks
    const questionBlocks = document.querySelectorAll('.grouped.fields');

    let unanswered = [];

    questionBlocks.forEach((block, index) => {
        const inputs = block.querySelectorAll('input[type="radio"]');
        const questionId = inputs.length > 0 ? inputs[0].name : null;
        const answered = [...inputs].some(input => input.checked);

        if (!answered && questionId) {
            unanswered.push(index + 1); // store question number (1-based)
        }
    });

    if (unanswered.length > 0) {
        Swal.fire({
            title: 'Unanswered Questions!',
            text: `You have not answered question(s): ${unanswered.join(', ')}.`,
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        return;
    }

        // If all questions are answered, confirm submit
        Swal.fire({
            title: 'Submit Test?',
            text: 'Are you sure you want to submit your test?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Submit',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('testForm').submit();
            }
        });
    }

        </script>
@endsection
>>>>>>> 1a8d468aeec6e19cc8e231603d0d6b0967a64c90
