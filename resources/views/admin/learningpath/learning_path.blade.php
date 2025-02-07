@extends('admin.setting.master')
@section('title')
learning-path
@endsection
@section('content')
<!-- Body Start -->
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card_dash1">
                    <div class="row mt-2">
                        <div class="col-lg-2">
                            <h4 class=""><i class="uil uil-plus"></i> Add Learning path</h4>
                        </div>
                        <div class="col-lg-7">
                            {{-- <div class="search120">
                                <div class="ui search">
                                    <div class="ui left icon input swdh10">
                                        <input class="prompt srch10" type="text"
                                            placeholder="Search for learning path..">
                                        <i class='uil uil-search-alt icon icon1'></i>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 text-end">
                            <button data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="main-btn"
                                title="Add a Category">
                                <i class="uil uil-plus-circle"></i> Add a Learning path
                            </button>
                        </div>
                    </div>

                    <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                        <div class="table-responsive mt-30">
                            @if($learningpath->isEmpty())
                                <!-- No Records Found -->
                                <div class="no-categories-container text-center fade-in-animation footer">
                                    <i class="uil uil-folder-minus bounce-effect"
                                        style="font-size: 50px; color: #d1d1d1;"></i>
                                    <h3 class="mt-3 scale-in-text" style="color: #777;">No Learning path Found</h3>
                                    <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                                        learning path yet. Add one now to get started!</p>
                                </div>
                            @else
                                <table id="learningPathTable" class="table ucp-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><input type="checkbox" id="select-all"></th>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Learning Path Name</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center"></tbody>
                                </table>

                            @endif
                        </div>
                    </div>
                    @if(!$learningpath->isEmpty())
                        <div class="card-footer mt-4">
                            <div class="mt-3">
                                <button id="bulk-delete-btn" class="main-btn" disabled>Delete Selected</button>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                {{ $learningpath->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Learning Path</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit-id">

                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Learning Path Name</label>
                            <input type="text" class="form-control" id="edit-name" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit-description" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for Adding Category -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('learningpath.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">
                            <i class="uil uil-plus-circle"></i> Add a New learning path
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Category Name Field -->
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Path Name</label>
                            <input type="text" class="form-control _dlor1" id="name" name="name"
                                placeholder="Enter the path name">
                            <div class="invalid-feedback" id="category_name_error"></div>
                        </div>

                        <!-- Category Description Field -->
                        <div class="mb-3">
                            <label for="category_description" class="form-label">learning path Descriptio</label>
                            <textarea class="form-control _dlor1" id="description" name="description" rows="4"
                                placeholder="Enter the category description n ( OPTIONAL )"></textarea>
                            <div class="invalid-feedback" id="category_description_error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="main-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="main-btn">Add learning path</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('admin.layouts.footer')
</div>
<!-- Body End -->

{{-- datatable --}}
<script>
    $(document).ready(function () {
        if ($.fn.DataTable.isDataTable("#learningPathTable")) {
            $('#learningPathTable').DataTable().destroy();
        }

        let table = $('#learningPathTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('learningpath.index') }}", // Route for AJAX request
            columns: [
                { data: 'checkbox', orderable: false, searchable: false },
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'actions', orderable: false, searchable: false }
            ],
            columnDefs: [{
                targets: 0,
                className: 'text-center',
                render: function (data) {
                    return `<input type="checkbox" class="learningpath-checkbox" value="${data}">`;
                }
            }]
        });
    });
</script>

{{-- add lerningpath --}}
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

<script>

    // Handle Delete Button Click
    $(document).on('click', '.delete-btn', function () {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/learningpath/" + id,
                    type: "POST",
                    data: { _method: "DELETE", _token: "{{ csrf_token() }}" },
                    success: function (response) {
                        table.ajax.reload();
                        Swal.fire('Deleted!', response.success, 'success');
                    },
                    error: function () {
                        Swal.fire('Error!', 'Failed to delete learning path.', 'error');
                    }
                });
            }
        });
    });

    // Select All Checkbox
    $('#select-all').change(function () {
        $('.learningpath-checkbox').prop('checked', this.checked);
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


{{-- edit --}}
<script>
    $(document).ready(function () {
        let table = $('#learningPathTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('learningpath.index') }}",
            columns: [
                { data: 'checkbox', orderable: false, searchable: false },
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'actions', orderable: false, searchable: false }
            ]
        });

        // Open Edit Modal and Fill Data
        $(document).on('click', '.edit-btn', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let description = $(this).data('description');

            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#edit-description').val(description);

            $('#editModal').modal('show'); // Open modal
        });

        // Handle Update Form Submission (AJAX)
        $('#editForm').submit(function (e) {
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
                success: function (response) {
                    $('#editModal').modal('hide'); // Close modal
                    table.ajax.reload(); // Reload DataTable
                    Swal.fire('Updated!', response.success, 'success');
                },
                error: function () {
                    Swal.fire('Error!', 'Failed to update learning path.', 'error');
                }
            });
        });
    });
</script>

@endsection