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
                                    </div>
                                </div>
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

            // Display progress bar toast notification
            var progressToast = toastr.info('', 'Processing...', {
                timeOut: 0, // Stay until it's closed
                positionClass: 'toast-bottom-right',
                extendedTimeOut: 0,
                closeButton: true,
                progressBar: true,
                iconClass: 'toast-info'
            });

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
                        toastr.success(response.success, 'Success', {
                            timeOut: 4000,
                            positionClass: 'toast-bottom-right',
                        });

                        // Reload the page after success toast
                        setTimeout(function() {
                            location.reload(); // Reload the page after 0 seconds
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

                        // Display error toast
                        toastr.error('Please fix the errors and try again.', 'Error', {
                            timeOut: 5000,
                            positionClass: 'toast-bottom-right',
                        });
                    } else {
                        // For other errors
                        toastr.error('An unexpected error occurred. Please try again.', 'Error', {
                            timeOut: 5000,
                            positionClass: 'toast-bottom-right',
                        });
                    }
                }
            });
        });
    });
</script>
