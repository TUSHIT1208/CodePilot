@extends('admin.layouts.master')
@section('title') Frequintly ask Question @endsection
@section('content')
<!-- Body Start -->
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="st_title"><i class="uil uil-folder-plus"></i> faqs </h2>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card_dash1">
                    <div class="row mt-2">
                        <div class="col-lg-2">
                            <h4 class=""><i class="uil uil-plus"></i> Add Faq</h4>
                        </div>
                        <div class="col-lg-7"></div>
                        <div class="col-lg-3 col-md-4 col-sm-6 text-end">
                            <button data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="main-btn"
                                title="Add a Category">
                                <i class="uil uil-plus-circle"></i> Add Faq
                            </button>
                        </div>
                    </div>

                    <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                        <div class="table-responsive mt-30">
                            @if($faqs->isEmpty())
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
                                    <thead class="ucp-table text-center">
                                        <tr>
                                            <th class="text-center ucp-tabler">
                                                <input type="checkbox" id="select-all"> <!-- Select All Checkbox -->
                                            </th>
                                            <th class="text-center ucp-table" scope="col">Item No.</th>
                                            <th class="text-center ucp-table">Question</th>
                                            <th class="text-center ucp-table" scope="col">Answer</th>
                                            <th class="text-center ucp-table" scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center"></tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    @if(!$faqs->isEmpty())
                        <div class="card-footer mt-4">
                            <div class="mt-3">
                                <button id="bulk-delete-btn" class="main-btn" disabled>Delete Selected</button>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                {{ $faqs->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editFaqModal" tabindex="-1" aria-labelledby="editFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editFaqForm" method="POST">
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
                            <input type="text" class="form-control" id="editFaqQuestion" name="question" required>
                        </div>
                        <div class="mb-3">
                            <label for="editFaqAnswer" class="form-label">Answer</label>
                            <textarea class="form-control" id="editFaqAnswer" name="answer" rows="4"
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal for Adding Category -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('faq.store') }}" method="POST">
                    @csrf`
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">
                            <i class="uil uil-plus-circle"></i> Add New Faq
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Category Name Field -->
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Question</label>
                            <input type="text" class="form-control _dlor1" id="name" name="question"
                                placeholder="Enter the question">
                            <div class="invalid-feedback" id="category_name_error"></div>
                        </div>

                        <!-- Category Description Field -->
                        <div class="mb-3">
                            <label for="category_description" class="form-label">Answer</label>
                            <textarea class="form-control _dlor1" id="description" name="answer" rows="4"
                                placeholder="Enter the answer"></textarea>
                            <div class="invalid-feedback" id="category_description_error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="main-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="main-btn">Add Faq</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('admin.layouts.footer')
</div>
<!-- Body End -->

<script>
    $(document).ready(function () {
        let table = $('#ucp-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('faq.index') }}",
            "columns": [
                { "data": "checkbox", "orderable": false, "searchable": false },
                { "data": "id" },
                { "data": "question" },
                { "data": "answer" },
                { "data": "actions", "orderable": false, "searchable": false }
            ]
        });
    });
</script>

<script>
    $(document).ready(function () {
        // AJAX form submission for Add Category
        $('#addCategoryModal form').submit(function (e) {
            e.preventDefault(); // Prevent default form submission

            // Get form data
            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'), // URL for form submission
                method: $(this).attr('method'), // Use POST method
                data: formData, // Form data
                success: function (response) {
                    if (response.success) {
                        // Configure Toastr
                        toastr.options = {
                            closeButton: true,
                            debug: false,
                            newestOnTop: true,
                            progressBar: true,
                            positionClass: "toast-bottom-right",
                            preventDuplicates: true,
                            timeOut: 5000, // Display duration of the toast (5 seconds)
                            extendedTimeOut: 1000,
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut"
                        };

                        // Show success toast
                        toastr.success(response.success, 'Success');

                        // Close modal and reload page after 2 seconds
                        setTimeout(function () {
                            $('#addCategoryModal').modal('hide'); // Close modal
                            location.reload(); // Reload the page
                        }, 2000);
                    }
                },
                error: function (xhr) {
                    // Remove existing validation feedback
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    if (xhr.status === 422) { // Validation error
                        var errors = xhr.responseJSON.errors;

                        for (var field in errors) {
                            // Highlight the field with error
                            var inputField = $(`[name="${field}"]`);
                            inputField.addClass('is-invalid');

                            // Add error message
                            inputField.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                        }
                    } else {
                        toastr.error('An unexpected error occurred. Please try again.', 'Error');
                    }
                }
            });
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
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
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

<script>
    $(document).ready(function () {
        // Select All Checkbox
        $('#select-all').change(function () {
            $('.category-checkbox').prop('checked', this.checked);
            toggleBulkDeleteButton();
        });

        // Individual Checkbox
        $('.category-checkbox').change(function () {
            const allChecked = $('.category-checkbox').length === $('.category-checkbox:checked').length;
            $('#select-all').prop('checked', allChecked);
            toggleBulkDeleteButton();
        });

        // Enable/Disable Bulk Delete Button
        function toggleBulkDeleteButton() {
            const anyChecked = $('.category-checkbox:checked').length > 0;
            $('#bulk-delete-btn').prop('disabled', !anyChecked);
        }

        // Bulk Delete
        $('#bulk-delete-btn').click(function () {
            const selectedIds = $('.category-checkbox:checked').map(function () {
                return $(this).val();
            }).get();

            if (selectedIds.length > 0) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete ${selectedIds.length} categories. This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete them!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/categories/bulk-delete', // Replace with your route
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: selectedIds,
                            },
                            success: function (response) {
                                if (response.success) {
                                    toastr.success(response.success, 'Success');
                                    location.reload(); // Reload page to refresh data
                                } else {
                                    toastr.error(response.error, 'Error');
                                }
                            },
                            error: function () {
                                toastr.error('An error occurred. Please try again.', 'Error');
                            },
                        });
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
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
    });
</script>

@endsection