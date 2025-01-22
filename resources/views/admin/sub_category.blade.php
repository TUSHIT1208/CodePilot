@include('admin.layouts.master')
<!-- Body Start -->
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="st_title"><i class="uil uil-folder-open"></i> Subcategories</h2>
                </div>
            </div>

            <!-- Display Success or Error Messages -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <!-- Add Subcategory Button -->
            <div class="row mt-4">
                <div class="col-lg-12 text-end">
                    <a data-bs-toggle="modal" data-bs-target="#addSubcategoryModal" class="upload_btn" title="Add a Subcategory">
                        <i class="uil uil-plus-circle"></i> Add a Subcategory
                    </a>
                </div>
            </div>

            <!-- Subcategory List -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    @if($subcategories->isEmpty())
                        <!-- No Records Found -->
                        <div class="no-categories-container text-center fade-in-animation footer">
                            <i class="uil uil-folder-minus bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                            <h3 class="mt-3 scale-in-text" style="color: #777;">No Subcategories Found</h3>
                            <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any subcategories yet. Add one now to get started!</p>
                        </div>
                    @else
                        <!-- Subcategory Cards -->
                        <div class="row">
                            @foreach($subcategories as $subcategory)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-danger text-white">
                                            <i class="uil uil-tag"></i> {{ $subcategory->name }}
                                        </div>
                                        <div class="card-body">
                                            <p>{{ $subcategory->description }}</p>
                                            <small>Category: {{ $subcategory->category->name }}</small>
                                        </div>
                                        <!-- Toggle Button -->
                                        <div class="toggle-button mt-2 text-center">
                                            <input type="checkbox" class="toggle-input" id="toggle{{$subcategory->id}}"
                                                data-user-id="{{$subcategory->id}}" {{ $subcategory->is_active ? 'checked' : '' }} />
                                            <label for="toggle{{$subcategory->id}}" class="toggle-label">
                                                <span class="toggle-circle"></span>
                                            </label>
                                        </div>

                                        <ul class="tutor_social_links mt-4 text-center mb-2">
                                            <!-- Edit Button -->
                                            <li>
                                                <button type="button" class="btn edit-btn" data-bs-toggle="modal"
                                                    data-bs-target="#editSubcategoryModal{{ $subcategory->id }}">
                                                    <i class="uil uil-edit"></i>
                                                </button>
                                            </li>
                                            <!-- Delete Button -->
                                            <li>
                                                <form action="{{ route('sub_category.destroy', $subcategory->id) }}" method="POST"
                                                    class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn delete-btn"
                                                        data-username="{{ $subcategory->name }}">
                                                        <i class="uil uil-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
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
                                                    {{-- <div class="mb-3">
                                                        <label for="category_id_{{ $subcategory->id }}" class="form-label">Category</label>
                                                        <select class="form-control" id="category_id_{{ $subcategory->id }}" name="category_id" required>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div> --}}
                                                    <div class="mb-3">
                                                        <label for="subcategory_name_{{ $subcategory->id }}" class="form-label">Subcategory Name</label>
                                                        <input type="text" class="form-control" id="subcategory_name_{{ $subcategory->id }}"
                                                            name="subcategory_name" value="{{ $subcategory->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="subcategory_description_{{ $subcategory->id }}" class="form-label">Subcategory Description</label>
                                                        <textarea class="form-control" id="subcategory_description_{{ $subcategory->id }}"
                                                            name="subcategory_description" rows="4" required>{{ $subcategory->description }}</textarea>
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
                                <!-- End of Edit Subcategory Modal -->
                            @endforeach
                        </div>                        
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Subcategory -->
    <div class="modal fade" id="addSubcategoryModal" tabindex="-1" aria-labelledby="addSubcategoryModalLabel" aria-hidden="true">
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
                            <select class="form-control" id="category_id" name="category_id">
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
                            <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" value="{{ old('subcategory_name') }}" placeholder="Enter the subcategory name" >
                            @error('subcategory_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label for="subcategory_description" class="form-label">Subcategory Description</label>
                            <textarea class="form-control" id="subcategory_description" name="subcategory_description" rows="4" placeholder="Enter the subcategory description" >{{ old('subcategory_description') }}</textarea>
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

<!-- Toastr Script for Success/Error Messages -->
<script>
    $(document).ready(function() {
        // AJAX form submission
        $(document).ready(function () {
    // AJAX form submission for adding subcategory
    $('#subcategoryForm').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this); // Get form data

        $.ajax({
            url: '{{ route('sub_category.store') }}', // The route to store the subcategory
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
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
                        timeOut: 3000, // Display duration of the toast (3 seconds)
                        extendedTimeOut: 1000,
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut"
                    };

                    // Show success toast
                    toastr.success(response.success, 'Success');

                    // Close the modal and reload the page after a short delay
                    setTimeout(function () {
                        $('#addSubcategoryModal').modal('hide'); // Close modal
                        location.reload(); // Reload the page
                    }, 2000);
                }
            },
            error: function (xhr) {
                console.log(xhr.responseJSON); // Check the response structure
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;

                    toastr.error('Please fix the errors and try again.', 'Validation Error', {
                        timeOut: 5000,
                        positionClass: 'toast-bottom-right',
                    });
                } else {
                    toastr.error('An unexpected error occurred. Please try again.', 'Error', {
                        timeOut: 5000,
                        positionClass: 'toast-bottom-right',
                    });
                }
            }

        });
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
                    text: `You are about to delete the Subcategory "${categoryName}". This action cannot be undone.`,
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
                },
                error: function () {
                    toastr.error('An unexpected error occurred. Please try again.', 'Error', {
                        timeOut: 4000,
                        positionClass: 'toast-bottom-right',
                    });
                }
            });
        });
    });
</script>

