@extends('admin.layouts.master')
@section('title')
    learning-path
@endsection
@section('content')
    <!-- Body Start -->
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class="uil uil-folder-plus"></i> Learning path</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card_dash1">
                        <div class="row mt-2">
                            <div class="col-lg-12 col-md-12 col-sm-12 text-end">
                                @if (!$learningpath->isEmpty())
                                    <button id="bulk-delete-btn" class="main-btn">Delete Selected</button>
                                @endif
                                <button data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="main-btn"
                                    title="Add a Category">
                                    <i class="uil uil-plus-circle"></i> Add Learning path
                                </button>
                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                            <div class="table-responsive mt-30">
                                @if ($learningpath->isEmpty())
                                    <!-- No Records Found -->
                                    <div class="no-categories-container text-center fade-in-animation footer">
                                        <i class="uil uil-folder-minus bounce-effect"
                                            style="font-size: 50px; color: #d1d1d1;"></i>
                                        <h3 class="mt-3 scale-in-text" style="color: #777;">No Learning path Found</h3>
                                        <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                                            learning path yet. Add one now to get started!</p>
                                    </div>
                                @else
                                    <table id="learningPathTable" class="ucp-table">
                                        <thead>
                                            <tr>
                                                <th class="text-left ucp-table"><input type="checkbox" id="select-all"></th>
                                                <th class="text-left ucp-table">Learning Path Name</th>
                                                <th class="text-left ucp-table">Description</th>
                                                <th class="text-left ucp-table">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-left ucp-table"></tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editForm" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit-id">

                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Learning Path</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit-name" class="form-label">Learning Path Name</label>
                                <input type="text" class="form-control _dlor1" id="edit-name" name="name" placeholder="Enter the path name" required>
                                <div class="invalid-feedback">Please provide a path name.</div>
                            </div>

                            <div class="mb-3">
                                <label for="edit-description" class="form-label">Description</label>
                                <textarea class="form-control _dlor1" id="edit-description" name="description" rows="3" placeholder="Enter the description (OPTIONAL)"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="main-btn" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="main-btn">Save Learning Path</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal for Adding Learning Path -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('learningpath.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCategoryModalLabel">Add New Learning Path</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Path Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Path Name</label>
                                <input type="text" class="form-control _dlor1" id="name" name="name" placeholder="Enter the path name" required>
                                <div class="invalid-feedback">Please provide a path name.</div>
                            </div>

                            <!-- Path Description Field -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Learning Path Description</label>
                                <textarea class="form-control _dlor1" id="description" name="description" rows="4" placeholder="Enter the description (OPTIONAL)"></textarea>
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
    // This script applies Bootstrap's custom validation to all forms with the .needs-validation class.
    document.addEventListener("DOMContentLoaded", function () {
            var forms = document.querySelectorAll(".needs-validation");
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
        $(document).ready(function() {
            let table = $('#learningPathTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('learningpath.index') }}",
                columns: [{
                        data: "id",
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return '<input type="checkbox" class="learningpath-checkbox" value="' +
                                data + '">';
                        }
                    },
                    {
                        data: "name",
                        name: "name"
                    },
                    {
                        data: "description",
                        name: "description"
                    },
                    {
                        data: "actions",
                        orderable: false,
                        searchable: false
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
                "onShown": function() {
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

            // Handle individual checkbox selection
            $(document).on("change", ".learningpath-checkbox", function() {
                let allChecked = $(".learningpath-checkbox").length === $(".learningpath-checkbox:checked")
                    .length;
                $("#select-all").prop("checked", allChecked);
                toggleBulkDeleteButton();
            });

            // Select/Deselect All
            $("#select-all").on("change", function() {
                $(".learningpath-checkbox").prop("checked", $(this).prop("checked"));
                toggleBulkDeleteButton();
            });

            // Enable/Disable Bulk Delete button
            function toggleBulkDeleteButton() {
                let anyChecked = $(".learningpath-checkbox:checked").length > 0;
                $("#bulk-delete-btn").prop("disabled", !anyChecked);
            }

            // Bulk Delete Functionality
            $(document).on("click", "#bulk-delete-btn", function() {
                let selectedIds = $(".learningpath-checkbox:checked").map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: `You are about to delete ${selectedIds.length} Learning Paths. This action cannot be undone.`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete them!",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('learningpath.bulk-delete') }}",
                                type: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    ids: selectedIds,
                                },
                                success: function(response) {
                                    if (response.success) {
                                        

                                        // Delay the page refresh to allow Toastr to be displayed
                                        setTimeout(function() {
                                            location.reload();
                                        }, 0000); // Refresh after 0 seconds

                                        $("#select-all").prop("checked", false);
                                        $("#bulk-delete-btn").prop("disabled", true);
                                    } else {
                                        toastr.error(response.error ||
                                            "Failed to delete.", "Error");
                                    }
                                },
                                error: function(xhr) {
                                    console.error(xhr.responseText);
                                    toastr.error("An error occurred. Please try again.",
                                        "Error");
                                }
                            });
                        }
                    });
                } else {
                    toastr.warning("Please select at least one Learning Path to delete.", "Warning");
                }
            });
        });
    </script>

    {{-- add lerningpath --}}
    <script>
        $(document).ready(function() {
            $('.main-btn[data-bs-dismiss="modal"]').on('click', function() {
                // Reset form fields
                $('#addCategoryModal form')[0].reset();
                $('#editForm')[0].reset();

                // Remove validation errors
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            });

            // AJAX form submission for Add Category
            $('#addCategoryModal form').submit(function(e) {
                e.preventDefault(); // Prevent default form submission

                // Get form data
                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'), // URL for form submission
                    method: $(this).attr('method'), // Use POST method
                    data: formData, // Form data
                    success: function(response) {
                        if (response.success) {
                            
                            $('#addCategoryModal').modal('hide'); // Close modal
                            // Show success toast
                            toastr.success(response.success, 'Success');

                            // Close modal and reload page after 2 seconds
                            setTimeout(function() {
                                location.reload(); // Reload the page
                            }, 5000);
                        }
                    },
                    error: function(xhr) {
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
                                inputField.after(
                                    `<div class="invalid-feedback">${errors[field][0]}</div>`
                                    );
                            }
                        } 
                    }
                });
            });
        });
    </script>

    <script>
        $(document).on('click', '.delete-btn', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/learningpath/" + id,
                        type: "POST",
                        data: {
                            _method: "DELETE",
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                location.reload();
                            } else {
                                toastr.error("Something went wrong!", "Error");
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Failed to delete learning path.', 'error');
                        }
                    });
                }
            });
        });
    </script>


    {{-- edit --}}
    <script>
        $(document).ready(function() {
            // Open Edit Modal and Fill Data
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let description = $(this).data('description');

                $('#edit-id').val(id);
                $('#edit-name').val(name);
                $('#edit-description').val(description);

                // Clear validation errors
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                $('#editModal').modal('show'); // Open modal
            });

            // Handle Update Form Submission (AJAX)
            $('#editForm').submit(function(e) {
                e.preventDefault();

                let id = $('#edit-id').val();
                let name = $('#edit-name').val();
                let description = $('#edit-description').val();

                $.ajax({
                    url: "/learningpath/" + id,
                    type: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        description: description
                    },
                    success: function(response) {
                        if (response.success) {
                            // toastr.success(response.success, "Success");
                            $('#editModal').modal('hide'); // Close modal
                            setTimeout(function() {
                                location.reload();
                            }, 0000); // Refresh after 3 seconds
                        } else {
                            toastr.error("Something went wrong!", "Error");
                        }
                    },
                    error: function(xhr) {
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            for (let field in errors) {
                                let inputField = $(`#edit-${field}`);
                                inputField.addClass('is-invalid');
                                inputField.after(
                                    `<div class="invalid-feedback">${errors[field][0]}</div>`
                                    );
                            }
                        }   
                    }
                });
            });
        });
    </script>
@endsection
