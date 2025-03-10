@extends('admin.layouts.master')

@section('title')
    Contact Us
@endsection

@section('content')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <button type="button" id="delete-selected" class="main-btn">Delete Selected</button>
                <table class="ucp-table" id="contactus-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
                @include('admin.layouts.footer')
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var table = $('#contactus-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('contactus.index') }}",
                columns: [
                    { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'subject', name: 'subject' },
                    { data: 'message', name: 'message' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                order: [[1, 'asc']]  // Sort by name by default
            });

            // Listen for clicks on the delete button for a single record
            $(document).on('click', '.deletecontact', function (e) {
                e.preventDefault();

                // Get the contact id from data attributes
                var contactId = $(this).data('id');

                // Show SweetAlert2 confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Make an AJAX request to delete the contact
                        $.ajax({
                            url: '/contactus/' + contactId,  // URL for the delete route
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"  // CSRF token for security
                            },
                            success: function (response) {
                                toastr.success('Contact details deleted successfully.');
                                setTimeout(function () {
                                    table.ajax.reload();
                                }, 2000);
                            },
                            error: function (xhr, status, error) {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue deleting the contact.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            // Select all checkboxes
            $('#select-all').on('click', function () {
                var isChecked = this.checked;
                $('#contactus-table input.contactus-checkbox').prop('checked', isChecked);
            });

            // Delete selected contacts
            $('#delete-selected').on('click', function () {
                var selectedIds = [];
                $('#contactus-table input.contactus-checkbox:checked').each(function () {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length > 0) {
                    // Show confirmation dialog for multiple deletions
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete selected!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Make an AJAX request to delete selected contacts
                            $.ajax({
                                url: '/contactus/delete-multiple',  // Route for batch delete
                                method: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    ids: selectedIds
                                },
                                success: function (response) {
                                    toastr.success('Selected contacts deleted successfully.');
                                    setTimeout(function () {
                                        table.ajax.reload();
                                    }, 2000);
                                },
                                error: function (xhr, status, error) {
                                    Swal.fire(
                                        'Error!',
                                        'There was an issue deleting the selected contacts.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                } else {
                    // Display toastr message instead of SweetAlert
                    toastr.warning('Please select at least one contact to delete.');
                }
            });
        });
    </script>

@endsection