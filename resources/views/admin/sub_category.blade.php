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
                            <h3 class="mt-3 scale-in-text" style="color: #777;">No Categories Found</h3>
                            <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any categories yet. Add one now to get started!</p>
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
                                    </div>
                                </div>
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
                <form id="subcategoryForm" method="POST">
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
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <small id="category_id_error" class="text-danger"></small>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory_name" class="form-label">Subcategory Name</label>
                            <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" placeholder="Enter the subcategory name">
                            <small id="subcategory_name_error" class="text-danger"></small>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory_description" class="form-label">Subcategory Description</label>
                            <textarea class="form-control" id="subcategory_description" name="subcategory_description" rows="4" placeholder="Enter the subcategory description"></textarea>
                            <small id="subcategory_description_error" class="text-danger"></small>
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
        $('#subcategoryForm').submit(function(e) {
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
                url: '{{ route('sub_category.store') }}', // The route to store the subcategory
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
                            location.reload();
                        }, 2000);

                        $('#addSubcategoryModal').modal('hide'); // Hide the modal after success
                    }
                },
                error: function(xhr) {
                    toastr.clear(progressToast); // Clear the progress toast

                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        $('#subcategory_name_error').text('');
                        $('#subcategory_description_error').text('');

                        if (errors.subcategory_name) {
                            $('#subcategory_name_error').text(errors.subcategory_name[0]);
                        }
                        if (errors.subcategory_description) {
                            $('#subcategory_description_error').text(errors.subcategory_description[0]);
                        }

                        toastr.error('Please fix the errors and try again.', 'Error', {
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
</script>
<style>/* Card Hover Animation */
    
    </style>