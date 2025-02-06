@include('admin.layouts.master')
<!-- Body Start -->
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="card_dash1">
                            <div class="row mt-2">
                                <div class="col-lg-2">
                                    <h4 class=""><i class="uil uil-plus"></i> Instructor List</h4>
                                </div>
                                <div class="col-lg-7">
                                    <div class="search120">
                                        <div class="ui search">
                                            <div class="ui left icon input swdh10">
                                                <input class="prompt srch10" type="text" placeholder="Search for Instructor...">
                                                <i class='uil uil-search-alt icon icon1'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                
                            <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                                <div class="table-responsive mt-30">
                                    @if($instructor->isEmpty())
                                        <!-- No Records Found -->
                                        <div class="no-categories-container text-center fade-in-animation footer">
                                            <i class="uil uil-folder-minus bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                                            <h3 class="mt-3 scale-in-text" style="color: #777;">No Instructor Found</h3>
                                            <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any categories yet. Add one now to get started!</p>
                                            
                                        </div>
                                    @else
                                        <!-- Display Table When Data Exists -->
                                        <table class="ucp-table">
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
                                            <tbody class="ucp-table">
                                                @foreach($instructor as $details)
                                                    <tr>
                                                        <!-- Checkbox in the first column -->
                                                        <td class="text-center ">
                                                            <input type="checkbox" class="details-checkbox" value="{{ $details->id }}">
                                                        </td>                                                       
                                                        <td class="text-center"><p class="ucp-table">{{ $details->username }}</p></td>
                                                        <td class="text-center">
                                                            @if(!empty($details->profile_picture_url))
                                                                <img id="profile_picture" src="{{ asset($details->profile_picture_url) }}">
                                                            @else
                                                                <h1 id="default_avtar">{{ substr($details->username, 0, 1) }}</h1>
                                                            @endif
                                                        </td>
                                                        <td class="text-center"><p class="ucp-table">{{ $details->first_name }}</p></td>
                                                        <td class="text-center"><p class="ucp-table">{{ $details->middle_name }}</p></td>
                                                        <td class="text-center"><p class="ucp-table">{{ $details->last_name }}</p></td>
                                                        <td class="text-center"><p class="ucp-table">{{ $details->email }}</p></td>
                                                        <td class="text-center"><p class="ucp-table">{{ $details->phone_number }}</p></td>
                                                        <td class="text-center"><p class="ucp-table">{{ $details->date_of_birth }}</p></td>
                                                        <td class="text-center">
                                                            <div class="toggle-button mt-2 text-center">
                                                                <input type="checkbox" class="toggle-input" id="toggle{{$details->id}}" data-user-id="{{$details->id}}" {{ $details->is_active ? 'checked' : '' }}>
                                                                <label for="toggle{{$details->id}}" class="toggle-label">
                                                                    <span class="toggle-circle"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="#" title="Edit" class="gray-s" data-bs-toggle="modal" data-bs-target="#editdetailsModal{{ $details->id }}">
                                                                <i class="uil uil-edit-alt ucp-table"></i>
                                                            </a>
                                                            <form action="{{ route('user.destroy', $details->id) }}" method="POST" class="delete-form d-inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="javascript:;" title="Delete" class="gray-s delete-btn" data-username="{{ $details->username }}">
                                                                    <i class="uil uil-trash-alt ucp-table"></i>
                                                                </a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <!-- Edit User Modal -->
                                                    <div class="modal fade" id="editdetailsModal{{ $details->id }}" tabindex="-1"
                                                        aria-labelledby="editdetailsModalLabel{{ $details->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="{{ route('user.update', $details->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Learner Details</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="username{{ $details->id }}" class="form-label">Username</label>
                                                                            <input type="text" class="form-control _dlor1" name="username" value="{{ $details->username }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="first_name{{ $details->id }}" class="form-label">First Name</label>
                                                                            <input type="text" class="form-control _dlor1" name="first_name" value="{{ $details->first_name }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="middle_name{{ $details->id }}" class="form-label">Middle Name</label>
                                                                            <input type="text" class="form-control _dlor1" name="middle_name" value="{{ $details->middle_name }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="last_name{{ $details->id }}" class="form-label">Last Name</label>
                                                                            <input type="text" class="form-control _dlor1" name="last_name" value="{{ $details->last_name }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="email{{ $details->id }}" class="form-label">Email</label>
                                                                            <input type="email" class="form-control _dlor1" name="email" value="{{ $details->email }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="phone{{ $details->id }}" class="form-label">Phone</label>
                                                                            <input type="text" class="form-control _dlor1" name="phone_number" value="{{ $details->phone_number }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="date_of_birth{{ $details->id }}" class="form-label">Date of Birth</label>
                                                                            <input type="date" class="form-control _dlor1" name="date_of_birth" value="{{ $details->date_of_birth }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="main-btn" data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="main-btn">Save Changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Edit User Modal -->
                                                @endforeach
                                            </tbody>
                                        </table>                                        
                                    @endif
                                </div>
                            </div>
                            @if(!$instructor->isEmpty())
                                <div class="card-footer mt-4">
                                    <div class="mt-3">
                                        <button id="bulk-delete-btn" class="btn" disabled>Delete Selected</button>
                                    </div>                                
                                    <div class="d-flex justify-content-end mt-3">
                                        {{ $instructor->links('pagination::bootstrap-5') }}
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


<script>
    $(document).ready(function () {
        // Handle toggle change event
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

<script>
    $(document).ready(function () {
    // Handle "Select All" checkbox
    $('#select-all').change(function () {
        $('.details-checkbox').prop('checked', $(this).prop('checked'));
        toggleBulkDeleteButton();
    });

    // Handle individual checkbox changes
    $('.details-checkbox').change(function () {
        let allChecked = $('.details-checkbox').length === $('.details-checkbox:checked').length;
        $('#select-all').prop('checked', allChecked);
        toggleBulkDeleteButton();
    });

    // Enable/Disable the Bulk Delete Button
    function toggleBulkDeleteButton() {
        let anyChecked = $('.details-checkbox:checked').length > 0;
        $('#bulk-delete-btn').prop('disabled', !anyChecked);
    }

    // Bulk Delete Users
    $('#bulk-delete-btn').click(function () {
        let selectedIds = $('.details-checkbox:checked').map(function () {
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