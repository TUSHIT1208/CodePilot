@extends('learner.layout.master')

@section('title')
    Cart
@endsection
@section('content_learner')
    <div class="wrapper">
        <div class="_215b15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title125">
                            <div class="titleleft">
                                <div class="ttl121">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('learner.dashboard') }}">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="title126">
                            <h2>Checkout</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb4d25">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="membership_chk_bg">
                            <div class="checkout_title">
                                <h4>Billing Details</h4>
                                <img src="images/line.svg" alt="">
                            </div>
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="address1">
                                        <div class="panel-title">
                                            <a class="collapsed" data-bs-toggle="collapse" data-bs-parent="#accordion"
                                                href="#collapseaddress1" aria-expanded="false"
                                                aria-controls="collapseaddress1">
                                                Edit Address
                                            </a>
                                        </div>
                                    </div>
                                    <div id="collapseaddress1" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="address1">
                                        <div class="panel-body basic_form">
                                            <form action="" id="checkout-form" novalidate>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="ui search focus mt-30 lbel25">
                                                            <label class="title-field">First Name*</label>
                                                            <div class="ui left icon swdh11 swdh19">
                                                                <input class="prompt srch_explore form-control"
                                                                    type="hidden" name="user_id" id="user_id"
                                                                    value="{{ Auth::user()->id }}" required maxlength="64"
                                                                    placeholder="First Name">
                                                                <input class="prompt srch_explore form-control"
                                                                    type="text" name="first_name" id="id_name"
                                                                    value="{{ Auth::user()->first_name }}" required=""
                                                                    maxlength="64" placeholder="First Name">
                                                                <div class="invalid-feedback">Please enter your first name.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="ui search focus mt-30 lbel25">
                                                            <label class="title-field">Last Name*</label>
                                                            <div class="ui left icon swdh11 swdh19">
                                                                <input class="prompt srch_explore form-control"
                                                                    type="text" name="last_name"
                                                                    value="{{ Auth::user()->last_name }}" id="id_surname"
                                                                    required maxlength="64" placeholder="Last Name">
                                                                <div class="invalid-feedback">Please enter your Last name.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="mt-30 lbel25">
                                                            <label class="title-field">Country*</label>
                                                        </div>
                                                        <select class="form-control prompt srch_explore" name="country"
                                                            title="Select Country" data-size="7" id="id_country" required>
                                                            <option value="" selected hidden>Select Country</option>
                                                            <option value="Afghanistan">Afghanistan</option>
                                                            <option value="Albania">Albania</option>
                                                            <option value="Algeria">Algeria</option>
                                                            <option value="American Samoa">American Samoa</option>
                                                            <option value="Andorra">Andorra</option>
                                                            <option value="Angola">Angola</option>
                                                            <option value="Anguilla">Anguilla</option>
                                                            <option value="Antarctica">Antarctica</option>
                                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                            <option value="Argentina">Argentina</option>
                                                            <option value="Armenia">Armenia</option>
                                                            <option value="Aruba">Aruba</option>
                                                            <option value="Australia">Australia</option>
                                                            <option value="Austria">Austria</option>
                                                            <option value="Azerbaijan">Azerbaijan</option>
                                                            <option value="Bahamas">Bahamas</option>
                                                            <option value="Bahrain">Bahrain</option>
                                                            <option value="Bangladesh">Bangladesh</option>
                                                            <option value="Barbados">Barbados</option>
                                                            <option value="Belarus">Belarus</option>
                                                            <option value="Belgium">Belgium</option>
                                                            <option value="Belize">Belize</option>
                                                            <option value="Benin">Benin</option>
                                                            <option value="Bermuda">Bermuda</option>
                                                            <option value="Bhutan">Bhutan</option>
                                                            <option value="Bolivia">Bolivia</option>
                                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina
                                                            </option>
                                                            <option value="Botswana">Botswana</option>
                                                            <option value="Bouvet Island">Bouvet Island</option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="British Indian Ocean Territory">British Indian
                                                                Ocean Territory</option>
                                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                            <option value="Bulgaria">Bulgaria</option>
                                                            <option value="Burkina Faso">Burkina Faso</option>
                                                            <option value="Burundi">Burundi</option>
                                                            <option value="Cambodia">Cambodia</option>
                                                            <option value="Cameroon">Cameroon</option>
                                                            <option value="Canada">Canada</option>
                                                            <option value="Cape Verde">Cape Verde</option>
                                                            <option value="Cayman Islands">Cayman Islands</option>
                                                            <option value="Central African Republic">Central African
                                                                Republic</option>
                                                            <option value="Chad">Chad</option>
                                                            <option value="Chile">Chile</option>
                                                            <option value="China">China</option>
                                                            <option value="Christmas Island">Christmas Island</option>
                                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands
                                                            </option>
                                                            <option value="Colombia">Colombia</option>
                                                            <option value="Comoros">Comoros</option>
                                                            <option value="Congo">Congo</option>
                                                            <option value="Cook Islands">Cook Islands</option>
                                                            <option value="Costa Rica">Costa Rica</option>
                                                            <option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
                                                            <option value="Cuba">Cuba</option>
                                                            <option value="Cyprus">Cyprus</option>
                                                            <option value="Czech Republic">Czech Republic</option>
                                                            <option value="Denmark">Denmark</option>
                                                            <option value="Djibouti">Djibouti</option>
                                                            <option value="Dominica">Dominica</option>
                                                            <option value="Dominican Republic">Dominican Republic</option>
                                                            <option value="East Timor">East Timor</option>
                                                            <option value="Ecuador">Ecuador</option>
                                                            <option value="Egypt">Egypt</option>
                                                            <option value="El Salvador">El Salvador</option>
                                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                            <option value="Eritrea">Eritrea</option>
                                                            <option value="Estonia">Estonia</option>
                                                            <option value="Ethiopia">Ethiopia</option>
                                                            <option value="Falkland Islands (Malvinas)">Falkland Islands
                                                                (Malvinas)</option>
                                                            <option value="Faroe Islands">Faroe Islands</option>
                                                            <option value="Fiji">Fiji</option>
                                                            <option value="Finland">Finland</option>
                                                            <option value="France">France</option>
                                                            <option value="France, Metropolitan">France, Metropolitan
                                                            </option>
                                                            <option value="French Guiana">French Guiana</option>
                                                            <option value="French Polynesia">French Polynesia</option>
                                                            <option value="French Southern Territories">French Southern
                                                                Territories</option>
                                                            <option value="Gabon">Gabon</option>
                                                            <option value="Gambia">Gambia</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="Germany">Germany</option>
                                                            <option value="Ghana">Ghana</option>
                                                            <option value="Gibraltar">Gibraltar</option>
                                                            <option value="Guernsey">Guernsey</option>
                                                            <option value="Greece">Greece</option>
                                                            <option value="Greenland">Greenland</option>
                                                            <option value="Grenada">Grenada</option>
                                                            <option value="Guadeloupe">Guadeloupe</option>
                                                            <option value="Guam">Guam</option>
                                                            <option value="Guatemala">Guatemala</option>
                                                            <option value="Guinea">Guinea</option>
                                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                            <option value="Guyana">Guyana</option>
                                                            <option value="Haiti">Haiti</option>
                                                            <option value="Heard and Mc Donald Islands">Heard and Mc Donald
                                                                Islands</option>
                                                            <option value="Honduras">Honduras</option>
                                                            <option value="Hong Kong">Hong Kong</option>
                                                            <option value="Hungary">Hungary</option>
                                                            <option value="Iceland">Iceland</option>
                                                            <option value="India">India</option>
                                                            <option value="Isle of Man">Isle of Man</option>
                                                            <option value="Indonesia">Indonesia</option>
                                                            <option value="Iran (Islamic Republic of)">Iran (Islamic
                                                                Republic of)</option>
                                                            <option value="Iraq">Iraq</option>
                                                            <option value="Ireland">Ireland</option>
                                                            <option value="Israel">Israel</option>
                                                            <option value="Italy">Italy</option>
                                                            <option value="Ivory Coast">Ivory Coast</option>
                                                            <option value="Jersey">Jersey</option>
                                                            <option value="Jamaica">Jamaica</option>
                                                            <option value="Japan">Japan</option>
                                                            <option value="Jordan">Jordan</option>
                                                            <option value="Kazakhstan">Kazakhstan</option>
                                                            <option value="Kenya">Kenya</option>
                                                            <option value="Kiribati">Kiribati</option>
                                                            <option value="Korea, Democratic People's Republic of">Korea,
                                                                Democratic People's Republic of</option>
                                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                                            <option value="Kosovo">Kosovo</option>
                                                            <option value="Kuwait">Kuwait</option>
                                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                            <option value="Lao People's Democratic Republic">Lao People's
                                                                Democratic Republic</option>
                                                            <option value="Latvia">Latvia</option>
                                                            <option value="Lebanon">Lebanon</option>
                                                            <option value="Lesotho">Lesotho</option>
                                                            <option value="Liberia">Liberia</option>
                                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya
                                                            </option>
                                                            <option value="Liechtenstein">Liechtenstein</option>
                                                            <option value="Lithuania">Lithuania</option>
                                                            <option value="Luxembourg">Luxembourg</option>
                                                            <option value="Macau">Macau</option>
                                                            <option value="Macedonia">Macedonia</option>
                                                            <option value="Madagascar">Madagascar</option>
                                                            <option value="Malawi">Malawi</option>
                                                            <option value="Malaysia">Malaysia</option>
                                                            <option value="Maldives">Maldives</option>
                                                            <option value="Mali">Mali</option>
                                                            <option value="Malta">Malta</option>
                                                            <option value="Marshall Islands">Marshall Islands</option>
                                                            <option value="Martinique">Martinique</option>
                                                            <option value="Mauritania">Mauritania</option>
                                                            <option value="Mauritius">Mauritius</option>
                                                            <option value="Mayotte">Mayotte</option>
                                                            <option value="Mexico">Mexico</option>
                                                            <option value="Micronesia, Federated States of">Micronesia,
                                                                Federated States of</option>
                                                            <option value="Moldova, Republic of">Moldova, Republic of
                                                            </option>
                                                            <option value="Monaco">Monaco</option>
                                                            <option value="Mongolia">Mongolia</option>
                                                            <option value="Montenegro">Montenegro</option>
                                                            <option value="Montserrat">Montserrat</option>
                                                            <option value="Morocco">Morocco</option>
                                                            <option value="Mozambique">Mozambique</option>
                                                            <option value="Myanmar">Myanmar</option>
                                                            <option value="Namibia">Namibia</option>
                                                            <option value="Nauru">Nauru</option>
                                                            <option value="Nepal">Nepal</option>
                                                            <option value="Netherlands">Netherlands</option>
                                                            <option value="Netherlands Antilles">Netherlands Antilles
                                                            </option>
                                                            <option value="New Caledonia">New Caledonia</option>
                                                            <option value="New Zealand">New Zealand</option>
                                                            <option value="Nicaragua">Nicaragua</option>
                                                            <option value="Niger">Niger</option>
                                                            <option value="Nigeria">Nigeria</option>
                                                            <option value="Niue">Niue</option>
                                                            <option value="Norfolk Island">Norfolk Island</option>
                                                            <option value="Northern Mariana Islands">Northern Mariana
                                                                Islands</option>
                                                            <option value="Norway">Norway</option>
                                                            <option value="Oman">Oman</option>
                                                            <option value="Pakistan">Pakistan</option>
                                                            <option value="Palau">Palau</option>
                                                            <option value="Palestine">Palestine</option>
                                                            <option value="Panama">Panama</option>
                                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                                            <option value="Paraguay">Paraguay</option>
                                                            <option value="Peru">Peru</option>
                                                            <option value="Philippines">Philippines</option>
                                                            <option value="Pitcairn">Pitcairn</option>
                                                            <option value="Poland">Poland</option>
                                                            <option value="Portugal">Portugal</option>
                                                            <option value="Puerto Rico">Puerto Rico</option>
                                                            <option value="Qatar">Qatar</option>
                                                            <option value="Reunion">Reunion</option>
                                                            <option value="Romania">Romania</option>
                                                            <option value="Russian Federation">Russian Federation</option>
                                                            <option value="Rwanda">Rwanda</option>
                                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis
                                                            </option>
                                                            <option value="Saint Lucia">Saint Lucia</option>
                                                            <option value="Saint Vincent and the Grenadines">Saint Vincent
                                                                and the Grenadines</option>
                                                            <option value="Samoa">Samoa</option>
                                                            <option value="San Marino">San Marino</option>
                                                            <option value="Sao Tome and Principe">Sao Tome and Principe
                                                            </option>
                                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                                            <option value="Senegal">Senegal</option>
                                                            <option value="Serbia">Serbia</option>
                                                            <option value="Seychelles">Seychelles</option>
                                                            <option value="Sierra Leone">Sierra Leone</option>
                                                            <option value="Singapore">Singapore</option>
                                                            <option value="Slovakia">Slovakia</option>
                                                            <option value="Slovenia">Slovenia</option>
                                                            <option value="Solomon Islands">Solomon Islands</option>
                                                            <option value="Somalia">Somalia</option>
                                                            <option value="South Africa">South Africa</option>
                                                            <option value="South Georgia South Sandwich Islands">South
                                                                Georgia South Sandwich Islands</option>
                                                            <option value="Spain">Spain</option>
                                                            <option value="Sri Lanka">Sri Lanka</option>
                                                            <option value="St. Helena">St. Helena</option>
                                                            <option value="St. Pierre and Miquelon">St. Pierre and Miquelon
                                                            </option>
                                                            <option value="Sudan">Sudan</option>
                                                            <option value="Suriname">Suriname</option>
                                                            <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan
                                                                Mayen Islands</option>
                                                            <option value="Swaziland">Swaziland</option>
                                                            <option value="Sweden">Sweden</option>
                                                            <option value="Switzerland">Switzerland</option>
                                                            <option value="Syrian Arab Republic">Syrian Arab Republic
                                                            </option>
                                                            <option value="Taiwan">Taiwan</option>
                                                            <option value="Tajikistan">Tajikistan</option>
                                                            <option value="Tanzania, United Republic of">Tanzania, United
                                                                Republic of</option>
                                                            <option value="Thailand">Thailand</option>
                                                            <option value="Togo">Togo</option>
                                                            <option value="Tokelau">Tokelau</option>
                                                            <option value="Tonga">Tonga</option>
                                                            <option value="Trinidad and Tobago">Trinidad and Tobago
                                                            </option>
                                                            <option value="Tunisia">Tunisia</option>
                                                            <option value="Turkey">Turkey</option>
                                                            <option value="Turkmenistan">Turkmenistan</option>
                                                            <option value="Turks and Caicos Islands">Turks and Caicos
                                                                Islands</option>
                                                            <option value="Tuvalu">Tuvalu</option>
                                                            <option value="Uganda">Uganda</option>
                                                            <option value="Ukraine">Ukraine</option>
                                                            <option value="United Arab Emirates">United Arab Emirates
                                                            </option>
                                                            <option value="United Kingdom">United Kingdom</option>
                                                            <option value="United States">United States</option>
                                                            <option value="United States minor outlying islands">United
                                                                States minor outlying islands</option>
                                                            <option value="Uruguay">Uruguay</option>
                                                            <option value="Uzbekistan">Uzbekistan</option>
                                                            <option value="Vanuatu">Vanuatu</option>
                                                            <option value="Vatican City State">Vatican City State</option>
                                                            <option value="Venezuela">Venezuela</option>
                                                            <option value="Vietnam">Vietnam</option>
                                                            <option value="Virgin Islands (British)">Virgin Islands
                                                                (British)</option>
                                                            <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)
                                                            </option>
                                                            <option value="Wallis and Futuna Islands">Wallis and Futuna
                                                                Islands</option>
                                                            <option value="Western Sahara">Western Sahara</option>
                                                            <option value="Yemen">Yemen</option>
                                                            <option value="Zaire">Zaire</option>
                                                            <option value="Zambia">Zambia</option>
                                                            <option value="Zimbabwe">Zimbabwe</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select your Country.</div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="ui search focus mt-30 lbel25">
                                                            <label class="title-field">Address*</label>
                                                            <div class="ui left icon swdh11 swdh19">
                                                                <textarea class="prompt srch_explore form-control" name="address" id="id_address" rows="5" cols="30"
                                                                    required placeholder="Address"></textarea>
                                                                <div class="invalid-feedback">Please enter your Address.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="ui search focus mt-30 lbel25">
                                                            <label class="title-field">City*</label>
                                                            <div class="ui left icon swdh11 swdh19">
                                                                <input class="prompt srch_explore form-control"
                                                                    type="text" name="city" id="id_city" required
                                                                    maxlength="64" placeholder="City">
                                                                <div class="invalid-feedback">Please enter your City.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="ui search focus mt-30 lbel25">
                                                            <label class="title-field">State / Province / Region*</label>
                                                            <div class="ui left icon swdh11 swdh19">
                                                                <input class="prompt srch_explore form-control"
                                                                    type="text" name="state" id="id_state" required
                                                                    maxlength="64"
                                                                    placeholder="State / Province / Region">
                                                                <div class="invalid-feedback">Please enter your State.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="ui search focus mt-30 lbel25">
                                                            <label class="title-field">Zip/Postal Code*</label>
                                                            <div class="ui left icon swdh11 swdh19">
                                                                <input class="prompt srch_explore form-control"
                                                                    type="text" name="zip_code" id="id_zip"
                                                                    required maxlength="64"
                                                                    placeholder="Zip / Postal Code">
                                                                <div class="invalid-feedback">Please enter your Pincode.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="ui search focus mt-30 lbel25">
                                                            <label class="title-field">Phone Number*</label>
                                                            <div class="ui left icon swdh11 swdh19">
                                                                <input class="prompt srch_explore form-control"
                                                                    type="number" name="phone"
                                                                    value="{{ Auth::user()->phone_number }}"
                                                                    id="id_phone" required maxlength="12"
                                                                    placeholder="Phone Number">
                                                                <div class="invalid-feedback">Please enter your Phone
                                                                    number.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <button class="save_address_btn" type="submit"
                                                            id="saveAddressBtn">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="address_text" id="addressText">
                                {{ Auth::user()->address ?: 'No Address' }}
                            </div>
                        </div>
                        <div class="membership_chk_bg">
                            <div class="">
                                <div class="checkout_title">
                                    <h4>Order Details</h4>
                                    <img src="images/line.svg" alt="">
                                </div>
                                <form id="checkoutForm">
                                    @csrf
                                    <div id="courseContainer">
                                        <div class="order_dt_section">
                                            @foreach ($cartItems as $item)
                                                <div class="course_item">
                                                    <input type="hidden" class="course_id"
                                                        value="{{ $item->course->id }}">
                                                    <input type="hidden" class="course_price"
                                                        value="{{ $item->course->price }}">
                                                    <input type="hidden" class="course_discount"
                                                        value="{{ $item->course->discount }}">
                                                    <div class="order_title mt-3">
                                                        <h4>{{ $item->course->title }}</h4>
                                                        <div class="order_price">₹{{ $item->course->price }}</div>
                                                    </div>
                                                    <div class="order_title">
                                                        <h6>Discount</h6>
                                                        <div class="order_price">₹{{ $item->course->discount }}</div>
                                                    </div>
                                                    <div class="order_title">
                                                        <h3>Total</h3>
                                                        <div class="order_price">
                                                            <strong>₹{{ $item->course->price - $item->course->discount }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="chckot_btn" type="submit" id="checkoutButton">Confirm
                                            Checkout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="membership_chk_bg rght1528">
                        <div class="checkout_title">
                            <h4>Total</h4>
                            <img src="{{ asset('images/line.svg') }}" alt="">
                        </div>
                        <div class="order_dt_section">
                            <div class="order_title">
                                <h4>Original Price</h4>
                                <div id="originalPrice" data-value="{{ $cartItems->sum('course.price') }}">
                                    ₹{{ $cartItems->sum('course.price') }}
                                </div>
                            </div>
                            <div class="order_title">
                                <h6>Discount Price</h6>
                                <div id="discountPrice" data-value="{{ $cartItems->sum('course.discount') }}">
                                    ₹{{ $cartItems->sum('course.discount') }}
                                </div>
                            </div>
                            <div class="order_title">
                                <h2>Total</h2>
                                <div id="totalPrice"></div> <!-- total price-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="loader-overlay" id="loader">
            <div class="loader"></div>
        </div>
    </div>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function() {
            var savedAddress = {};

            // Save address when the "Save Address" button is clicked
            $("#saveAddressBtn").on("click", function(event) {
                event.preventDefault();

                // Add Bootstrap validation
                var form = $("#checkout-form")[0];
                if (form.checkValidity() === false) {
                    event.stopPropagation();
                    $(form).addClass('was-validated');
                    return;
                }

                savedAddress = {
                    first_name: $("#id_name").val() || "",
                    last_name: $("#id_surname").val() || "",
                    address: $("#id_address").val() || "",
                    city: $("#id_city").val() || "",
                    state: $("#id_state").val() || "",
                    zip_code: $("#id_zip").val() || "",
                    phone: $("#id_phone").val() || "",
                    country: $("#id_country").val() || ""
                };

                var formattedAddress = `${savedAddress.first_name} ${savedAddress.last_name} <br>
                                            ${savedAddress.address} <br>
                                            ${savedAddress.city}, ${savedAddress.state} - ${savedAddress.zip_code} <br>
                                            ${savedAddress.country} <br>
                                            Phone: ${savedAddress.phone}`;

                // Update the address display
                $("#addressText").html(formattedAddress);
                console.log("Address saved:", savedAddress);
                toastr.options = {
                    closeButton: true,
                    debug: false,
                    newestOnTop: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    preventDuplicates: true,
                    timeOut: 2000,
                    extendedTimeOut: 1000,
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    onShown: function () {
                        $(".toast-success").css({
                            'background-color': '#28a745', // Green for success
                            'opacity': '1'  // Adjust opacity
                        });;
                    }
                };
                toastr.success("address saved successfully...");
            });
            // Checkout process

            $("#checkoutButton").on("click", function() {
                event.preventDefault();
                if (!savedAddress.first_name) {
                    toastr.options = {
                    closeButton: true,
                    debug: false,
                    newestOnTop: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    preventDuplicates: true,
                    timeOut: 2000,
                    extendedTimeOut: 1000,
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    onShown: function () {
                        $(".toast-success").css({
                            'background-color': '#28a745', // Green for success
                            'opacity': '1'  // Adjust opacity
                        });
                    }
                };
                    toastr.warning("Please save your address first...");
                    return;
                }

                var userId = $("#user_id").val() || ""; // Get user ID dynamically
                var totalAmount = document.getElementById("originalPrice").getAttribute("data-value");
                var totalDiscount = document.getElementById("discountPrice").getAttribute("data-value");
                var total_payable = totalAmount - totalDiscount;
                console.log("totalAmount", totalAmount);
                console.log("totalDiscount", totalDiscount);
                console.log("total_payable", total_payable);
                var courses = [];

                $(".course_item").each(function() {
                    var courseId = $(this).find(".course_id").val() || "";
                    var price = parseFloat($(this).find(".course_price").val()) || 0;
                    var discount = parseFloat($(this).find(".course_discount").val()) || 0;
                    var payableAmount = price - discount;
                    courses.push({
                        Course_id: courseId,
                        Amount: price,
                        Discount: discount,
                        Payable_amount: payableAmount
                    });
                });
                console.log("Courses", courses);

                var orderData = {
                    user_id: userId,
                    create_by: userId,
                    booking_number: "BN" + Math.floor(Math.random() * 1000000),
                    payment_status: "pending",
                    total_course: courses.length,
                    total_amount: totalAmount,
                    total_discount: totalDiscount,
                    payable_amount: total_payable,
                    courses: courses,
                    address: savedAddress
                };

                console.log("Generated Order Data:", orderData);
                $.ajax({
                    url: "/order/store",
                    type: "POST",
                    data: orderData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        if (response.success) {
                            startRazorpayPayment(response.razorpay_order_id, response
                                .amount, response.order_id);
                        }
                    },
                    error: function(xhr) {
                        alert("Error placing order. Please try again.");
                        console.error(xhr.responseText);
                    }
                });

            });
        });

        function startRazorpayPayment(razorpay_order_id, amount, order_id) {
            $('.loader-overlay').show();
            $('.tab-from-content').addClass('blurred');
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}", // Razorpay Key
                "amount": amount * 100, // Convert to paisa
                "currency": "INR",
                "name": "CodePilot",
                "description": "Course Purchase",
                "order_id": razorpay_order_id,
                "handler": function(response) {
                    // ✅ Send payment success details to backend
                    $.post("/razorpay/success", {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        order_id: order_id,
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature
                    }, function(res) {
                        if (res.success) {
                            $('.loader-overlay').hide(); // Hide loader
                            $('.tab-from-content').removeClass('blurred'); // Remove blur
                            Swal.fire({
                                title: "Payment Successful!",
                                text: "Your order has been placed successfully.",
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then(() => {
                                window.location.href = "/dashboard/learner";
                            });
                        } else {
                            $('.loader-overlay').hide(); // Hide loader
                            $('.tab-from-content').removeClass('blurred'); // Remove blur
                            Swal.fire({
                                title: "Payment Failed",
                                text: "Payment verification failed. Please try again.",
                                icon: "error",
                                confirmButtonText: "Retry"
                            });
                        }
                    });
                },
                "prefill": {
                    "name": "Customer Name",
                    "email": "customer@example.com"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };

            var rzp1 = new Razorpay(options);
            rzp1.open();
        }
    </script>


    <script>
        // only display
        document.addEventListener("DOMContentLoaded", function() {
            var originalPrice = parseFloat(document.getElementById("originalPrice").getAttribute("data-value")) ||
                0;
            var discountPrice = parseFloat(document.getElementById("discountPrice").getAttribute("data-value")) ||
                0;

            var totalPrice = originalPrice - discountPrice;

            document.getElementById("totalPrice").innerText = "₹" + totalPrice.toFixed(2);
        });
    </script>
@endsection
