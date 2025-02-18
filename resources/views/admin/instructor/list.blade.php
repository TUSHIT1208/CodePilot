@extends('admin.layouts.master')

@section('title')
    Instructor
@endsection

@section('content')
    <!-- Body Start -->
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class="uil uil-folder-plus"></i> Instructors</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card_dash1">
                        <div class="row mt-2">
                            <div class="col-sm-12 text-end">
                                @if (!$instructors->isEmpty())
                                    <button id="bulk-delete-btn" class="main-btn" disabled>Delete Selected</button>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                            <div class="table-responsive mt-30">
                                @if ($instructors->isEmpty())
                                    <!-- No Records Found -->
                                    <div class="no-categories-container text-center fade-in-animation footer">
                                        <i class="uil uil-folder-minus bounce-effect"
                                            style="font-size: 50px; color: #d1d1d1;"></i>
                                        <h3 class="mt-3 scale-in-text" style="color: #777;">No Instructor Found</h3>
                                        <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                                            Instructor yet.!</p>
                                    </div>
                                @else
                                    <!-- Display Table When Data Exists -->
                                    <table class="ucp-table" id="instructor-table">
                                        <thead>
                                            <tr>
                                                <th class="text-left">
                                                    <input type="checkbox" id="select-all">
                                                </th>
                                                <th class="text-left">Profile</th>
                                                <th class="text-left">Full name</th>
                                                <th class="text-left">Email</th>
                                                <th class="text-left">Phone</th>
                                                <th class="text-left">Status</th>
                                                <th class="text-left">Action</th>
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

        @include('admin.layouts.footer')
    </div>
    <!-- Body End -->

    <!-- Single Edit Instructor Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Instructor Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="instructorEditForm" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="editUserId" name="id">

                        <div class="mb-3">
                            <label for="editUsername" class="form-label">Username</label>
                            <input type="text" class="form-control _dlor1" id="editUsername" name="username">

                        </div>

                        <div class="mb-3">
                            <label for="editFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control _dlor1" id="editFirstName" name="first_name">
                        </div>

                        <div class="mb-3">
                            <label for="editMiddleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control _dlor1" id="editMiddleName" name="middle_name">
                        </div>

                        <div class="mb-3">
                            <label for="editLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control _dlor1" id="editLastName" name="last_name">
                        </div>

                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control _dlor1" id="editEmail" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="editPhone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control _dlor1" id="editPhone" name="phone_number">
                        </div>

                        <div class="mb-3">
                            <label for="editDob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control _dlor1" id="editDob" name="date_of_birth">
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

    {{-- Prevent default form validation submission --}}
    <script>
        $(document).ready(function () {
            $('form.needs-validation').on('submit', function (e) {
                e.preventDefault();

                var form = $(this);
                var formData = new FormData(form[0]);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // Display success message if update is successful
                        $('#editdetailsModal' + response.id).modal('hide'); // Close the modal
                        location.reload(); // Optionally reload the page to reflect changes
                    },
                    error: function (xhr) {
                        // Clear previous error messages
                        form.find('.invalid-feedback').remove();
                        form.find('.is-invalid').removeClass('is-invalid');

                        // Handle validation errors
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function (field, message) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field).after('<div class="invalid-feedback">' +
                                message + '</div>');
                        });
                    }
                });
            });
        });
    </script>

    <!-- DataTables & Bulk Delete Script -->
    <script>
        $(document).ready(function () {
            let table = $('#instructor-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('instructorList') }}", // Adjust this route
                columns: [{
                    data: 'id',
                    render: function (data) {
                        return '<input type="checkbox" class="instructor-checkbox" value="' +
                            data + '">';
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'profile',
                    name: 'profile',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'full_name',
                    name: 'full_name'
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

            // Handle "Select All" checkbox
            $('#instructor-table tbody').on('change', '.instructor-checkbox', function () {
                let allChecked = $('.instructor-checkbox').length === $('.instructor-checkbox:checked')
                    .length;
                $('#select-all').prop('checked', allChecked);
                toggleBulkDeleteButton();
            });

            $('#select-all').on('change', function () {
                $('.instructor-checkbox').prop('checked', $(this).prop('checked'));
                toggleBulkDeleteButton();
            });

            function toggleBulkDeleteButton() {
                let anyChecked = $('.instructor-checkbox:checked').length > 0;
                $('#bulk-delete-btn').prop('disabled', !anyChecked);
            }

            // Bulk Delete Functionality
            $('#bulk-delete-btn').on('click', function () {
                let selectedIds = $('.instructor-checkbox:checked').map(function () {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to delete ${selectedIds.length} instructors. This action cannot be undone.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete them!',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('user.bulk-delete') }}', // Adjust this route
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
                                        setTimeout(function () {
                                            location
                                                .reload(); // Reload the page
                                        }, 2000);
                                    } else {
                                        toastr.error(response.error ||
                                            'Failed to delete.', 'Error');
                                    }
                                },
                                error: function () {
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

    <!-- Toggle User Status Script -->
    <script>
        $(document).ready(function () {
            $('.ucp-table').on('change', '.toggle-input', function () {
                var userId = $(this).data('user-id');
                var isActive = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    url: '/admin/update-user-status',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId,
                        is_active: isActive
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success('Status updated successfully.');
                        } else {
                            toastr.error('Error updating status.');
                        }
                    },
                    error: function () {
                        toastr.error('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>

    {{-- Open Edit Modal and Populate Data --}}
    <script>
        $(document).ready(function () {
            $(document).on('click', '.edit-instructor', function () {
                let id = $(this).data('id');
                let username = $(this).data('username');
                let firstname = $(this).data('firstname');
                let middlename = $(this).data('middlename');
                let lastname = $(this).data('lastname');
                let email = $(this).data('email');
                let phone = $(this).data('phone');
                let dob = $(this).data('dob');

                // Populate modal fields
                $('#editUserId').val(id);
                $('#editUsername').val(username);
                $('#editFirstName').val(firstname);
                $('#editMiddleName').val(middlename);
                $('#editLastName').val(lastname);
                $('#editEmail').val(email);
                $('#editPhone').val(phone);
                $('#editDob').val(dob);

                // Set form action dynamically
                $('#instructorEditForm').attr('action', '/user/' + id);

                // Show the modal
                $('#editUserModal').modal('show');
            });
        });
    </script>
    <script>
        function validateUserForm(formId) {
            let form = document.getElementById(formId);
            let isValid = true;

            // Clear previous errors
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

            const fields = [
                { name: "username", regex: /^[a-zA-Z0-9_]{3,20}$/, message: "Username must be 3-20 characters (letters, numbers, underscores)." },
                { name: "first_name", regex: /^[A-Za-z]{2,}$/, message: "First name must contain only letters and be at least 2 characters." },
                { name: "last_name", regex: /^[A-Za-z]{2,}$/, message: "Last name must contain only letters and be at least 2 characters." },
                { name: "middle_name", regex: /^[A-Za-z]*$/, message: "Middle name must contain only letters.", optional: true },
                { name: "email", regex: /^\S+@\S+\.\S+$/, message: "Please enter a valid email address." },
                { name: "phone_number", regex: /^\d{10}$/, message: "Phone number must be exactly 10 digits." },
                { name: "date_of_birth", isDate: true, message: "Date of birth must be in the past.", optional: true }
            ];

            fields.forEach(field => {
                let input = form.querySelector(`[name="${field.name}"]`);
                if (!input) return;

                let value = input.value.trim();
                let isValidField = true;

                if (!field.optional || value !== "") {
                    if (field.isDate) {
                        if (new Date(value) >= new Date()) {
                            isValidField = false;
                        }
                    } else if (!field.regex.test(value)) {
                        isValidField = false;
                    }
                }

                if (!isValidField) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    let errorMessage = `<div class="invalid-feedback">${field.message}</div>`;
                    input.insertAdjacentHTML('afterend', errorMessage);
                }
            });

            return isValid;
        }

        // Apply validation on form submission
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('instructorEditForm').addEventListener('submit', function (event) {
                if (!validateUserForm('instructorEditForm')) {
                    event.preventDefault();
                }
            });
        });
    </script>

@endsection