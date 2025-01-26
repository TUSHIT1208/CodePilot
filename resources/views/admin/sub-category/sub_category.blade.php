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
                                    <div class="search120">
                                        <div class="ui search">
                                            <div class="ui left icon input swdh10">
                                                <input class="prompt srch10" type="text" placeholder="Search for Categories..">
                                                <i class='uil uil-search-alt icon icon1'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 text-end">
                                    <a data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="upload_btn" title="Add a Category">
                                        <i class="uil uil-plus-circle"></i> Add a Subcategories
                                    </a>
                                </div>                                
                            </div>
                
                            <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                                <div class="table-responsive mt-30">
                                    @if($subcategories->isEmpty())
                                        <!-- No Records Found -->
                                        <div class="no-categories-container text-center fade-in-animation footer">
                                            <i class="uil uil-folder-minus bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                                            <h3 class="mt-3 scale-in-text" style="color: #777;">No Categories Found</h3>
                                            <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any categories yet. Add one now to get started!</p>
                                            
                                        </div>
                                    @else
                                        <!-- Display Table When Data Exists -->
                                        <table class="ucp-table">
                                            <thead class="ucp-table">
                                                <tr>
                                                    <th class="text-center ucp-table">
                                                        <input type="checkbox" id="select-all"> <!-- Select All Checkbox -->
                                                    </th>
                                                    <th class="text-center ucp-table" scope="col">Item No.</th>
                                                    <th class="text-center ucp-table">category</th>
                                                    <th class="text-center ucp-table">Name</th>
                                                    <th class="text-center ucp-table" scope="col">Description</th>
                                                    <th class="text-center ucp-table" scope="col">Status</th>
                                                    <th class="text-center ucp-table" scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ucp-table">
                                                @foreach($subcategories as $subcategory)
                                                    <tr>
                                                        <!-- Checkbox in the first column -->
                                                        <td class="text-center">
                                                            <input type="checkbox" class="category-checkbox" value="{{ $subcategory->id }}">
                                                        </td>
                                                        <td class="text-center"><p class="ucp-table">{{ str_pad($subcategory->id, 3, '0', STR_PAD_LEFT) }}</p></td>
                                                        <td class="text-center"><p class="ucp-table">{{ $subcategory->category->name }}</p></td>
                                                        <td class="text-center"><p class="ucp-table">{{ $subcategory->name }}</p></td>
                                                        <td class="text-center"><p class="ucp-table">{{ $subcategory->description }}</p></td>
                                                        <td class="text-center">
                                                            <div class="toggle-button mt-2 text-center">
                                                                <input type="checkbox" class="toggle-input" id="toggle{{$subcategory->id}}" data-user-id="{{$subcategory->id}}" {{ $subcategory->is_active ? 'checked' : '' }}>
                                                                <label for="toggle{{$subcategory->id}}" class="toggle-label">
                                                                    <span class="toggle-circle"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="#" title="Edit" class="gray-s" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $subcategory->id }}">
                                                                <i class="uil uil-edit-alt ucp-table"></i>
                                                            </a>
                                                            <form action="{{ route('sub_category.destroy', $subcategory->id) }}" method="POST" class="delete-form d-inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="#" title="Delete" class="gray-s delete-btn" data-username="{{ $subcategory->name }}">
                                                                    <i class="uil uil-trash-alt ucp-table"></i>
                                                                </a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <!-- Edit Subcategory Modal -->
                                                    <div class="modal fade" id="editSubcategoryModal{{ $subcategory->id }}" tabindex="-1"
                                                        aria-labelledby="editSubcategoryModalLabel{{ $subcategory->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="{{ route('sub_category.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editSubcategoryModalLabel{{ $subcategory->id }}">
                                                                            Edit Subcategory
                                                                        </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="subcategory_name_{{ $subcategory->id }}" class="form-label">Subcategory Name</label>
                                                                            <input type="text" class="form-control _dlor1" id="subcategory_name_{{ $subcategory->id }}"
                                                                                name="subcategory_name" value="{{ $subcategory->name }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="subcategory_description_{{ $subcategory->id }}" class="form-label">Subcategory Description</label>
                                                                            <textarea class="form-control _dlor1" id="subcategory_description_{{ $subcategory->id }}"
                                                                                name="subcategory_description" rows="4">{{ $subcategory->description }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="upload_btn" data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="upload_btn">Save Changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Edit Subcategory Modal -->
                                                @endforeach
                                            </tbody>
                                        </table>                                        
                                    @endif
                                </div>
                            </div>
                            @if(!$subcategories->isEmpty())
                                <div class="card-footer mt-4">
                                    <div class="mt-3">
                                        <button id="bulk-delete-btn" class="btn btn-danger" disabled>Delete Selected</button>
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
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label for="subcategory_name" class="form-label">Subcategory Name</label>
                            <input type="text" class="form-control _dlor1" id="subcategory_name" name="subcategory_name" value="{{ old('subcategory_name') }}" placeholder="Enter the subcategory name" >
                            @error('subcategory_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label for="subcategory_description" class="form-label">Subcategory Description</label>
                            <textarea class="form-control _dlor1" id="subcategory_description" name="subcategory_description" rows="4" placeholder="Enter the subcategory description" >{{ old('subcategory_description') }}</textarea>
                            @error('subcategory_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button class="upload_btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="upload_btn">Add Subcategory</button>
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
                } else {
                    // Show error toast
                    toastr.error(response.error, 'Error');
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
        const deleteButtons = document.querySelectorAll(".delete-btn");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function () {
                const form = this.closest(".delete-form");
                const categoryName = this.getAttribute("data-username");

                Swal.fire({
                    title: `Are you sure?`,
                    text: `You are about to delete the Sub-category "${categoryName}". This action cannot be undone.`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form if the user confirms
                    }
                });
            });
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('.toggle-input').change(function () {
            const categoryId = $(this).data('user-id');
            const isActive = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: '/subcategory/update-subcategory-status', // Replace with your route
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    category_id: categoryId,
                    is_active: isActive
                },
                success: function (response) {
                    if (response.success) {
                        toastr.options = {
                            "closeButton": true, // Remove close button
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": true, // Enable time bar
                            "positionClass": "toast-bottom-right",
                            "preventDuplicates": true,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000", // Duration before auto-hiding
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        toastr.success(response.success, 'Success');
                    } else {
                        toastr.error('Failed to update category status. Please try again.', 'Error', {
                            timeOut: 4000,
                            positionClass: 'toast-bottom-right',
                        });
                    }
                },error: function () {
                    toastr.error('An unexpected error occurred. Please try again.', 'Error', {
                        timeOut: 4000,
                        positionClass: 'toast-bottom-right',
                    });
                }
            });
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
                text: `You are about to delete ${selectedIds.length} Sub-categories. This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete them!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/sub_categories/bulk-delete', // Replace with your route
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