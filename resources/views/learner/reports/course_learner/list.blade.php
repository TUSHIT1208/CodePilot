@extends('learner.layout.master')

@section('title', 'Total Purchased Courses')

@section('content_learner')
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="st_title">Total Purchased Courses</h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card_dash1">
                    <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                        <div class="table-responsive mt-3">
                            <table id="courseTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Course Title</th>
                                        <th>Payable Amount</th>
                                        <th>Total Learners</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('learner.layout.footer')
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#courseTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('learner.courses.list') }}",
            columns: [
                { data: 'title', name: 'title' },
                { data: 'total_learners', name: 'total_learners' },
                { data: 'final_price', name: 'final_price' }
            ]
        });
    });
</script>
@endsection
