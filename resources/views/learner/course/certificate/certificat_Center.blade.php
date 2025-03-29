@extends('learner.course.certificate.master')

@section('title')
    Certificate Center
@endsection

@section('content')
    <!-- Body Start -->
    <div class="wrapper _bg4586 _new89">
        <div class="_215certibg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cert_banner_text">
                            <h1>Certification Center</h1>
                            <p>For Students and Instructors</p>
                            <ul class="certi_icons">
                                <li><a href="#" class="edttslogo"><img src="{{ asset('images/logo1.svg') }} "
                                            alt=""></a>
                                </li>
                                <li>
                                    <div class="edttsplus">
                                        <img src="{{ asset('images/plus.svg') }}" alt="">
                                    </div>

                                </li>
                                <li><a href="#" class="edttslogo1"><img src="{{ asset('images/certicon.svg') }}"
                                            alt=""></a>
                                </li>
                            </ul>
                            <a href="{{ route('Test_exam') }}"><button class="certi-btn">Start
                                    Certification</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="_485td5">
            <div class="container">
                <div class="row justify-content-lg-center justify-content-md-center">
                    <div class="col-lg-12">
                        <div class="titleceti89">
                            <h2>Who Can Get Benefit From This?</h2>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-6">
                        <div class="who_get">
                            <div class="who_img">
                                <img src="{{ asset('images/student.svg') }}" alt="">
                            </div>
                            <h4>Students</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-6">
                        <div class="who_get">
                            <div class="who_img">
                                <img src="{{ asset('images/instructor.svg') }}" alt="">
                            </div>
                            <h4>Instructor</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="_215td5">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-lg-12">
                        <div class="title589">
                            <h2>What Will You Get?</h2>
                            <p>Code pilot, which confirms your skills and knowledge of Certification</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="knowledge_dts">
                            <p>Learners are required to complete the test within the allotted time to evaluate their
                                understanding of the subject. Each test has a predefined passing mark, and only those who
                                achieve a score greater than the passing mark will be eligible to receive a certificate. If
                                a learner fails to meet the required score, they will not be eligible for certification. The
                                test must be attempted within the given time limit, and once the time expires, the test will
                                be automatically submitted. This ensures a fair assessment process and encourages learners
                                to prepare thoroughly before attempting the test.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('learner.layout.footer')
    @endsection
