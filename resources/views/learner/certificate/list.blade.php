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
                        <h2 class="st_title"><i class="uil uil-award"></i> My Certificates</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mt-10">
                            <div class="table-cerificate">
                                <div class="table-responsive">
                                    <table id="certificateTable" class="ucp-table table">
                                        <thead>
                                            <tr>
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
        </div>
    </div>

    <!-- Include DataTables CSS -->
    {{--
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}

    <script>
        $(document).ready(function () {
            $('#certificateTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('certificate.list') }}',
                columns: [
                    { data: 'test_title', name: 'test.test_title' },
                    { data: 'passing_mark', name: 'test.passing_mark' },
                    { data: 'total_marks', name: 'test.total_marks' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'certificate', name: 'certificate', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endsection