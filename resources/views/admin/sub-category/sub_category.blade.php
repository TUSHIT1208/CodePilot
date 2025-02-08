@include('admin.layouts.master')
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
                                <div class="col-lg-2">
                                    <h4 class=""><i class="uil uil-plus"></i> Add Subcategories</h4>
                                </div>
                                <div class="col-lg-7">
                                  
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 text-end">
                                    <button data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="main-btn" title="Add a Category">
                                        <i class="uil uil-plus-circle"></i> Add a Subcategories
                                    </button>
                                </div>                                
                            </div>
                
                            <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                                <div class="table-responsive mt-30">
                                    @if($subcategories->isEmpty())
                                        <!-- No Records Found -->
                                        <div class="no-categories-container text-center fade-in-animation footer">
                                            <i class="uil uil-folder-minus bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                                            <h3 class="mt-3 scale-in-text" style="color: #777;">No SubCategories Found</h3>
                                            <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any categories yet. Add one now to get started!</p>
                                            
                                        </div>
                                    @else
                                        <!-- Display Table When Data Exists -->
                                        <table class="ucp-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center ">
                                                        <input type="checkbox" id="select-all"> <!-- Select All Checkbox -->
                                                    </th>
                                                    
                                                    <th class="text-center ">category</th>
                                                    <th class="text-center ">Name</th>
                                                    <th class="text-center " scope="col">Description</th>
                                                    <th class="text-center " scope="col">Status</th>
                                                    <th class="text-center " scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center"></tbody>
                                        </table>                      
                                    @endif
                                </div>
                            </div>
                            @if(!$subcategories->isEmpty())
                                <div class="card-footer mt-4">
                                    <div class="mt-3">
                                        <button id="bulk-delete-btn" class="main-btn" disabled>Delete Selected</button>
                                    </div>                                
                                    {{-- <div class="d-flex justify-content-end mt-3">
                                        {{ $subcategories->links('pagination::bootstrap-5') }}
                                    </div> --}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
           @foreach($subcategories as $subcategory)
    <!-- Edit Subcategory Modal -->
    <div class="modal fade" id="editSubcategoryModal{{ $subcategory->id }}" tabindex="-1"
         aria-labelledby="editSubcategoryModalLabel{{ $subcategory->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="edit-subcategory-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Hidden field to store subcategory ID -->
                    <input type="hidden" name="subcategory_id" value="{{ $subcategory->id }}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="editSubcategoryModalLabel{{ $subcategory->id }}">
                            Edit Subcategory
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="subcategory_name_{{ $subcategory->id }}" class="form-label">Subcategory Name</label>
                            <input type="text" class="form-control" id="subcategory_name_{{ $subcategory->id }}"
                                   name="subcategory_name_edit" value="{{ $subcategory->name }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory_description_{{ $subcategory->id }}" class="form-label">Subcategory Description</label>
                            <textarea class="form-control" id="subcategory_description_{{ $subcategory->id }}"
                                      name="subcategory_description_edit" rows="4">{{ $subcategory->description }}</textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

        
    <!-- Modal for Adding Category -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="subcategoryForm" action="{{ route('sub_category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSubcategoryModalLabel"><i class="uil uil-plus-circle"></i> Add a New Subcategory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Select Category</label>
                            <select class="form-control _dlor1" id="category_id" name="category_id">
                                <option value="">-- Select a Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror --}}
                        </div>
                    
                        <div class="mb-3">
                            <label for="subcategory_name" class="form-label">Subcategory Name</label>
                            <input type="text" class="form-control _dlor1" id="subcategory_name" name="subcategory_name" value="{{ old('subcategory_name') }}" placeholder="Enter the subcategory name" >
                            <div class="invalid-feedback" id="subcategory_name_error"></div>
                            {{-- @error('subcategory_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror --}}
                        </div>
                    
                        <div class="mb-3">
                            <label for="subcategory_description" class="form-label">Subcategory Description</label>
                            <textarea class="form-control _dlor1" id="subcategory_description" name="subcategory_description" rows="4" placeholder="Enter the subcategory description" >{{ old('subcategory_description') }}</textarea>
                            <div class="invalid-feedback" id="subcategory_description_error"></div>
                            {{-- @error('subcategory_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror --}}
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button class="main-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="main-btn">Add Subcategory</button>
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
        var table = $('.ucp-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('sub_category.index') }}",
            columns: 
            [
                { 
                    data: 'id', 
                    render: function(data) {
                        return '<input type="checkbox" class="item-checkbox" value="'+ data +'">';
                    },
                    orderable: false, 
                    searchable: false
                },
                { data: 'category_name', name: 'category.name' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    
        $('.ucp-table tbody').on('change', '.item-checkbox', function () {
            let allChecked = $('.item-checkbox').length === $('.item-checkbox:checked').length;
            $('#select-all').prop('checked', allChecked);
            toggleBulkDeleteButton();
        });
    
        $('#select-all').on('change', function () {
            $('.item-checkbox').prop('checked', $(this).prop('checked'));
            toggleBulkDeleteButton();
        });
    
        function toggleBulkDeleteButton() {
            let anyChecked = $('.item-checkbox:checked').length > 0;
            $('#bulk-delete-btn').prop('disabled', !anyChecked);
        }
    
        $('#bulk-delete-btn').on('click', function () {
            let selectedIds = $('.item-checkbox:checked').map(function () {
                return $(this).val();
            }).get();
    
            if (selectedIds.length > 0) {
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
                            url: '{{ route("subcategories.bulk-delete") }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: selectedIds,
                            },
                            success: function (response) {
                                if (response.success) {
                                    toastr.success(response.success, 'Success');
                                    $('#select-all').prop('checked', false);
                                    $('#bulk-delete-btn').prop('disabled', true);
                                    table.ajax.reload();
                                } else {
                                    toastr.error(response.error || 'Failed to delete.', 'Error');
                                }
                            },
                            error: function () {
                                toastr.error('An error occurred. Please try again.', 'Error');
                            }
                        });
                    }
                });
            }
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
                   // toastr.error('An unexpected error occurred. Please try again.', 'Error');
                }
            }
        });
    });
    $('#editSubcategoryModal form').submit(function (e) {
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
                    
                    $('#editSubcategoryModal').modal('hide'); // Close modal
                    // // Close modal and reload page after 2 seconds
                    // setTimeout(function () {
                    //     location.reload(); // Reload the page
                    // }, 2000);
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
                   // toastr.error('An unexpected error occurred. Please try again.', 'Error');
                }
            }
        });
    });
});

</script>

<!-- JavaScript for Delete Confirmation -->
<script>
    $(document).ready(function () {
    $(document).on("click", ".delete-btn", function (e) {
        e.preventDefault(); // Prevent default action

        var form = $(this).closest(".delete-form"); // Get the closest delete form
        var username = $(this).data("username"); // Get the username

        Swal.fire({
            title: "Are you sure?",
            text: `You are about to delete ${username}. This action cannot be undone.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Submit the form if confirmed
            }
        });
    });
});
</script>

<script>
    $(document).ready(function () {
        $(document).on('change', '.toggle-input', function () {
            let subCategoryId = $(this).data('id'); 
            let isActive = $(this).is(':checked') ? 1 : 0; 

            $.ajax({
                url: '{{ route("update.subcategory.status") }}', // Corrected route name
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', 
                    sub_category_id: subCategoryId, // Corrected parameter name
                    is_active: isActive
                },
                success: function (response) {
                    toastr.success(response.success, 'Success'); 
                },
                error: function () {
                    toastr.error('Error updating subcategory status.', 'Error'); 
                }
            });
        });
    });
</script>

<script>
$(document).ready(function () {
    // Open the Edit Subcategory Modal
    $(document).on('click', '.edit-category', function () {
        let subcategoryId = $(this).data('id');
        let subcategoryName = $(this).data('name');
        let subcategoryDescription = $(this).data('description');

        // Clear previous error states
        $(`#editSubcategoryModal${subcategoryId} .is-invalid`).removeClass('is-invalid');
        $(`#editSubcategoryModal${subcategoryId} .invalid-feedback`).remove();

        // Populate the modal fields using dynamic IDs
        $(`#subcategory_name_${subcategoryId}`).val(subcategoryName);
        $(`#subcategory_description_${subcategoryId}`).val(subcategoryDescription);

        // Show the correct modal using the subcategory ID
        $(`#editSubcategoryModal${subcategoryId}`).modal('show');
    });

    // Handle Update Subcategory Submission via AJAX
    $('.edit-subcategory-form').submit(function (e) {
        e.preventDefault(); // Prevent default form submission

        let form = $(this);
        let subcategoryId = form.find('[name="subcategory_id"]').val(); // Fetch the subcategory ID from hidden input
        let formData = form.serialize(); // Serialize form data for sending to the server

        $.ajax({
            url: `/sub_category/${subcategoryId}`, // Ensure this is the correct route URL
            method: 'PUT', // Laravel requires PUT for update
            data: formData,
            success: function (response) {
                if (response.success) {
                    toastr.success(response.success, 'Success');

                    // Close modal and reload table
                    $(`#editSubcategoryModal${subcategoryId}`).modal('hide');
                    $('#subcategory-table').DataTable().ajax.reload(); // Reload DataTable
                }
            },
            error: function (xhr) {
                // Clear previous error states
                $(this).find('.is-invalid').removeClass('is-invalid');
                $(this).find('.invalid-feedback').remove();

                // Handle form validation errors
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        let inputField = $(`[name="${field}"]`);
                        inputField.addClass('is-invalid');
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
