@extends('admin.layouts.master')
@section('title') Setting @endsection
@section('content')
<!-- Body Start -->
<div class="wrapper">
        <div class="sa4d25">
                <div class="container-fluid">
                        <div class="row">
                                <div class="col-lg-12">
                                        <h2 class="st_title"><i class='uil uil-cog'></i> Setting</h2>
                                        <div class="setting_tabs">
                                                <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                                                        <li class="nav-item">
                                                                <a class="nav-link active" id="pills-account-tab"
                                                                        data-bs-toggle="pill" href="#pills-account"
                                                                        role="tab" aria-selected="true">Account</a>
                                                        </li>
                                                        {{-- <li class="nav-item">
                                                                <a class="nav-link" id="pills-closeaccount-tab"
                                                                        data-bs-toggle="pill" href="#pills-closeaccount"
                                                                        role="tab" aria-selected="false">Close
                                                                        Account</a>
                                                        </li> --}}
                                                </ul>
                                        </div>
                                        <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-account"
                                                        role="tabpanel" aria-labelledby="pills-account-tab">
                                                        <div class="account_setting">
                                                                <h4>Your CodePilot Account</h4>
                                                                <p>This is your public presence on CodePilot. You need a
                                                                        account to upload your paid
                                                                        courses, comment on courses, purchased by
                                                                        students, or earning.</p>
                                                                <form action="{{ route('user.update', Auth::user()->id) }}"
                                                                        method="POST" class="admin-validation"
                                                                        novalidate>
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="basic_profile">
                                                                                <div class="basic_ptitle">
                                                                                        <h4>Basic Profile</h4>
                                                                                        <p>Add information about
                                                                                                yourself</p>
                                                                                </div>
                                                                                <div class="basic_form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-8">
                                                                                                        <div
                                                                                                                class="row">
                                                                                                                <div
                                                                                                                        class="col-lg-6">
                                                                                                                        <div
                                                                                                                                class="ui search focus mt-30">
                                                                                                                                <div
                                                                                                                                        class="ui left icon  swdh11 swdh19">
                                                                                                                                        <input class="prompt srch_explore form-control"
                                                                                                                                                type="text"
                                                                                                                                                name="username"
                                                                                                                                                value="{{ Auth::user()->username }}"
                                                                                                                                                maxlength="64"
                                                                                                                                                placeholder="User Name" required>
                                                                                                                                                <div class="invalid-feedback">Please provide a Username.</div>
                                                                                                                                </div>
                                                                                                                        </div>
                                                                                                                        <span>
                                                                                                                                @error('username')
                                                                                                                                <small
                                                                                                                                        class="text-danger">{{
                                                                                                                                        $message
                                                                                                                                        }}</small>
                                                                                                                                @enderror
                                                                                                                        </span>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                        class="col-lg-6">
                                                                                                                        <div
                                                                                                                                class="ui search focus mt-30">
                                                                                                                                <div
                                                                                                                                        class="ui left icon  swdh11 swdh19">
                                                                                                                                        <input class="prompt srch_explore form-control"
                                                                                                                                                type="text"
                                                                                                                                                name="first_name"
                                                                                                                                                value="{{ Auth::user()->first_name }}"
                                                                                                                                                maxlength="64"
                                                                                                                                                placeholder="First Name" required>
                                                                                                                                                <div class="invalid-feedback">Please provide a  Firstname.</div>
                                                                                                                                </div>
                                                                                                                        </div>
                                                                                                                        <span>
                                                                                                                                @error('first_name')
                                                                                                                                <small
                                                                                                                                        class="text-danger">{{
                                                                                                                                        $message
                                                                                                                                        }}</small>
                                                                                                                                @enderror
                                                                                                                        </span>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                        class="col-lg-6">
                                                                                                                        <div
                                                                                                                                class="ui search focus mt-30">
                                                                                                                                <div
                                                                                                                                        class="ui left icon  swdh11 swdh19">
                                                                                                                                        <input class="prompt srch_explore form-control"
                                                                                                                                                type="text"
                                                                                                                                                name="surname"
                                                                                                                                                value="{{ Auth::user()->last_name }}"
                                                                                                                                                maxlength="64"
                                                                                                                                                placeholder="Last Name">
                                                                                                                                </div>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                        class="col-lg-6">
                                                                                                                        <div
                                                                                                                                class="ui search focus mt-30">
                                                                                                                                <div
                                                                                                                                        class="ui left icon  swdh11 swdh19">
                                                                                                                                        <input class="prompt srch_explore form-control"
                                                                                                                                                type="text"
                                                                                                                                                name="middle_name"
                                                                                                                                                value="{{ Auth::user()->middle_name }}"
                                                                                                                                                maxlength="64"
                                                                                                                                                placeholder="Middle Name">
                                                                                                                                </div>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                        class="col-lg-12">
                                                                                                                        <div
                                                                                                                                class="ui search focus mt-30">
                                                                                                                                <div
                                                                                                                                        class="ui left icon  swdh11 swdh19">
                                                                                                                                        <input class="prompt srch_explore form-control"
                                                                                                                                                type="text"
                                                                                                                                                name="email"
                                                                                                                                                value="{{ Auth::user()->email }}"
                                                                                                                                                maxlength="60"
                                                                                                                                                placeholder="E-mail address" required>
                                                                                                                                                <div class="invalid-feedback">Please provide a Email.</div>
                                                                                                                                </div>
                                                                                                                                <span>
                                                                                                                                        @error('email')
                                                                                                                                        <small
                                                                                                                                                class="text-danger">{{
                                                                                                                                                $message
                                                                                                                                                }}</small>
                                                                                                                                        @enderror
                                                                                                                                </span>

                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                        class="row">
                                                                                                                        <div
                                                                                                                                class="col-lg-6">
                                                                                                                                <div
                                                                                                                                        class="ui search focus mt-30">
                                                                                                                                        <div
                                                                                                                                                class="ui left icon  swdh11 swdh19">
                                                                                                                                                <input class="prompt srch_explore form-control"
                                                                                                                                                        type="text"
                                                                                                                                                        name="phone"
                                                                                                                                                        value="{{ Auth::user()->phone_number }}"
                                                                                                                                                        placeholder="Phone number" required>
                                                                                                                                                        <div class="invalid-feedback">Please provide a PhoneNumber.</div>
                                                                                                                                        </div>
                                                                                                                                        <span>
                                                                                                                                                @error('phone')
                                                                                                                                                <small
                                                                                                                                                        class="text-danger">{{
                                                                                                                                                        $message
                                                                                                                                                        }}</small>
                                                                                                                                                @enderror
                                                                                                                                        </span>
                                                                                                                                </div>
                                                                                                                        </div>
                                                                                                                        <div
                                                                                                                                class="col-lg-6">
                                                                                                                                <div
                                                                                                                                        class="ui search focus mt-30">
                                                                                                                                        <div
                                                                                                                                                class="ui left icon  swdh11 swdh19">
                                                                                                                                                <input class="prompt srch_explore form-control"
                                                                                                                                                        type="date"
                                                                                                                                                        name="dob"
                                                                                                                                                        value="{{ Auth::user()->date_of_birth }}"
                                                                                                                                                        
                                                                                                                                                        placeholder="Date of birth" required max="{{ date('Y-m-d') }}">
                                                                                                                                                        <div class="invalid-feedback">Please provide a Birth date.</div>
                                                                                                                                        </div>
                                                                                                                                        
                                                                                                                                </div>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                        class="col-lg-12">
                                                                                                                        <div
                                                                                                                                class="ui search focus mt-30">
                                                                                                                                <div
                                                                                                                                        class="ui form swdh30">
                                                                                                                                        <div
                                                                                                                                                class="field">
                                                                                                                                                <textarea
                                                                                                                                                        class="prompt srch_explore form-control"
                                                                                                                                                        rows="3"
                                                                                                                                                        name="description"
                                                                                                                                                        id="id_about"
                                                                                                                                                        placeholder="Write a little description about you...">{{ $adminAbout->short_discription }}</textarea>
                                                                                                                                        </div>
                                                                                                                                </div>
                                                                                                                                
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                        class="col-lg-12">
                                                                                                                        <div
                                                                                                                                class="divider-1">
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <button class="save_btn" type="submit">Save
                                                                                Changes</button>
                                                                </form>
                                                        </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-notification" role="tabpanel"
                                                        aria-labelledby="pills-notification-tab">
                                                        <div class="account_setting">
                                                                <h4>Notifications - Choose when and how to be notified
                                                                </h4>
                                                                <p>Select push and email notifications you'd like to
                                                                        receive</p>
                                                                <div class="basic_profile">
                                                                        <div class="basic_form">
                                                                                <div class="nstting_content">
                                                                                        <div class="basic_ptitle">
                                                                                                <h4>Choose when and how
                                                                                                        to be notified
                                                                                                </h4>
                                                                                        </div>
                                                                                        <div
                                                                                                class="ui toggle checkbox _1457s2">
                                                                                                <input type="checkbox"
                                                                                                        name="stream_ss1"
                                                                                                        checked>
                                                                                                <label>Subscriptions</label>
                                                                                                <p class="ml5">Notify me
                                                                                                        about activity
                                                                                                        from the
                                                                                                        profiles I'm
                                                                                                        subscribed to
                                                                                                </p>
                                                                                        </div>
                                                                                        <div
                                                                                                class="ui toggle checkbox _1457s2">
                                                                                                <input type="checkbox"
                                                                                                        name="stream_ss2">
                                                                                                <label>Recommended
                                                                                                        Courses</label>
                                                                                                <p class="ml5">Notify me
                                                                                                        of courses I
                                                                                                        might like based
                                                                                                        on what I watch
                                                                                                </p>
                                                                                        </div>
                                                                                        <div
                                                                                                class="ui toggle checkbox _1457s2">
                                                                                                <input type="checkbox"
                                                                                                        name="stream_ss3">
                                                                                                <label>Activity on my
                                                                                                        comments</label>
                                                                                                <p class="ml5">Notify me
                                                                                                        about activity
                                                                                                        on my comments
                                                                                                        on others’
                                                                                                        courses</p>
                                                                                        </div>
                                                                                        <div
                                                                                                class="ui toggle checkbox _1457s2">
                                                                                                <input type="checkbox"
                                                                                                        name="stream_ss4"
                                                                                                        checked>
                                                                                                <label>Replies to my
                                                                                                        comments</label>
                                                                                                <p class="ml5">Notify me
                                                                                                        about replies to
                                                                                                        my comments</p>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="divider-1 mb-50"></div>
                                                                <div class="basic_profile">
                                                                        <div class="basic_form">
                                                                                <div class="nstting_content">
                                                                                        <div class="basic_ptitle">
                                                                                                <h4>Email notifications
                                                                                                </h4>
                                                                                                <p>Your emails are sent
                                                                                                        to
                                                                                                        gambol943@gmail.com.
                                                                                                        To unsubscribe
                                                                                                        from an email,
                                                                                                        click the
                                                                                                        "Unsubscribe"
                                                                                                        link at the
                                                                                                        bottom of it. <a
                                                                                                                href="#">Learn
                                                                                                                more</a>
                                                                                                        about emails
                                                                                                        from Edututs+.
                                                                                                </p>
                                                                                        </div>
                                                                                        <div
                                                                                                class="ui toggle checkbox _1457s2">
                                                                                                <input type="checkbox"
                                                                                                        name="stream_ss5"
                                                                                                        checked>
                                                                                                <label>Send me emails
                                                                                                        about my
                                                                                                        CodePilot
                                                                                                        activity and
                                                                                                        updates I
                                                                                                        requested</label>
                                                                                                <p class="ml5">If this
                                                                                                        setting is
                                                                                                        turned off,
                                                                                                        CodePilot may
                                                                                                        still send you
                                                                                                        messages
                                                                                                        regarding your
                                                                                                        account,
                                                                                                        required service
                                                                                                        announcements,
                                                                                                        legal
                                                                                                        notifications,
                                                                                                        and privacy
                                                                                                        matters</p>
                                                                                        </div>
                                                                                        <div
                                                                                                class="ui toggle checkbox _1457s2">
                                                                                                <input type="checkbox"
                                                                                                        name="stream_ss6">
                                                                                                <label>Promotions,
                                                                                                        course
                                                                                                        recommendations,
                                                                                                        and helpful
                                                                                                        resources from
                                                                                                        CodePilot.</label>
                                                                                        </div>
                                                                                        <div
                                                                                                class="ui toggle checkbox _1457s2">
                                                                                                <input type="checkbox"
                                                                                                        name="stream_ss7">
                                                                                                <label>Announcements
                                                                                                        from instructors
                                                                                                        whose course(s)
                                                                                                        I’m enrolled
                                                                                                        in.</label>
                                                                                                <p class="ml5">To adjust
                                                                                                        this preference
                                                                                                        by course, leave
                                                                                                        this box checked
                                                                                                        and go to the
                                                                                                        course dashboard
                                                                                                        and click on
                                                                                                        "Options" to opt
                                                                                                        in or out of
                                                                                                        specific
                                                                                                        announcements.
                                                                                                </p>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <button class="save_btn" type="submit">Save
                                                                        Changes</button>
                                                        </div>
                                                </div>
                                                                             <div class="tab-pane fade" id="pills-closeaccount" role="tabpanel"
                                                        aria-labelledby="pills-closeaccount-tab">
                                                        <div class="account_setting">
                                                                <h4>Close account</h4>
                                                                <p><strong>Warning:</strong> If you close your account,
                                                                        you will be unsubscribed from
                                                                        all your 5 courses, and will lose access
                                                                        forever.</p>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col-lg-4">
                                                                        <div class="ui search focus mt-30">
                                                                                <div
                                                                                        class="ui left icon  swdh11 swdh19">
                                                                                        <input class="prompt srch_explore form-control"
                                                                                                type="password"
                                                                                                name="yourassword"
                                                                                                maxlength="64"
                                                                                                placeholder="Enter Your Password">
                                                                                </div>
                                                                                <div class="help-block">Are you sure you
                                                                                        want to close your account?
                                                                                </div>
                                                                        </div>
                                                                        <button class="save_payout_btn mbs20"
                                                                                type="submit">Close Account</button>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <script>
                @if(session('success'))
            toastr.options = {
                closeButton: true,
                debug: false,
                newestOnTop: true,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: true,
                timeOut: 5000,
                extendedTimeOut: 1000,
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                onShown: function() {
                    $(".toast-success").css({
                        'background-color': '#28a745', // Green for success
                        'opacity': '1'  // Adjust opacity
                    });;
                }
            };
    
            toastr.success("{{ session('success') }}", "Success");
        @endif
    
        @if(session('error'))
            toastr.options = {
                closeButton: true,
                newestOnTop: true,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: true,
                timeOut: 5000,
                extendedTimeOut: 1000,
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                onShown: function() {
                    $(".toast-error").css({
                        'background-color': '#dc3545', // red for info
                        'opacity': '1'
                    });;
                }
            };
    
            toastr.error("{{ session('error') }}", "Error");
        @endif
                // This script applies Bootstrap's custom validation to all forms with the .needs-validation class.
                document.addEventListener("DOMContentLoaded", function () {
                    var forms = document.querySelectorAll(".admin-validation");
                    Array.prototype.slice.call(forms)
                        .forEach(function (form) {
                            form.addEventListener("submit", function (event) {
                                if (!form.checkValidity()) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }
                                form.classList.add("was-validated");
                            }, false);
                        });
                });
            </script>
        @endsection