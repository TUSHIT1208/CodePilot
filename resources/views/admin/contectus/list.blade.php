@extends('admin.layouts.master')

@section('title')
    Contact Us
@endsection

@section('content')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class="uil uil-folder-plus"></i> Contact Detail's </h2>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card_dash1">
                        <div class="row mt-2">
                            <div class="col-lg-12 col-md-4 col-sm-6 text-end">
                                @if (!$contactus->isEmpty())
                                    <button type="button" id="delete-selected" class="main-btn">Delete Selected</button>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                            <div class="table-responsive mt-30">
                                @if ($contactus->isEmpty())
                                    <!-- No Records Found -->
                                    <div class="no-categories-container text-center fade-in-animation footer">
                                        <i class="uil uil-folder-minus bounce-effect"
                                            style="font-size: 50px; color: #d1d1d1;"></i>
                                        <h3 class="mt-5 scale-in-text" style="color: #777;">No Contact detail's Found</h3>
                                        <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                                            contact yet.</p>
                                    </div>
                                @else
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.footer')
    </div>
    <script>
        $(document).ready(function () {
            var table = $('#contactus-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('contactus.index') }}",
                columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'subject',
                    name: 'subject'
                },
                {
                    data: 'message',
                    name: 'message'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
                ],
                order: [
                    [1, 'asc']
                ] // Sort by name by default
            });

            // Set global Toastr options
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000",
                "extendedTimeOut": "2000",
                "positionClass": "toast-top-right",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "onShown": function () {
                    $('.toast-success').css({
                        'background-color': '#28a745', // Green for success
                        'opacity': '1' // Adjust opacity
                    });
                    $('.toast-error').css({
                        'background-color': '#dc3545', // Red for error
                        'opacity': '1'
                    });
                    $('.toast-warning').css({
                        'background-color': '#ffc107', // Yellow for warning
                        'opacity': '1'
                    });
                    $('.toast-info').css({
                        'background-color': '#17a2b8', // Blue for info
                        'opacity': '1'
                    });
                }
            };

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
                            url: '/contactus/' + contactId, // URL for the delete route
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}" // CSRF token for security
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
                                url: '/contactus/delete-multiple', // Route for batch delete
                                method: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    ids: selectedIds
                                },
                                success: function (response) {
                                    toastr.success(
                                        'Selected contacts deleted successfully.');
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