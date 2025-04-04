@extends('instructor.layouts.master')

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
                                                        <li class="nav-item">
                                                                <a class="nav-link" id="pills-closeaccount-tab"
                                                                        data-bs-toggle="pill" href="#pills-closeaccount"
                                                                        role="tab" aria-selected="false">Close
                                                                        Account</a>
                                                        </li>
                                                </ul>
                                        </div>
                                        <div class="tab-content" id="pills-tabContent">
                                                <di class="tab-pane fade show active" id="pills-account" role="tabpanel"
                                                        aria-labelledby="pills-account-tab">
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
                                                                                                                                <div class="ui left icon  swdh11 swdh19">
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
                                                                                                                                <small class="text-danger">{{ $message }}</small>
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
                                                                                                                                <small class="text-danger">{{ $message }}</small>
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
                                                                                                                                        <small class="text-danger">{{ $message }}</small>
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
                                                                                                                                                        name="phone_number"
                                                                                                                                                        value="{{ Auth::user()->phone_number }}"
                                                                                                                                                        placeholder="Phone number" required>
                                                                                                                                                        <div class="invalid-feedback">Please provide a PhoneNumber.</div>
                                                                                                                                        </div>
                                                                                                                                        <span>
                                                                                                                                                @error('phone_number')
                                                                                                                                                        <small class="text-danger">{{ $message }}</small>
                                                                                                                                                @enderror                                                                                                                                                  
                                                                                                                                        </span>
                                                                                                                                </div>
                                                                                                                        </div>
                                                                                                                        <div
                                                                                                                                class="col-lg-6">
                                                                                                                                <div
                                                                                                                                        class="ui search focus mt-30">
                                                                                                                                        <div
                                                                                                                                                class="ui left icon swdh11 swdh19">
                                                                                                                                                <input class="prompt srch_explore form-control"
                                                                                                                                                        type="date"
                                                                                                                                                        name="date_of_birth"
                                                                                                                                                        value="{{ Auth::user()->date_of_birth }}"
                                                                                                                                                        placeholder="Date of birth" required max="{{ date('Y-m-d') }}">
                                                                                                                                                        <div class="invalid-feedback">Please provide a Birth date.</div>
                                                                                                                                        </div>
                                                                                                                                        <span>
                                                                                                                                                @error('date_of_birth')
                                                                                                                                                        <small class="text-danger">{{ $message }}</small>
                                                                                                                                                @enderror                                                                                                                                           
                                                                                                                                        </span>
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
                                                                                                                                                        class="prompt srch_explore  form-control"   
                                                                                                                                                        rows="3"
                                                                                                                                                        name="description"
                                                                                                                                                        id="id_about"
                                                                                                                                                        placeholder="Write a little description about you...">{{ $instructorData->short_description }}</textarea>
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
                                                        <form method="POST" class="close-validation" novalidate>
                                                                @method('POST')
                                                                <div class="col-lg-4">
                                                                        <div class="ui search focus mt-30">
                                                                                <div class="ui left icon  swdh11 swdh19">
                                                                                        <input class="prompt srch_explore form-control"
                                                                                        type="password"
                                                                                        name="yourassword"
                                                                                        maxlength="64"
                                                                                        placeholder="Enter Your Password" required>
                                                                                        <div class="invalid-feedback">Please provide a Password.</div>
                                                                                </div>
                                                                                <div class="help-block">Are you sure you
                                                                                        want to close your account?
                                                                                </div>
                                                                        </div>
                                                                        <button class="save_payout_btn mbs20"
                                                                        type="submit">Close Account</button>
                                                                </div>
                                                        </form>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        @include('admin.layouts.footer')
</div>
<script>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var forms = document.querySelectorAll(".close-validation");

        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener("submit", function (event) {
                event.preventDefault(); // Prevent default form submission
                
                if (!form.checkValidity()) {
                    event.stopPropagation();
                    form.classList.add("was-validated");
                    return;
                }

                // Show SweetAlert2 confirmation modal
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once closed, you will not be able to recover your account!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Yes, close my account!",
                    cancelButtonText: "Cancel",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = new FormData(form);
                        let submitButton = form.querySelector("button[type='submit']");
                        submitButton.disabled = true; // Disable button to prevent multiple submissions

                        fetch("{{ route('account.close') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json",
                            },
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your account has been closed successfully.",
                                    icon: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = "{{ route('login') }}"; // Redirect to login page
                                });
                            } else {
                                Swal.fire("Error", data.message, "error");
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            Swal.fire("Oops!", "Something went wrong. Please try again.", "error");
                        })
                        .finally(() => {
                            submitButton.disabled = false;
                        });
                    }
                });
            }, false);
        });
    });
</script>

    

@endsection