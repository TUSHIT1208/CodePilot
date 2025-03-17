@extends('learner.course.certificate.master')

@section('title')
    Certificate Fill
@endsection

@section('content')
    <!-- Body Start -->
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
                                            <li class="breadcrumb-item"><a
                                                    href="{{ route('certificate.center') }}">Certificate Center</a></li>
                                           
                                            <li class="breadcrumb-item active" aria-current="page">Certification Fill Form
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                            <div class="titleright">
                                <a href="{{ route('certificate.center') }}" class="blog_link"><i
                                        class="uil uil-angle-double-left"></i>Back to Certification Center</a>
                            </div>
                        </div>
                        <div class="title126">
                            <h2>Certification Fill Form</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="faq1256">
            <div class="container">
                <div class="row justify-content-lg-center justify-content-md-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="certi_form">
                            <div class="sign_form">
                                <h2>Fill in before you start:</h2>
                                <form action="{{ route('certificate.store') }}" method="POST" class="needs-validation"
                                    novalidate>
                                    @csrf
                                    <div class="ui search focus mt-40">
                                        <div class="ui left icon swdh11 swdh19">
                                            <input class="prompt srch_explore form-control" type="text" name="fullname"
                                                id="id_fullname" maxlength="64" placeholder="Full Name" required>
                                            <div class="invalid-feedback">Please enter your full name.</div>
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon  swdh11 swdh19">
                                            <input class="prompt srch_explore form-control" type="email" name="emailaddress"
                                                id="id_email" maxlength="64" placeholder="Email Address" required>
                                            <div class="invalid-feedback">Please enter a valid email address.</div>
                                        </div>
                                    </div>
                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon  swdh11 swdh19">
                                            <input class="prompt srch_explore form-control" type="text" name="phonenumber"
                                                id="id_phonenumber" maxlength="10" placeholder="Phone Number" required>
                                            <div class="invalid-feedback">Please enter your phone number.</div>
                                        </div>
                                    </div>

                                    <p class="testtrm145">By signing up, you agree to our <a href="#">Privacy Policy</a> and
                                        <a href="#">Terms and Conditions</a>.
                                    </p>
                                    <button class="login-btn" type="submit">Let's Go</button>
                                </form>



                                <p class="questrm145">Please be ready to answer <span>20 questions</span> within <span>1
                                        hours</span>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('learner.layout.footer')
        <script>
            // Bootstrap Form Validation
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
        </script>
@endsection