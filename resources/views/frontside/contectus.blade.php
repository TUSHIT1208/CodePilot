@extends('frontside.layouts.master')

@section('title')
    Contact Us
@endsection

@section('content')
    <!-- Body Start -->
    <div class="wrapper _bg4586 _new89">
        @include('frontside.layouts.sub-header')
        <div class="_205ef5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <h3 class="mb-3 fw-semibold">Get In Touch</h3>
                            <p class="text-muted mb-4 ff-secondary">We thrive when coming up with innovative ideas
                                but also
                                understand that a smart concept should be supported with faucibus sapien odio
                                measurable
                                results.</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <!-- end col -->
                    <div class="col-lg-6">
                        <div>
                            <form id="contactForm" action="{{ route('contactus.store') }}" method="POST"
                                class="needs-validation" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="name" class="form-label fs-13">Name</label>
                                            <input name="name" id="name" type="text"
                                                class="form-control bg-light border-light" placeholder="Your name*"
                                                required>
                                            <div class="invalid-feedback">
                                                Enter Your Name
                                            </div>
                                            <span class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="email" class="form-label fs-13">Email</label>
                                            <input name="email" id="email" type="email"
                                                class="form-control bg-light border-light" placeholder="Your email*"
                                                required>
                                            <div class="invalid-feedback">
                                                Enter The Email Address
                                            </div>
                                            <span class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="subject" class="form-label fs-13">Subject</label>
                                            <input type="text" class="form-control bg-light border-light" id="subject"
                                                name="subject" placeholder="Your Subject.." required>
                                            <div class="invalid-feedback">
                                                Enter The Subject
                                            </div>
                                            <span class="text-danger">
                                                @error('subject')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="message" class="form-label fs-13">Message</label>
                                            <textarea name="message" id="message" rows="3"
                                                class="form-control bg-light border-light" placeholder="Your message..."
                                                required></textarea>
                                            <div class="invalid-feedback">
                                                Enter The Message
                                            </div>
                                            <span class="text-danger">
                                                @error('message')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-end">
                                        <button type="submit" id="submit" name="send" class="btn btn-primary">Send
                                            Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <iframe width="600" height="400" style="border:0" loading="lazy" allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps?q=landmarks+in+India&output=embed">
                        </iframe>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
    </div>

    <!-- Add Bootstrap Validation Script -->
    <script>
        // Bootstrap 5 Validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

    <script>
        $(document).ready(function () {
            $("#contactForm").submit(function (event) {
                event.preventDefault();  // Prevent the default form submission

                // Manually check form validity
                var form = $(this)[0];
                if (!form.checkValidity()) {
                    // If the form is invalid, add validation styles and stop the AJAX submission
                    form.classList.add('was-validated');
                    return;
                }

                // Proceed with AJAX submission if form is valid
                var formData = $(this).serialize();  // Serialize the form data

                $.ajax({
                    url: $(this).attr('action'),  // The route for form submission
                    type: 'POST',  // Use POST method
                    data: formData,  // The form data
                    success: function (response) {
                        if (response.success) {
                            // Show success message using toastr
                            toastr.success('Contact detail"s send successfully');
                            setTimeout(function () {
                                location.reload(); // Reload the page after a short delay
                            }, 2000);
                        } else {
                            // Show error message if something went wrong
                            toastr.error(response.message, 'Error');
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle AJAX errors
                        toastr.error("An error occurred. Please try again.", 'Error');
                    }
                });
            });
        });
    </script>


@endsection