@include('admin.layouts.master')
<!-- Body Start -->
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="st_title"><i class="uil uil-folder-plus"></i> Categories</h2>
                </div>
            </div>

            <!-- Display Success or Error Messages -->
            {{-- @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif --}}

            <!-- Add Category Button -->
            <div class="row mt-4">
                <div class="col-lg-12 text-end">
                    <a data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="upload_btn" title="Add a Category">
                        <i class="uil uil-plus-circle"></i> Add a Category
                    </a>
                </div>
            </div>

            <!-- Category List -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="row">
                        @if($categories->isEmpty())
                            <div class="no-categories-container text-center fade-in-animation footer">
                                <i class="uil uil-folder-minus bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                                <h3 class="mt-3 scale-in-text" style="color: #777;">No Categories Found</h3>
                                <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any categories yet. Add one now to get started!</p>
                            </div>
                        @else


                            @foreach($categories as $category)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-danger text-white">
                                            <i class="uil uil-tag"></i> {{ $category->name }}
                                        </div>
                                        <div class="card-body">
                                            <p>{{ $category->description }}</p>
                                        </div>
                                        <!-- Toggle Button -->
                                        <div class="toggle-button mt-2 text-center">
                                            <input type="checkbox" class="toggle-input" id="toggle{{$category->id}}"
                                                data-user-id="{{$category->id}}" {{ $category->is_active ? 'checked' : '' }} />
                                            <label for="toggle{{$category->id}}" class="toggle-label">
                                                <span class="toggle-circle"></span>
                                            </label>
                                        </div>

                                        <ul class="tutor_social_links mt-4 text-center mb-2">
                                            <!-- Edit Button -->
                                            <li>
                                                <button type="button" class="btn edit-btn" data-bs-toggle="modal"
                                                    data-bs-target="#editCategoryModal{{ $category->id }}">
                                                    <i class="uil uil-edit"></i>
                                                </button>
                                            </li>
                                            <!-- Delete Button -->
                                            <li>
                                                <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                                    class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn delete-btn"
                                                        data-username="{{ $category->name }}">
                                                        <i class="uil uil-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Edit User Modal -->
                                <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
                                    aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">
                                                        Edit Category
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="category_name_{{ $category->id }}" class="form-label">Category Name</label>
                                                        <input type="text" class="form-control" id="category_name_{{ $category->id }}"
                                                            name="category_name" value="{{ $category->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="category_description_{{ $category->id }}" class="form-label">Category Description</label>
                                                        <textarea class="form-control" id="category_description_{{ $category->id }}"
                                                            name="category_description" rows="4" required>{{ $category->description }}</textarea>
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
                                <!-- End of Edit User Modal -->
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Modal for Adding Category -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="categoryForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel"><i class="uil uil-plus-circle"></i> Add a New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter the category name">
                            <small id="category_name_error" class="text-danger"></small>
                        </div>
                        <div class="mb-3">
                            <label for="category_description" class="form-label">Category Description</label>
                            <textarea class="form-control" id="category_description" name="category_description" rows="4" placeholder="Enter the category description"></textarea>
                            <small id="category_description_error" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="upload_btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="upload_btn">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('admin.layouts.footer')
</div>
<!-- Body End -->

<!-- Toastr Script for Success/Error Message -->
<script>
    $(document).ready(function() {
        // AJAX form submission
        $('#categoryForm').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this); // Get form data

            // // Display progress bar toast notification
            // var progressToast = toastr.info('', 'Processing...', {
            //     timeOut: 0, // Stay until it's closed
            //     positionClass: 'toast-bottom-right',
            //     extendedTimeOut: 0,
            //     closeButton: true,
            //     progressBar: true,
            //     iconClass: 'toast-info'
            // });

            $.ajax({
                url: '{{ route('category.store') }}', // The route to store the category
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Close the progress toast and show success toast
                        toastr.clear(progressToast); // Clear the progress toast

                        // Set toastr options and show success toast
                        toastr.options = {
                            "closeButton": true, // Show close button
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": true, // Enable progress bar
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

                        toastr.success(response.success, 'Success'); // Display success message

                        // Reload the page after success toast
                        setTimeout(function() {
                            location.reload(); // Reload the page after 2 seconds
                        }, 2000);

                        $('#addCategoryModal').modal('hide'); // Hide the modal after success
                    }
                },
                error: function(xhr) {
                // Handle error response and display error toast
                toastr.clear(progressToast); // Clear the progress toast

                // Handle validation errors
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;

                    // Reset previous error messages
                    $('#category_name_error').text('');
                    $('#category_description_error').text('');

                    if (errors.category_name) {
                        $('#category_name_error').text(errors.category_name[0]);
                    }
                    if (errors.category_description) {
                        $('#category_description_error').text(errors.category_description[0]);
                    }

                    // Set toastr options and show error toast for validation errors
                    toastr.options = {
                        "closeButton": true, // Show close button
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": true, // Enable progress bar
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

                    toastr.error('Please fix the errors and try again.', 'Error');
                } else {
                    // For other errors, display generic error toast
                    toastr.options = {
                        "closeButton": true, // Show close button
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": true, // Enable progress bar
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
                    text: `You are about to delete the category "${categoryName}". This action cannot be undone.`,
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
                url: '/category/update-category-status', // Replace with your route
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

