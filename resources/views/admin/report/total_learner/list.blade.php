@extends('admin.layouts.master')
@section('title')
    Learners
@endsection
@section('content')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <h2 class="st_title">Total Learners</h2>
                <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                    @if ($learners->isEmpty())
                        <!-- No Records Found -->
                        <div class="no-categories-container text-center fade-in-animation footer">
                            <i class="uil uil-folder-minus bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                            <h3 class="mt-3 scale-in-text" style="color: #777;">No Learner Found</h3>
                            <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have
                                any
                                categories yet. Add one now to get started!</p>

                        </div>
                    @else
                        <div class="table-responsive mt-30">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Profile</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @include('admin.layouts.footer')
    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('totalLearners') }}",
                columns: [{
                        data: 'profile',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'full_name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'phone_number'
                    },
                    {
                        data: 'status',
                        orderable: false
                    }
                ]
            });
        });
    </script>
@endsection
