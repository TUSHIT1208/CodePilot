@extends('admin.setting.master')

@section('title') Instructor @endsection

@section('content')
<!-- Body Start -->
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="st_title"><i class="uil uil-folder-plus"></i> Instructor's</h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card_dash1">
                    <div class="row mt-2">
                        <div class="col-sm-12 text-end">
                            @if(!$instructors->isEmpty())
                                <button id="bulk-delete-btn" class="main-btn" disabled>Delete Selected</button>
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                        <div class="table-responsive mt-30">
                            @if($instructors->isEmpty())
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
                                <table class="ucp-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <input type="checkbox" id="select-all">
                                            </th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Profile</th>
                                            <th class="text-center">First Name</th>
                                            <th class="text-center">Middle Name</th>
                                            <th class="text-center">Last Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Date of Birth</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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
@foreach ($instructors as $user)
    <!-- Edit Instructor Modal -->
    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
        aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit Instructor Details:
                        {{ $user->first_name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.update', $user->id) }}" method="POST" id="instructorForm{{ $user->id }}"
                        class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="username{{ $user->id }}" class="form-label">Username</label>
                            <input type="text" class="form-control _dlor1" id="username{{ $user->id }}" name="username"
                                value="{{ old('username', $user->username) }}" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="first_name{{ $user->id }}" class="form-label">First Name</label>
                            <input type="text" class="form-control _dlor1" id="first_name{{ $user->id }}" name="first_name"
                                value="{{ old('first_name', $user->first_name) }}" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="first_name{{ $user->id }}" class="form-label">Middle Name</label>
                            <input type="text" class="form-control _dlor1" id="first_name{{ $user->id }}" name="middle_name"
                                value="{{ old('middle_name', $user->middle_name) }}" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="last_name{{ $user->id }}" class="form-label">Last Name</label>
                            <input type="text" class="form-control _dlor1" id="last_name{{ $user->id }}" name="last_name"
                                value="{{ old('last_name', $user->last_name) }}" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="email{{ $user->id }}" class="form-label">Email</label>
                            <input type="email" class="form-control _dlor1" id="email{{ $user->id }}" name="email"
                                value="{{ old('email', $user->email) }}" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="phone_number{{ $user->id }}" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control _dlor1" id="phone_number{{ $user->id }}"
                                name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="date_of_birth{{ $user->id }}" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control _dlor1" id="date_of_birth{{ $user->id }}"
                                name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" required>
                            <div class="invalid-feedback"></div>
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
    <!-- End of Edit Instructor Modal -->
@endforeach

<script>
    $(document).ready(function () {
        $('form.needs-validation').on('submit', function (e) {
            e.preventDefault();  // Prevent default form submission

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
                    $('#editdetailsModal' + response.id).modal('hide');  // Close the modal
                    location.reload();  // Optionally reload the page to reflect changes
                },
                error: function (xhr) {
                    // Clear previous error messages
                    form.find('.invalid-feedback').remove();
                    form.find('.is-invalid').removeClass('is-invalid');

                    // Handle validation errors
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, message) {
                        $('#' + field).addClass('is-invalid');
                        $('#' + field).after('<div class="invalid-feedback">' + message + '</div>');
                    });
                }
            });
        });
    });
</script>

<!-- DataTables & Bulk Delete Script -->
<script>
    $(document).ready(function () {
    let table = $('.ucp-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('instructorList') }}",
        columns: [
            {
                data: 'id',
                render: function (data) {
                    return '<input type="checkbox" class="learner-checkbox" value="' + data + '">';
                },
                orderable: false,
                searchable: false
            },
            { data: 'username', name: 'username' },
            { data: 'profile', name: 'profile', orderable: false, searchable: false },
            { data: 'first_name', name: 'first_name' },
            { data: 'middle_name', name: 'middle_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'email', name: 'email' },
            { data: 'phone_number', name: 'phone_number' },
            { data: 'date_of_birth', name: 'date_of_birth' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $("#dt-length-0").addClass('form-control form-control-sm');

    // Select/Deselect All Checkboxes
    $('#select-all').on('change', function () {
        $('.learner-checkbox').prop('checked', $(this).prop('checked'));
        toggleBulkDeleteButton();
    });

    // Handle individual checkbox selection
    $('.ucp-table tbody').on('change', '.learner-checkbox', function () {
        let allChecked = $('.learner-checkbox').length === $('.learner-checkbox:checked').length;
        $('#select-all').prop('checked', allChecked);
        toggleBulkDeleteButton();
    });

    // Enable/Disable Bulk Delete Button
    function toggleBulkDeleteButton() {
        let anyChecked = $('.learner-checkbox:checked').length > 0;
        $('#bulk-delete-btn').prop('disabled', !anyChecked);
    }

    // AJAX Setup for CSRF Token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Bulk Delete Functionality
    $('#bulk-delete-btn').on('click', function () {
        let selectedIds = $('.learner-checkbox:checked').map(function () {
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
                        url: '{{ route("user.bulk-delete") }}',
                        type: 'POST',
                        data: { ids: selectedIds },
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.success, 'Success');
                                $('#select-all').prop('checked', false);
                                $('#bulk-delete-btn').prop('disabled', true);
                                table.ajax.reload(); // Reload DataTable properly
                            } else {
                                toastr.error(response.error || 'Failed to delete.', 'Error');
                            }
                        },
                        error: function (xhr) {
                            toastr.error('An error occurred. Please try again.', 'Error');
                        }
                    });
                }
            });
        }
    });

    // Delete Confirmation for Individual User
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

    // Toggle User Status Script
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

@endsection