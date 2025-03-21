@extends('admin.layouts.master')
@section('title')
    Total Courses
@endsection
@section('content')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title">Total Courses</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card_dash1">
                        <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                            <div class="table-responsive mt-3">
                                <table class="ucp-table" id="coursesTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Instructor</th>
                                            <th>Attachments</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#coursesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('totalCourses') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'instructor',
                        name: 'instructor'
                    },
                    {
                        data: 'attachments',
                        name: 'attachments'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                ]
            });
        });
    </script>
@endsection
