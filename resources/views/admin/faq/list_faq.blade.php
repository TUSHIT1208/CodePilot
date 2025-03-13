@extends('admin.layouts.master')

@section('title')
    Frequently asked questions
@endsection

@section('content')
    <!-- Body Start -->
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class="uil uil-folder-plus"></i> Frequently asked questions </h2>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card_dash1">
                        <div class="row mt-2">
                            <div class="col-lg-12 col-md-4 col-sm-6 text-end">
                                @if (!$faqs->isEmpty())
                                    <button id="bulk-delete-btn" class="main-btn">Delete Selected</button>
                                @endif
                                <button data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="main-btn"
                                    title="Add a Category">
                                    <i class="uil uil-plus-circle"></i> Add Faq
                                </button>
                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                            <div class="table-responsive mt-30">
                                @if ($faqs->isEmpty())
                                    <!-- No Records Found -->
                                    <div class="no-categories-container text-center fade-in-animation footer">
                                        <i class="uil uil-folder-minus bounce-effect"
                                            style="font-size: 50px; color: #d1d1d1;"></i>
                                        <h3 class="mt-3 scale-in-text" style="color: #777;">No Faq Found</h3>
                                        <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                                            Faq yet. Add one now to get started!</p>
                                    </div>
                                @else
                                    <!-- Display Table When Data Exists -->
                                    <table class="ucp-table" id="ucp-table">
                                        <thead class="ucp-table text-left">
                                            <tr>
                                                <th class="text-left">
                                                    <input type="checkbox" id="select-all"> <!-- Select All Checkbox -->
                                                </th>
                                                <th class="text-left">Question</th>
                                                <th class="text-left" scope="col">Answer</th>
                                                <th class="text-left" scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-left"></tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit FAQ Modal -->
        <div class="modal fade" id="editFaqModal" tabindex="-1" aria-labelledby="editFaqModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editFaqForm" method="POST" novalidate class="needs-validation">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editFaqModalLabel">Edit FAQ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="editFaqId" name="faq_id">
                            <div class="mb-3">
                                <label for="editFaqQuestion" class="form-label">Question</label>
                                <input type="text" class="form-control _dlor1" id="editFaqQuestion" name="question"
                                    placeholder="Enter Question" required>
                                <div class="invalid-feedback">Please enter the question.</div>
                            </div>
                            <div class="mb-3">
                                <label for="editFaqAnswer" class="form-label">Answer</label>
                                <textarea class="form-control _dlor1" id="editFaqAnswer" name="answer" rows="4"
                                    placeholder="Enter Answer" required></textarea>
                                <div class="invalid-feedback">Please enter the answer.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="main-btn" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="main-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add FAQ Modal -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" novalidate id="addFaqForm" class="needs-validation">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCategoryModalLabel">Add New FAQ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="addQuestion" class="form-label">Question</label>
                                <input type="text" class="form-control _dlor1" id="addQuestion" name="question"
                                    placeholder="Enter Question" required>
                                <div class="invalid-feedback">Please enter the question.</div>
                            </div>
                            <div class="mb-3">
                                <label for="addAnswer" class="form-label">Answer</label>
                                <textarea class="form-control _dlor1" id="addAnswer" name="answer"
                                    placeholder="Enter Answer" rows="4" required></textarea>
                                <div class="invalid-feedback">Please enter the answer.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="main-btn" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="main-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        @include('admin.layouts.footer')
    </div>
    <!-- Body End -->
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

    <script>
        $(document).ready(function () {
            // Add FAQ Submission
            $('#addFaqForm').submit(function (e) {
                e.preventDefault(); // Prevent the default form submission

                if (!this.checkValidity()) {
                    e.stopPropagation(); // Stop the form from submitting if invalid
                } else {
                    var formData = $(this).serialize(); // Serialize the form data

                    $.ajax({
                        url: $(this).attr('action'), // Get the action URL from the form
                        method: 'POST',
                        data: formData,
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.success, 'Success');
                                $('#addCategoryModal').modal('hide'); // Hide the modal
                                setTimeout(function () {
                                    location.reload(); // Reload the page after a short delay
                                }, 2000);
                            } else {
                                toastr.error('Something went wrong!', 'Error');
                            }
                        }
                    });
                }
                this.classList.add('was-validated'); // Add validation class
            });
        });

    </script>

    <script>
        // Edit FAQ Submission
        $('#editFaqForm').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Check if the form is valid
            if (!this.checkValidity()) {
                e.stopPropagation(); // Stop the form from submitting if invalid
            } else {
                var formData = $(this).serialize(); // Serialize the form data

                $.ajax({
                    url: $(this).attr('action'), // Get the action URL from the form
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            //toastr.success(response.success, 'Success');
                            $('#editFaqModal').modal('hide'); // Hide the modal
                            setTimeout(function () {
                                location.reload(); // Reload the page after a short delay
                            }, 0000);
                        } else {
                            toastr.error('Something went wrong!', 'Error');
                        }
                    }
                    // error: function(xhr) {
                    //     $('.is-invalid').removeClass('is-invalid');
                    //     $('.invalid-feedback').remove();

                    //     if (xhr.status === 422) {
                    //         var errors = xhr.responseJSON.errors;

                    //         for (var field in errors) {
                    //             var inputField = $(`[name="${field}"]`);
                    //             inputField.addClass('is-invalid');
                    //             inputField.after(
                    //                 `<div class="invalid-feedback">${errors[field][0]}</div>`
                    //             );
                    //         }
                    //     } else {
                    //         toastr.error('An error occurred. Please try again.', 'Error');
                    //     }
                    // }
                });
            }
            this.classList.add('was-validated'); // Add validation class
        });

        // Handle Edit Button Click
        $(document).on("click", ".edit-btn", function () {
            let id = $(this).data("id");
            let question = $(this).data("question");
            let answer = $(this).data("answer");

            // Populate the modal fields
            $("#editFaqId").val(id);
            $("#editFaqQuestion").val(question);
            $("#editFaqAnswer").val(answer);

            // Set form action dynamically
            $("#editFaqForm").attr("action", "/faq/" + id);

            // Show the modal
            $("#editFaqModal").modal("show");
        });
    </script>
    <script>
        $(document).ready(function () {
            let table = $('#ucp-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('faq.index') }}",
                "columns": [{
                    "data": "id",
                    "orderable": false,
                    "searchable": false,
                    "render": function (data) {
                        return '<input type="checkbox" class="faq-checkbox" value="' + data +
                            '">';
                    }
                },
                {
                    "data": "question"
                },
                {
                    "data": "answer"
                },
                {
                    "data": "actions",
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row) {
                        return data; // Ensure raw HTML is rendered correctly
                    }
                }
                ]
            });
            // Set global Toastr options
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000",
                "extendedTimeOut": "2000",
                "positionClass": "toast-top-right",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "onShown": function () {
                    $('.toast-success').css({
                        'background-color': '#28a745', // Green for success
                        'opacity': '1'  // Adjust opacity
                    });
                    $('.toast-error').css({
                        'background-color': '#dc3545', // Red for error
                        'opacity': '1'
                    });
                    $('.toast-warning').css({
                        'background-color': '#ffc107', // Yellow for warning
                        'opacity': '1'
                    });
                    $('.toast-info').css({
                        'background-color': '#17a2b8', // Blue for info
                        'opacity': '1'
                    });
                }
            };


            // Handle checkbox selection
            $(document).on('change', '.faq-checkbox', function () {
                let allChecked = $('.faq-checkbox').length === $('.faq-checkbox:checked').length;
                $('#select-all').prop('checked', allChecked);
                toggleBulkDeleteButton();
            });

            // Select/Deselect All
            $('#select-all').on('change', function () {
                $('.faq-checkbox').prop('checked', $(this).prop('checked'));
                toggleBulkDeleteButton();
            });

            // Enable/Disable Bulk Delete button
            function toggleBulkDeleteButton() {
                let anyChecked = $('.faq-checkbox:checked').length > 0;
                $('#bulk-delete-btn').prop('disabled', !anyChecked);
            }

            // Bulk Delete Functionality
            $(document).on('click', '#bulk-delete-btn', function () {
                let selectedIds = $('.faq-checkbox:checked').map(function () {
                    return $(this).val();
                }).get();

                // ✅ Show error Toastr if no category is selected
                if (selectedIds.length === 0) {
                    toastr.warning("Please select at least one FAQ to delete.", "Warning");
                    return; // Stop further execution
                }
                if (selectedIds.length > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to delete ${selectedIds.length} FAQs. This action cannot be undone.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete them!',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('faq.bulk-delete') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    ids: selectedIds,
                                },
                                success: function (response) {
                                    if (response.success) {
                                        location.reload();

                                        $('#select-all').prop('checked', false);
                                        $('#bulk-delete-btn').prop('disabled', true);
                                    } else {
                                        toastr.error(response.error ||
                                            'Failed to delete.', 'Error');
                                    }
                                },
                                error: function (xhr) {
                                    console.error(xhr.responseText);
                                    toastr.error('An error occurred. Please try again.',
                                        'Error');
                                }
                            });
                        }
                    });
                } else {
                    toastr.warning('Please select at least one FAQ to delete.', 'Warning');
                }
            });
        });
    </script>

    <!-- JavaScript for Delete Confirmation -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Event delegation for dynamically loaded buttons
            document.addEventListener("click", function (event) {
                if (event.target.closest(".delete-btn")) {
                    let button = event.target.closest(".delete-btn"); // Find the clicked button
                    let form = button.closest(".delete-form"); // Get the form
                    let faqId = button.getAttribute("data-id"); // Get FAQ ID

                    // SweetAlert Confirmation
                    Swal.fire({
                        title: "Are you sure?",
                        text: "This action cannot be undone!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit the form if user confirms
                        }
                    });
                }
            });
        });
    </script>

@endsection