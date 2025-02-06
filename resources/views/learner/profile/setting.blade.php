@include('learner.setting.master')
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
                                                                <h4>Your Cursus Account</h4>
                                                                <p>This is your public presence on Cursus. You need a
                                                                        account to upload your paid
                                                                        courses, comment on courses, purchased by
                                                                        students, or earning.</p>
                                                                <form action="{{ route('user.update', Auth::user()->id) }}"
                                                                        method="POST">
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
                                                                                                                                        class="ui left icon input swdh11 swdh19">
                                                                                                                                        <input class="prompt srch_explore"
                                                                                                                                                type="text"
                                                                                                                                                name="username"
                                                                                                                                                value="{{ Auth::user()->username }}"
                                                                                                                                                maxlength="64"
                                                                                                                                                placeholder="User Name">
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
                                                                                                                                        class="ui left icon input swdh11 swdh19">
                                                                                                                                        <input class="prompt srch_explore"
                                                                                                                                                type="text"
                                                                                                                                                name="first_name"
                                                                                                                                                value="{{ Auth::user()->first_name }}"
                                                                                                                                                maxlength="64"
                                                                                                                                                placeholder="First Name">
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
                                                                                                                                        class="ui left icon input swdh11 swdh19">
                                                                                                                                        <input class="prompt srch_explore"
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
                                                                                                                                        class="ui left icon input swdh11 swdh19">
                                                                                                                                        <input class="prompt srch_explore"
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
                                                                                                                                        class="ui left icon input swdh11 swdh19">
                                                                                                                                        <input class="prompt srch_explore"
                                                                                                                                                type="text"
                                                                                                                                                name="email"
                                                                                                                                                value="{{ Auth::user()->email }}"
                                                                                                                                                maxlength="60"
                                                                                                                                                placeholder="E-mail address">
                                                                                                                                        <div class="form-control-counter"
                                                                                                                                                data-purpose="form-control-counter">
                                                                                                                                                36
                                                                                                                                        </div>
                                                                                                                                </div>
                                                                                                                                <span>
                                                                                                                                        @error('email')
                                                                                                                                        <small class="text-danger">{{ $message }}</small>
                                                                                                                                        @enderror                                                                                                                                        
                                                                                                                                </span>
                                                                                                                                <div
                                                                                                                                        class="help-block">
                                                                                                                                        Add
                                                                                                                                        a
                                                                                                                                        professional
                                                                                                                                        headline
                                                                                                                                        like,
                                                                                                                                        "Engineer
                                                                                                                                        at
                                                                                                                                        Cursus"
                                                                                                                                        or
                                                                                                                                        "Architect."
                                                                                                                                </div>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                        class="row">
                                                                                                                        <div
                                                                                                                                class="col-lg-6">
                                                                                                                                <div
                                                                                                                                        class="ui search focus mt-30">
                                                                                                                                        <div
                                                                                                                                                class="ui left icon input swdh11 swdh19">
                                                                                                                                                <input class="prompt srch_explore"
                                                                                                                                                        type="text"
                                                                                                                                                        name="phone"
                                                                                                                                                        value="{{ Auth::user()->phone_number }}"
                                                                                                                                                        placeholder="Phone number">
                                                                                                                                        </div>
                                                                                                                                        <span>
                                                                                                                                                @error('phone')
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
                                                                                                                                                class="ui left icon input swdh11 swdh19">
                                                                                                                                                <input class="prompt srch_explore"
                                                                                                                                                        type="date"
                                                                                                                                                        name="dob"
                                                                                                                                                        value="{{ Auth::user()->date_of_birth }}"
                                                                                                                                                        maxlength="64"
                                                                                                                                                        placeholder="Date of birth">
                                                                                                                                        </div>
                                                                                                                                        <span>
                                                                                                                                                @error('dob')
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
                                                                                                                                                        class="prompt srch_explore   "   
                                                                                                                                                        rows="3"
                                                                                                                                                        name="description"
                                                                                                                                                        id="id_about"
                                                                                                                                                        placeholder="Write a little description about you..."></textarea>
                                                                                                                                        </div>
                                                                                                                                </div>
                                                                                                                                <div
                                                                                                                                        class="help-block">
                                                                                                                                        Links
                                                                                                                                        and
                                                                                                                                        coupon
                                                                                                                                        codes
                                                                                                                                        are
                                                                                                                                        not
                                                                                                                                        permitted
                                                                                                                                        in
                                                                                                                                        this
                                                                                                                                        section.
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
                                                        <div class="col-lg-4">
                                                                <div class="ui search focus mt-30">
                                                                        <div class="ui left icon input swdh11 swdh19">
                                                                                <input class="prompt srch_explore"
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