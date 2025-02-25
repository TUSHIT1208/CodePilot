@extends('admin.layouts.master')
@section('title')
    Subcategory
@endsection
@section('content')
    <!-- Body Start -->
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class="uil uil-folder-plus"></i> Subcategories</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card_dash1">
                        <div class="row mt-2">
                            <div
                                class="col-lg-12 col-md-4 col-sm-6 text-end d-flex justify-content-end align-items-center gap-2">
                                @if (!$subcategories->isEmpty())
                                    <!-- Category Dropdown -->
                                    <select id="category-filter" class="form-control _dlor1" style="width: 200px;">
                                        <option value="">-- Filter by Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    <button id="bulk-delete-btn" class="main-btn">Delete Selected</button>
                                @endif

                                <button data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="main-btn"
                                    title="Add a Category">
                                    <i class="uil uil-plus-circle"></i> Add Subcategories
                                </button>
                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                            <div class="table-responsive mt-30">
                                @if ($subcategories->isEmpty())
                                    <!-- No Records Found -->
                                    <div class="no-categories-container text-center fade-in-animation footer">
                                        <i class="uil uil-folder-minus bounce-effect"
                                            style="font-size: 50px; color: #d1d1d1;"></i>
                                        <h3 class="mt-3 scale-in-text" style="color: #777;">No SubCategories Found</h3>
                                        <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                                            Sub-categories yet. Add one now to get started!</p>
                                    </div>
                                @else
                                    <!-- Display Table When Data Exists -->
                                    <table class="ucp-table">
                                        <thead>
                                            <tr>
                                                <th class="text-left ">
                                                    <input type="checkbox" id="select-all"> <!-- Select All Checkbox -->
                                                </th>
                                                <th class="text-left ">Name</th>
                                                <th class="text-left " scope="col">Description</th>
                                                <th class="text-left ">Category</th>
                                                <th class="text-left " scope="col">Status</th>
                                                <th class="text-left " scope="col">Actions</th>
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

        <!-- Edit Subcategory Modal (Single) -->
        <div class="modal fade" id="editSubcategoryModal" tabindex="-1" aria-labelledby="editSubcategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Note: The form action will be set dynamically when opening the modal -->
                    <form id="edit-subcategory-form" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="subcategory_id" name="subcategory_id">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editSubcategoryModalLabel">Edit Subcategory</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="subcategory_name" class="form-label">Subcategory Name</label>
                                <input type="text" class="form-control _dlor1" id="subcategory_name"
                                    name="subcategory_name_edit" placeholder="Enter the subcategory name" required>
                                <div class="invalid-feedback">
                                    Please provide a subcategory name.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="subcategory_description" class="form-label">Subcategory Description</label>
                                <textarea class="form-control _dlor1" id="subcategory_description" name="subcategory_description_edit" rows="4"
                                    placeholder="Enter the subcategory description (OPTIONAL)"></textarea>
                                <div class="invalid-feedback">
                                    Please provide a valid description.
                                </div>
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
                    <form id="subcategoryForm" action="{{ route('subcategory.store') }}" method="POST"
                        enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSubcategoryModalLabel">Add New Subcategory</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Select Category</label>
                                <select class="form-control _dlor1" id="category_id" name="category_id" required>
                                    <option value="">-- Select a Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select a category.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="subcategory_name" class="form-label">Subcategory Name</label>
                                <input type="text" class="form-control _dlor1" id="subcategory_name"
                                    name="subcategory_name" value="{{ old('subcategory_name') }}"
                                    placeholder="Enter the subcategory name" required>
                                <div class="invalid-feedback">
                                    Please provide a subcategory name.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="subcategory_description" class="form-label">Subcategory Description</label>
                                <textarea class="form-control _dlor1" id="subcategory_description" name="subcategory_description" rows="4"
                                    placeholder="Enter the subcategory description (OPTIONAL)">{{ old('subcategory_description') }}</textarea>                                    
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="main-btn" data-bs-dismiss="modal" id="cancel-add-modal">Cancel</button>
                            <button type="submit" class="main-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('admin.layouts.footer')
    </div>
    <!-- Body End -->

    <!-- Bootstrap Client-Side Validation Script -->
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

        // add subcategory toaster
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
                        // Show success Toastr message
                        toastr.success(response.success, 'Success');

                        $('#addCategoryModal').modal('hide'); // Close modal

                        // Reload the page after 2 seconds
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
                            var inputField = $('input[name="' + field +
                                '"], select[name="' + field + '"], textarea[name="' +
                                field + '"]');
                            inputField.addClass('is-invalid');

                            // Add error message
                            inputField.after('<div class="invalid-feedback">' + errors[
                                field][0] + '</div>');
                        }
                    } else {
                        toastr.error('An unexpected error occurred. Please try again.',
                            'Error');
                    }
                }
            });
        });

    </script>

    <script>
        $(document).ready(function() {
            var table = $('.ucp-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('subcategory.index') }}",
                    data: function(d) {
                        d.category_id = $('#category-filter').val(); // Send selected category ID
                    }
                },
                columns: [{
                        data: 'id',
                        render: function(data) {
                            return '<input type="checkbox" class="item-checkbox" value="' + data + '">';
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
                        data: 'category_name',
                        name: 'category.name'
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
                        'background-color': '#28a745',
                        'opacity': '1'
                    });
                    $('.toast-error').css({
                        'background-color': '#dc3545',
                        'opacity': '1'
                    });
                    $('.toast-warning').css({
                        'background-color': '#ffc107',
                        'opacity': '1'
                    });
                    $('.toast-info').css({
                        'background-color': '#17a2b8',
                        'opacity': '1'
                    });
                }
            };

            // Trigger table reload when category is selected
            $('#category-filter').on('change', function() {
                table.ajax.reload();
            });

            $('.ucp-table tbody').on('change', '.item-checkbox', function() {
                let allChecked = $('.item-checkbox').length === $('.item-checkbox:checked').length;
                $('#select-all').prop('checked', allChecked);
                toggleBulkDeleteButton();
            });

            $('#select-all').on('change', function() {
                $('.item-checkbox').prop('checked', $(this).prop('checked'));
                toggleBulkDeleteButton();
            });

            function toggleBulkDeleteButton() {
                let anyChecked = $('.item-checkbox:checked').length > 0;
                $('#bulk-delete-btn').prop('disabled', !anyChecked);
            }

            $('#bulk-delete-btn').on('click', function() {
                let selectedIds = $('.item-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();
                if (selectedIds.length === 0) {
                    toastr.warning("Please select at least one Sub-category to delete.", "Warning");
                    return;
                }
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete ${selectedIds.length} items. This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete them!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('subcategories.bulk-delete') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: selectedIds,
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('#select-all').prop('checked', false);
                                    $('#bulk-delete-btn').prop('disabled', true);
                                    location.reload();
                                } else {
                                    toastr.error(response.error || 'Failed to delete.', 'Error');
                                }
                            },
                            error: function() {
                                toastr.error('An error occurred. Please try again.', 'Error');
                            }
                        });
                    }
                });
            });
        });
    </script>

    <!-- Delete Confirmation Script -->
    <script>
        $(document).ready(function() {
            $(document).on("click", ".delete-btn", function(e) {
                e.preventDefault();
                var form = $(this).closest(".delete-form");
                var subcategoryName = $(this).data("name");
                Swal.fire({
                    title: "Are you sure?",
                    text: `You are about to delete ${subcategoryName}. This action cannot be undone.`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <!-- Toggle Subcategory Status Script -->
    <script>
        $(document).ready(function() {
            $(document).on('change', '.toggle-input', function() {
                let subCategoryId = $(this).data('id');
                let isActive = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('update.subcategory.status') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        sub_category_id: subCategoryId,
                        is_active: isActive
                    },
                    success: function(response) {
                        toastr.success(response.success, 'Success');
                    },
                    error: function() {
                        toastr.error('Error updating subcategory status.', 'Error');
                    }
                });
            });
        });
    </script>

    <!-- Edit Subcategory Modal Setup -->
    <script>
        $(document).ready(function () {
            // Open the Edit Subcategory Modal and set the form action dynamically
            $(document).on("click", ".edit-category", function () {
                let subcategoryId = $(this).data("id");
                let subcategoryName = $(this).data("name");
                let subcategoryDescription = $(this).data("description");
    
                // Populate the modal fields
                $("#subcategory_id").val(subcategoryId);
                $("#subcategory_name").val(subcategoryName);
                $("#subcategory_description").val(subcategoryDescription);
    
                // Set the form action dynamically
                let actionUrl = "{{ url('subcategory') }}/" + subcategoryId;
                $("#edit-subcategory-form").attr("action", actionUrl);
    
                // Show the modal
                $("#editSubcategoryModal").modal("show");
            });
    
            // Handle the form submission via AJAX
            $("#edit-subcategory-form").submit(function (e) {
                e.preventDefault(); // Prevent the default form submission
    
                let form = $(this);
                let formData = form.serialize();
    
                $.ajax({
                    url: form.attr("action"),
                    method: "POST",
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            
    
                            $("#editSubcategoryModal").modal("hide");
    
                            // Reload the page after a short delay
                            setTimeout(function () {
                                location.reload();
                            }, 0000);
                        }
                    },
                    error: function (xhr) {
                        // Remove existing validation feedback
                        $(".is-invalid").removeClass("is-invalid");
                        $(".invalid-feedback").remove();
    
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
    
                            for (let field in errors) {
                                let inputField = $('input[name="' + field + '"], textarea[name="' + field + '"]');
                                inputField.addClass("is-invalid");
    
                                // Append error message
                                inputField.after('<div class="invalid-feedback">' + errors[field][0] + "</div>");
                            }
                        } 
                    },
                });
            });
        });
    </script>
    
    
@endsection
