<div class="step-tab-panel step-tab-amenities" id="tab_step4">
    <div class="tab-from-content">
        <div class="title-icon">
            <h3 class="title"><i class="uil uil-usd-square"></i>Price</h3>
        </div>
        <div class="course__form">
            @if (isset($course))
                    <form action="{{  route('course.price', ['course' => $course->id]) }}" method="POST"
                        class="price-validation" novalidate>

                        @csrf

                        {{-- @method('PUT') --}}
                        <div class="price-block">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="course-main-tabs">
                                        <div class="nav nav-pills flex-column flex-sm-row nav-tabs" role="tablist">
                                            <a class="flex-sm-fill text-sm-center nav-link active" data-bs-toggle="tab"
                                                href="#nav-free" role="tab" aria-selected="true"><i
                                                    class="fas fa-tag me-2"></i>Free</a>
                                            <a class="flex-sm-fill text-sm-center nav-link" data-bs-toggle="tab"
                                                href="#nav-paid" role="tab" aria-selected="false"><i
                                                    class="fas fa-cart-arrow-down me-2"></i>Paid</a>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="nav-free" role="tabpanel">
                                                <div class="price-require-dt">
                                                    <div class="cogs-toggle center_d">
                                                        <label class="switch">
                                                            <input type="checkbox" id="require_login" value="">
                                                            <span></span>
                                                        </label>
                                                        <label for="require_login" class="lbl-quiz">Require Log In</label>
                                                    </div>
                                                    <div class="cogs-toggle center_d mt-3">
                                                        <label class="switch">
                                                            <input type="checkbox" id="require_enroll" value="">
                                                            <span></span>
                                                        </label>
                                                        <label for="require_enroll" class="lbl-quiz">Require Enroll</label>
                                                    </div>
                                                    <p>If the course is free, if student require to enroll your course, if not
                                                        required enroll, if students required sign in to your website to take
                                                        this
                                                        course.</p>
                                                </div>
                                            </div>


                                            <div class="tab-pane" id="nav-paid" role="tabpanel">
                                                <div class="license_pricing mt-30">
                                                    <label class="label25">Regular Price*</label>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                                            <div class="loc_group">
                                                                <div class="ui left icon input swdh19">
                                                                    <input class="prompt form-control" type="number"
                                                                        placeholder="$0" name="price" id="price" value=""
                                                                        required><br>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a valid price (minimum: 0.00).
                                                                    </div>

                                                                </div>
                                                                <span class="slry-dt">USD</span>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="license_pricing mt-30 mb-30">
                                                    <label class="label25">Discount Price*</label>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                                            <div class="loc_group">
                                                                <div class="ui left icon input swdh19">
                                                                    <input class="prompt form-control" type="number"
                                                                        placeholder="$0" name="discount" id="discount" value=""
                                                                        required>
                                                                    <span class="invalid-feedback">
                                                                        Discount price must be a valid number and not greater
                                                                        than the regular price.
                                                                    </span>
                                                                </div>
                                                                <span class="slry-dt">USD</span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p id="price-success"></p>
                                                <button type="submit" class="main-btn mt-3" id="priceButton">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            @endif
    </div>
    <div class="mt-5 row">
        <div class="col-lg-6">
            {{-- @if (request()->route('course'))
            <a href="{{ route('course.edit', ['course' => request()->route('course')]) }}" class="upload_btn">
                Previous
            </a>
            @endif --}}
        </div>
        <div class="col-lg-6 text-end">
            <button id="price_next" class="main-btn">Next</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector(".price-validation");
        const priceInput = document.getElementById("price");
        const discountInput = document.getElementById("discount");
        const submitButton = document.getElementById("priceButton");

        // Function to check validation before submitting
        function validateForm() {
            let isValid = true;
            form.classList.add("was-validated");

            // Price validation
            if (!priceInput.value || priceInput.value < 0 || priceInput.value > 99999999.99) {
                priceInput.classList.add("is-invalid");
                isValid = false;
            } else {
                priceInput.classList.remove("is-invalid");
            }

            // Discount validation (must be <= price)
            if (!discountInput.value || discountInput.value < 0 || discountInput.value > 99999999.99 || parseFloat(discountInput.value) > parseFloat(priceInput.value)) {
                discountInput.classList.add("is-invalid");
                discountInput.setCustomValidity("Discount cannot be greater than the price.");
                isValid = false;
            } else {
                discountInput.classList.remove("is-invalid");
                discountInput.setCustomValidity("");
            }

            return isValid;
        }

        // Trigger validation on input change
        priceInput.addEventListener("input", validateForm);
        discountInput.addEventListener("input", validateForm);

        // Submit event listener
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission

            if (!validateForm()) {
                return; // Stop if validation fails
            }

            let formData = new FormData(form);
            submitButton.disabled = true; // Disable button to prevent multiple submissions

            fetch("{{ route('course.price', ['course' => $course->id]) }}", {
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
                        $("#price-success").text("Price Added successfully!");
                        // alert("Price updated successfully!");
                        form.reset();
                        form.classList.remove("was-validated");
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Something went wrong. Please try again.");
                })
                .finally(() => {
                    submitButton.disabled = false;
                });
        });
    });
</script>
