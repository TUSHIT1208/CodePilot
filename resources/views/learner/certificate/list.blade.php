@extends('learner.layout.master')

@section('title')
    Certificates
@endsection

@section('content_learner')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section3125 mt-3">
                            <h2 class="st_title"><i class="uil uil-award"></i> My certificate</h2>
                        </div>
                    </div>
                </div>
                @if ($certificates->isEmpty())
                    <div class="no-categories-container text-center fade-in-animation footer mt-5">
                        <i class="uil uil-award bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                        <h3 class="mt-3 scale-in-text" style="color: #777;">No Certificate Achieved</h3>
                        <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                            certificate yet. purchase the course to get started!</p>
                    </div>
                @else
                    <!-- No Records Found -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card_dash1">
                                <div class="mt-10">
                                    <div class="table-cerificate">
                                        <div class="table-responsive mt-3">
                                            <table id="certificateTable" class="ucp-table">
                                                <thead>
                                                    <tr>
                                                        <th>Course Title</th>
                                                        <th>Test Title</th>
                                                        <th>Passing Marks</th>
                                                        <th>Total Marks</th>
                                                        <th>Certificate Created At</th>
                                                        <th>Certificate</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody> <!-- Data will be loaded via AJAX -->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @include('admin.layouts.footer')
    </div>

    <script>
        $(document).ready(function () {
            $('#certificateTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('certificate.list') }}',
                columns: [
                    {
                        data: 'course_title', // Add course title column
                        name: 'test.course.title'
                    }, {
                        data: 'test_title',
                        name: 'test.test_title'
                    },
                    {
                        data: 'overall_score', // Fix column reference
                        name: 'test.test_result.overall_score' // Change from 'test.testresult' to 'test.test_result'
                    },
                    {
                        data: 'total_marks',
                        name: 'test.total_marks'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'certificate',
                        name: 'certificate',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
     </script>

@endsection
