@include('admin.layouts.master')
<!-- Body Start -->
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-8">
                    <div class="section3125">
                        <div class="explore_search">
                            <div class="ui search focus">
                                <div class="ui left icon input swdh11">
                                    <input class="prompt srch_explore" type="text" placeholder="Search Learners...">
                                    <i class="uil uil-search-alt icon icon2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="_14d25">
                        <div class="row">
                            @foreach ($learner as $user)
                                <div class="col-xl-3 col-lg-4 col-md-6">
                                    <div class="fcrse_1 mt-30">
                                        <div class="tutor_img text-center">
                                            <!-- Display user profile picture -->
                                            <a href="javascript:void(0);">
                                                <img src="{{ $user->profile_picture_url ? asset('images/' . $user->profile_picture_url) : asset('images/default-profile.png') }}"
                                                    alt="{{ $user->username }}" class="rounded-circle"
                                                    style="width: 120px; height: 120px; object-fit: cover;">
                                            </a>
                                        </div>
                                        <div class="tutor_content_dt">
                                            <div class="tutor150">
                                                <a href="javascript:void(0);" class="tutor_name">
                                                    {{ $user->username }}
                                                </a>
                                                <div class="mef78" title="Verified">
                                                    <i class="uil uil-check-circle"></i>
                                                </div>
                                            </div>
                                            <div class="tutor_cate">{{ $user->email }}</div>

                                            <!-- Toggle Button -->
                                            <div class="toggle-button mt-2">
                                                <input type="checkbox" class="toggle-input" id="toggle{{$user->id}}"
                                                    data-user-id="{{$user->id}}" {{ $user->is_active ? 'checked' : '' }} />
                                                <label for="toggle{{$user->id}}" class="toggle-label">
                                                    <span class="toggle-circle"></span>
                                                </label>
                                            </div>

                                            <ul class="tutor_social_links mt-4">
                                                <!-- Edit Button -->
                                                <li>
                                                    <button type="button" class="btn edit-btn" data-bs-toggle="modal"
                                                        data-bs-target="#editUserModal{{ $user->id }}">
                                                        <i class="uil uil-edit"></i>
                                                    </button>
                                                </li>
                                                <!-- Delete Button -->
                                                <li>
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                        class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn delete-btn"
                                                            data-username="{{ $user->username }}">
                                                            <i class="uil uil-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit User Modal -->
                                <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('user.update', $user->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label for="username{{ $user->id }}"
                                                            class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="username{{ $user->id }}"
                                                            name="username" value="{{ $user->username }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email{{ $user->id }}" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email{{ $user->id }}"
                                                            name="email" value="{{ $user->email }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="phone_number{{ $user->id }}" class="form-label">Phone
                                                            Number</label>
                                                        <input type="text" class="form-control"
                                                            id="phone_number{{ $user->id }}" name="phone_number"
                                                            value="{{ $user->phone_number }}">
                                                    </div>



                                                    <button type=" submit" class="btn btn-primary">Save
                                                        Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Edit User Modal -->
                            @endforeach
                        </div>
                    </div>

                    <!-- Pagination Loader -->
                    <div class="col-md-12">
                        <div class="main-loader mt-50">
                            <div class="spinner">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
</div>

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