@extends('admin.layouts.master')
@section('title')
    Category
@endsection
<!-- Body Start -->
@section('content')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class="uil uil-folder-plus"></i> Categories</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card_dash1">
                        <div class="row mt-2">
                            <div class="col-lg-12 col-md-4 col-sm-6 text-end">
                                @if (!$categories->isEmpty())
                                    <button id="bulk-delete-btn" class="main-btn">Delete Selected</button>
                                @endif
                                <button data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="main-btn"
                                    title="Add a Category">
                                    <i class="uil uil-plus-circle"></i> Add Category
                                </button>
                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                            <div class="table-responsive mt-30">
                                @if ($categories->isEmpty())
                                    <!-- No Records Found -->
                                    <div class="no-categories-container text-center fade-in-animation footer">
                                        <i class="uil uil-folder-minus bounce-effect"
                                            style="font-size: 50px; color: #d1d1d1;"></i>
                                        <h3 class="mt-3 scale-in-text" style="color: #777;">No Categories Found</h3>
                                        <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                                            categories yet. Add one now to get started!</p>
                                    </div>
                                @else
                                    <!-- Display Table When Data Exists -->
                                    <table id="category-table" class="ucp-table">
                                        <thead class="ucp-table">
                                            <tr>
                                                <th class="text-left ucp-tabler">
                                                    <input type="checkbox" id="select-all">
                                                </th>
                                                <th class="text-left ucp-tabler" scope="col">Name</th>
                                                <th class="text-left ucp-tabler" scope="col">Description</th>
                                                <th class="text-left ucp-tabler" scope="col">Status</th>
                                                <th class="text-left ucp-tabler" scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-left"></tbody> <!-- Ensure tbody exists -->
                                    </table>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Category Modal -->
        <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
            aria-hidden="true" novalidate>
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editCategoryForm" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_category_id" name="category_id">

                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <!-- Category Name Field -->
                            <div class="mb-3">
                                <label for="edit_category_name" class="form-label">Category Name</label>
                                <input type="text" class="form-control _dlor1" id="edit_category_name" name="category_name"
                                    placeholder="Enter the category name" required>
                                <div class="invalid-feedback">Please provide a category name.</div>
                            </div>

                            <!-- Category Description Field -->
                            <div class="mb-3">
                                <label for="edit_category_description" class="form-label">Category Description</label>
                                <textarea class="form-control _dlor1" id="edit_category_description"
                                    name="category_description" rows="4"
                                    placeholder="Enter the category description ( OPTIONAL )"></textarea>
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

        <!-- Modal for Adding Category -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('category.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" class="form-control _dlor1" id="category_name" name="category_name"
                                    placeholder="Enter the category name" required>
                                <div class="invalid-feedback">Please enter a category name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="category_description" class="form-label">Category Description</label>
                                <textarea class="form-control _dlor1" id="category_description" name="category_description"
                                    rows="4" placeholder="Enter the category description ( OPTIONAL )"></textarea>
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
    {{-- vaildation --}}
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

    {{-- Dispplay list using datatable with bulk delete --}}
    <script>
        $(document).ready(function () {
            let table = $('#category-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('category.index') }}", // Adjust this route
                columns: [{
                    data: 'id',
                    render: function (data) {
                        return '<input type="checkbox" class="category-checkbox" value="' +
                            data + '">';
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
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


            // Handle "Select All" checkbox
            $('#category-table tbody').on('change', '.category-checkbox', function () {
                let allChecked = $('.category-checkbox').length === $('.category-checkbox:checked').length;
                $('#select-all').prop('checked', allChecked);
                toggleBulkDeleteButton();
            });

            $('#select-all').on('change', function () {
                $('.category-checkbox').prop('checked', $(this).prop('checked'));
                toggleBulkDeleteButton();
            });

            function toggleBulkDeleteButton() {
                let anyChecked = $('.category-checkbox:checked').length > 0;
                $('#bulk-delete-btn').prop('disabled', !anyChecked);
            }

            // Bulk Delete Functionality
            $('#bulk-delete-btn').on('click', function () {
                let selectedIds = $('.category-checkbox:checked').map(function () {
                    return $(this).val();
                }).get();

                // ✅ Show error Toastr if no category is selected
                if (selectedIds.length === 0) {
                    toastr.warning("Please select at least one Category to delete.", "Warning");
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete ${selectedIds.length} categories. This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete them!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('categories.bulk-delete') }}', // Adjust this route
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: selectedIds,
                            },
                            success: function (response) {
                                if (response.success) {
                                    $('#select-all').prop('checked', false);
                                    $('#bulk-delete-btn').prop('disabled', true);
                                    location
                                        .reload(); // Reload DataTable full page refresh
                                } else {
                                    toastr.error(response.error || 'Failed to delete.',
                                        'Error');
                                }
                            },
                            error: function (xhr) {
                                if (xhr.status === 400) {
                                    toastr.error(xhr.responseJSON.error, 'Error');
                                } else {
                                    toastr.error('An error occurred. Please try again.',
                                        'Error');
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>

    {{-- AJAX form submission for Add Category --}}
    <script>
        $(document).ready(function () {
            let isCancelClicked = false;

            // Track if the cancel button is clicked
            $('.cancel-btn').on('click', function () {
                isCancelClicked = true;
                $('#addCategoryModal').modal('hide'); // Close modal properly
            });

            $('#addCategoryModal form').on('submit', function (e) {
                e.preventDefault();

                var form = $(this)[0];
                if (form.checkValidity() === false) {
                    e.stopPropagation();
                }

                form.classList.add('was-validated'); // Bootstrap's validation classes

                if (form.checkValidity() === true) {
                    var formData = $(this).serialize();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: formData,
                        success: function (response) {
                            if (response.success) {
                                $('#addCategoryModal').modal('hide');
                                toastr.success(response.success, 'Success');
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            }
                        }
                        // error: function(xhr) {
                        //     if (xhr.status === 422) {
                        //         var errors = xhr.responseJSON.errors;
                        //         for (var field in errors) {
                        //             var inputField = $([name="${field}"]);
                        //             inputField.addClass('is-invalid');
                        //             inputField.after(
                        //                 <div class="invalid-feedback">${errors[field][0]}</div>
                        //             );
                        //         }
                        //     } else {
                        //         toastr.error('An unexpected error occurred. Please try again.',
                        //             'Error');
                        //     }
                        // }
                    });
                }
            });
        });

    </script>

    <!-- JavaScript for Delete Confirmation -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.body.addEventListener("click", function (event) {
                if (event.target.closest(".delete-btn")) {
                    event.preventDefault(); // Prevent default anchor behavior

                    const button = event.target.closest(".delete-btn");
                    const form = button.closest(".delete-form");
                    const categoryName = button.getAttribute("data-username");

                    Swal.fire({
                        title: `Are you sure?`,
                        text: `You are about to delete the category "${categoryName}". This action cannot be undone.`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit the form if the user confirms
                        }
                    });
                }
            });
        });
    </script>

    {{-- Use event delegation to handle dynamically loaded toggle switches --}}
    <script>
        $(document).ready(function () {
            $(document).on('change', '.toggle-input', function () {
                let categoryId = $(this).data('id');
                let isActive = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '{{ route('categories.update-status') }}', // Blade template syntax
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        category_id: categoryId,
                        is_active: isActive
                    },
                    success: function (response) {
                        toastr.success(response.success, 'Success');
                    },
                    error: function () {
                        toastr.error('Error updating category status.', 'Error');
                    }
                });
            });
        });
    </script>

    {{-- Open Edit Mod al and Populate Data --}}
    <script>
        $(document).ready(function () {
            $(document).on('click', '.edit-category', function () {
                let categoryId = $(this).data('id');
                let categoryName = $(this).data('name');
                let categoryDescription = $(this).data('description');

                // Populate modal fields
                $('#edit_category_id').val(categoryId);
                $('#edit_category_name').val(categoryName);
                $('#edit_category_description').val(categoryDescription);

                // Show modal
                $('#editCategoryModal').modal('show');
            });

            // Handle Update Category Submission via AJAX
            $('#editCategoryForm').submit(function (e) {
                e.preventDefault(); // Prevent default form submission

                let categoryId = $('#edit_category_id').val();
                let formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: `/category/${categoryId}`, // Resourceful route
                    method: 'PUT', // Laravel requires PUT for update
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.success, 'Success');

                            // Close modal and reload table
                            $('#editCategoryModal').modal('hide');
                            location.reload();
                        }
                    }
                    // error: function(xhr) {
                    //     $('.is-invalid').removeClass('is-invalid');
                    //     $('.invalid-feedback').remove();

                    //     if (xhr.status === 422) {
                    //         let errors = xhr.responseJSON.errors;
                    //         for (let field in errors) {
                    //             let inputField = $(`[name="${field}"]`);
                    //             inputField.addClass('is-invalid');
                    //             inputField.after(
                    //                 `<div class="invalid-feedback">${errors[field][0]}</div>`
                    //             );
                    //         }
                    //     } else {
                    //         toastr.error('An unexpected error occurred. Please try again.',
                    //             'Error');
                    //     }
                    // }
                });
            });
        });
    </script>
@endsection