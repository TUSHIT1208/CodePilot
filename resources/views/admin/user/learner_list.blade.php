@extends('admin.layouts.master')
@section('title')
learner
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
                            <h4 class=""><i class="uil uil-plus"></i> Learner List</h4>
                        </div>
                        <div class="col-lg-7">
                            {{-- <div class="search120">
                                <div class="ui search">
                                    <div class="ui left icon input swdh10">
                                        <input class="prompt srch10" type="text" placeholder="Search for Learners...">
                                        <i class='uil uil-search-alt icon icon1'></i>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                        <div class="table-responsive mt-30">
                            @if($learners->isEmpty())
                                <!-- No Records Found -->
                                <div class="no-categories-container text-center fade-in-animation footer">
                                    <i class="uil uil-folder-minus bounce-effect"
                                        style="font-size: 50px; color: #d1d1d1;"></i>
                                    <h3 class="mt-3 scale-in-text" style="color: #777;">No Learner Found</h3>
                                    <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
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
                    @if(!$learners->isEmpty())
                        <div class="card-footer mt-4">
                            <div class="mt-3">
                                <button id="bulk-delete-btn" class="btn" disabled>Delete Selected</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.footer')
</div>
<!-- Body End -->
@foreach($learners as $learner)
    <!-- Modal for each learner -->
    <div class="modal fade" id="editdetailsModal{{ $learner->id }}" tabindex="-1" aria-labelledby="editdetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editdetailsModalLabel">Edit Learner Details: {{ $learner->first_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.update', $learner->id) }}" method="POST" id="learnerForm{{ $learner->id }}"
                        class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control _dlor1" name="username" id="username"
                                value="{{ old('username', $learner->username) }}" required>
                            <div class="invalid-feedback"></div> <!-- Error message container -->
                        </div>

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control _dlor1" name="first_name" id="first_name"
                                value="{{ old('first_name', $learner->first_name) }}" required>
                            <div class="invalid-feedback"></div> <!-- Error message container -->
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control _dlor1" name="last_name" id="last_name"
                                value="{{ old('last_name', $learner->last_name) }}" required>
                            <div class="invalid-feedback"></div> <!-- Error message container -->
                        </div>

                        <div class="mb-3">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control _dlor1" name="middle_name" id="middle_name"
                                value="{{ old('middle_name', $learner->middle_name) }}" required>
                            <div class="invalid-feedback"></div> <!-- Error message container -->
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control _dlor1" name="email" id="email"
                                value="{{ old('email', $learner->email) }}" required>
                            <div class="invalid-feedback"></div> <!-- Error message container -->
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control _dlor1" name="phone_number" id="phone_number"
                                value="{{ old('phone_number', $learner->phone_number) }}" required>
                            <div class="invalid-feedback"></div> <!-- Error message container -->
                        </div>

                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control _dlor1" name="date_of_birth" id="dob"
                                value="{{ old('date_of_birth', $learner->date_of_birth) }}" required>
                            <div class="invalid-feedback"></div> <!-- Error message container -->
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="main-btn" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="main-btn">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                    alert(response.success);
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


<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.index') }}",
            columns: [
                {
                    data: 'id', render: function (data) {
                        return '<input type="checkbox" class="learner-checkbox" value="' + data + '">';
                    }, orderable: false, searchable: false
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
    });
</script>

<!-- JavaScript for Delete Confirmation -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll(".delete-btn");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function () {
                const form = this.closest(".delete-form");
                const username = this.getAttribute("data-username");

                Swal.fire({
                    title: `Are you sure?`,
                    text: `You are about to delete ${username}. This action cannot be undone.`,
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

{{-- Handle toggle change event --}}
<script>
    $(document).ready(function () {
        $('.toggle-input').change(function () {
            var userId = $(this).data('user-id');
            var isActive = $(this).prop('checked') ? 1 : 0;

            // Send the updated status to the server using AJAX
            $.ajax({
                url: '/admin/update-user-status',  // Your route to handle the update
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',  // CSRF token for security
                    user_id: userId,
                    is_active: isActive
                },
                success: function (response) {
                    if (response.success) {
                        // You can display a success message or take action if needed
                        console.log('Status updated successfully');
                    } else {
                        // Revert the toggle if there was an error
                        console.log('Error updating status');
                        $(this).prop('checked', !isActive);  // Revert toggle
                    }
                }
            });
        });
    });
</script>

{{-- Handle "Select All" checkbox --}}
<script>
    $(document).ready(function () {
        $('#select-all').change(function () {
            $('.learner_details-checkbox').prop('checked', $(this).prop('checked'));
            toggleBulkDeleteButton();
        });

        // Handle individual checkbox changes
        $('.learner_details-checkbox').change(function () {
            let allChecked = $('.learner_details-checkbox').length === $('.learner_details-checkbox:checked').length;
            $('#select-all').prop('checked', allChecked);
            toggleBulkDeleteButton();
        });

        // Enable/Disable the Bulk Delete Button
        function toggleBulkDeleteButton() {
            let anyChecked = $('.learner_details-checkbox:checked').length > 0;
            $('#bulk-delete-btn').prop('disabled', !anyChecked);
        }

        // Bulk Delete Users
        $('#bulk-delete-btn').click(function () {
            let selectedIds = $('.learner_details-checkbox:checked').map(function () {
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
                            url: '{{ route("user.bulk-delete") }}', // Replace with actual route
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}', // CSRF protection
                                ids: selectedIds,
                            },
                            success: function (response) {
                                if (response.success) {
                                    toastr.success(response.success, 'Success');
                                    location.reload(); // Refresh page to reflect changes
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
@endsection