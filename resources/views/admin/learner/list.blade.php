@extends('admin.layouts.master')
@section('title')
    learner
@endsection
@section('content')
    <!-- Body Start -->
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class="uil uil-folder-plus"></i> Learner's</h2>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="card_dash1">
                            <div class="row mt-2">
                                <div class="col-lg-12 text-end">
                                    @if (!$learners->isEmpty())
                                        <button id="bulk-delete-btn" class="main-btn" disabled>Delete Selected</button>
                                    @endif
                                </div>
                            </div>

                            <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                                <div class="table-responsive mt-30">
                                    @if ($learners->isEmpty())
                                        <!-- No Records Found -->
                                        <div class="no-categories-container text-center fade-in-animation footer">
                                            <i class="uil uil-folder-minus bounce-effect"
                                                style="font-size: 50px; color: #d1d1d1;"></i>
                                            <h3 class="mt-3 scale-in-text" style="color: #777;">No Learner Found</h3>
                                            <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have
                                                any
                                                categories yet. Add one now to get started!</p>

                                        </div>
                                    @else
                                        <!-- Display Table When Data Exists -->
                                        <table class="ucp-table" id="myTable">
                                            <thead class="ucp-table">
                                                <tr>
                                                    <th class="text-center ucp-tabler">
                                                        <input type="checkbox" id="select-all">
                                                    </th>
                                                    <th class="text-center ucp-table">Username</th>
                                                    <th class="text-center ucp-table">profile</th>
                                                    <th class="text-center ucp-table" scope="col">first_name</th>
                                                    <th class="text-center ucp-table" scope="col">middle_name</th>
                                                    <th class="text-center ucp-table" scope="col">last_name</th>
                                                    <th class="text-center ucp-table" scope="col">email</th>
                                                    <th class="text-center ucp-table" scope="col">phone</th>
                                                    <th class="text-center ucp-table" scope="col">date of birth</th>
                                                    <th class="text-center ucp-table" scope="col">status</th>
                                                    <th class="text-center ucp-table" scope="col">action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.layouts.footer')
    </div>
    <!-- Body End -->

    <!-- Edit Learner Modal -->
    <div class="modal fade" id="editLearnerModal" tabindex="-1" aria-labelledby="editLearnerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLearnerModalLabel">Edit Learner Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="learnerEditForm" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="editLearnerId" name="id">

                        <div class="mb-3">
                            <label for="editLearnerUsername" class="form-label">Username</label>
                            <input type="text" class="form-control _dlor1" id="editLearnerUsername" name="username"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="editLearnerFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control _dlor1" id="editLearnerFirstName" name="first_name"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="editLearnerMiddleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control _dlor1" id="editLearnerMiddleName" name="middle_name">
                        </div>

                        <div class="mb-3">
                            <label for="editLearnerLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control _dlor1" id="editLearnerLastName" name="last_name"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="editLearnerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control _dlor1" id="editLearnerEmail" name="email"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="editLearnerPhone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control _dlor1" id="editLearnerPhone" name="phone_number"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="editLearnerDob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control _dlor1" id="editLearnerDob" name="date_of_birth"
                                required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="main-btn" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="main-btn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Prevent default form submission with validation --}}
    <script>
        $(document).ready(function() {
            $('form.needs-validation').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var formData = new FormData(form[0]);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Display success message if update is successful
                        $('#editdetailsModal' + response.id).modal('hide'); // Close the modal
                        setTimeout(function() {
                            $('#addCategoryModal').modal('hide'); // Close modal
                            location.reload(); // Reload the page
                        }, 2000);
                    },
                    error: function(xhr) {
                        // Clear previous error messages
                        form.find('.invalid-feedback').remove();
                        form.find('.is-invalid').removeClass('is-invalid');

                        // Handle validation errors
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, message) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field).after('<div class="invalid-feedback">' +
                                message + '</div>');
                        });
                    }
                });
            });
        });
    </script>

    {{-- Datatable and bilk delete --}}
    <script>
        $(document).ready(function() {
            let table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.index') }}",
                columns: [{
                        data: 'id',
                        render: function(data) {
                            return '<input type="checkbox" class="learner-checkbox" value="' +
                                data + '">';
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'profile',
                        name: 'profile',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'middle_name',
                        name: 'middle_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'date_of_birth',
                        name: 'date_of_birth'
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

            // Event delegation for dynamically loaded checkboxes
            $('#myTable tbody').on('change', '.learner-checkbox', function() {
                let allChecked = $('.learner-checkbox').length === $('.learner-checkbox:checked').length;
                $('#select-all').prop('checked', allChecked);
                toggleBulkDeleteButton();
            });

            // Select All Functionality
            $('#select-all').on('change', function() {
                $('.learner-checkbox').prop('checked', $(this).prop('checked'));
                toggleBulkDeleteButton();
            });

            // Enable/Disable the Bulk Delete Button
            function toggleBulkDeleteButton() {
                let anyChecked = $('.learner-checkbox:checked').length > 0;
                $('#bulk-delete-btn').prop('disabled', !anyChecked);
            }

            // Bulk Delete Functionality
            $('#bulk-delete-btn').on('click', function() {
                let selectedIds = $('.learner-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to delete ${selectedIds.length} users. This action cannot be undone.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete them!',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('user.bulk-delete') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    ids: selectedIds,
                                },
                                success: function(response) {
                                    if (response.success) {
                                        toastr.success(response.success, 'Success');
                                        $('#select-all').prop('checked', false);
                                        $('#bulk-delete-btn').prop('disabled', true);
                                        location
                                            .reload(); // Reload the entire page after delete
                                    } else {
                                        toastr.error(response.error ||
                                            'Failed to delete.', 'Error');
                                    }
                                },
                                error: function() {
                                    toastr.error('An error occurred. Please try again.',
                                        'Error');
                                }
                            });
                        }
                    });
                }
            });
        });
    </script>

    <!-- JavaScript for Delete Confirmation -->
    <script>
        $(document).ready(function() {
            $(document).on("click", ".delete-btn", function(e) {
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

    {{-- Handle toggle change event --}}
    <script>
        $(document).ready(function() {
            // Use event delegation for dynamically loaded elements
            $(document).on('change', '.toggle-input', function() {
                var toggleButton = $(this); // Store reference to toggle
                var userId = toggleButton.data('user-id');
                var isActive = toggleButton.prop('checked') ? 1 : 0;

                // Send AJAX request to update status
                $.ajax({
                    url: '/admin/update-user-status', // Adjust route as needed
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for security
                        user_id: userId,
                        is_active: isActive
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Status updated successfully.');
                        } else {
                            toastr.error('Error updating status.');
                            toggleButton.prop('checked', !isActive); // Revert toggle

                        }
                    },
                    error: function() {
                        alert('Error updating status');
                        toggleButton.prop('checked', !isActive); // Revert toggle on error
                    }
                });
            });
        });
    </script>

    {{-- Open Edit Modal and Populate Data --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-learner', function() {
                let id = $(this).data('id');
                let username = $(this).data('username');
                let firstname = $(this).data('firstname');
                let middlename = $(this).data('middlename');
                let lastname = $(this).data('lastname');
                let email = $(this).data('email');
                let phone = $(this).data('phone');
                let dob = $(this).data('dob');

                // Populate modal fields
                $('#editLearnerId').val(id);
                $('#editLearnerUsername').val(username);
                $('#editLearnerFirstName').val(firstname);
                $('#editLearnerMiddleName').val(middlename);
                $('#editLearnerLastName').val(lastname);
                $('#editLearnerEmail').val(email);
                $('#editLearnerPhone').val(phone);
                $('#editLearnerDob').val(dob);

                // Set form action dynamically
                $('#learnerEditForm').attr('action', `/user/${id}`);

                // Show the modal
                $('#editLearnerModal').modal('show');
            });
        });
    </script>
@endsection
