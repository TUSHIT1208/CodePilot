@extends('admin.layouts.master')

@section('title', 'User Course Enrollments')

@section('content')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class="uil uil-book"></i> Total Enroll</h2>
                    </div>
                </div>               

                <div class="col-md-12">
                    <div class="card_dash1">
                        <div class="table-responsive mt-30">
                            <!-- Filters: Course and Enroll Date -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="courseFilter">Filter by Course:</label>
                                    <select id="courseFilter" class="form-control">
                                        <option value="">All Courses</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <label for="enrollDateRange" class="font-weight-bold">Filter by Enroll Date:</label>
                                    <div class="input-group">
                                        <input type="text" id="enrollDateRange" class="form-control" placeholder="Select Date Range">
                                        
                                    </div>
                                </div>

                                {{-- <div class="col-md-3 mt-4">
                                    <button id="resetFilters" class="btn btn-danger">Reset Filters</button>
                                </div> --}}
                            </div>

                            <table id="userCourseTable" class="ucp-table">
                                <thead>
                                    <tr>
                                        <th>Learner Name</th>
                                        <th>Course Name</th>
                                        <th>Enrolled At</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @include('admin.layouts.footer')
</div>

<!-- DataTables and Date Range Picker Script -->

<script>
    $(document).ready(function () {
        // Initialize Date Range Picker
        $('#enrollDateRange').daterangepicker({
            singleDatePicker: false,
            showDropdowns: true,
            autoApply: true, // Removes Apply/Cancel buttons
            linkedCalendars: false, // Ensures only one month is displayed
            opens: "left",
            locale: {
                format: 'YYYY-MM-DD'
            },
            maxDate: moment(), // Prevent future date selection
        });

        // Trigger filter on date selection
        $('#enrollDateRange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
            table.ajax.reload(); // Reload DataTable with selected date range
        });

        // Clear filter when input is cleared
        $('#enrollDateRange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            table.ajax.reload();
        });

        // Initialize DataTables
        let table = $('#userCourseTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('total.enroll') }}",
                data: function (d) {
                    d.course_id = $('#courseFilter').val();
                    d.date_range = $('#enrollDateRange').val();
                }
            },
            columns: [
                { data: "learner_name", name: "learner_name" },
                { data: "course_title", name: "course_title" },
                { data: "created_at", name: "created_at" }
            ],
            language: {
                emptyTable: "No enrollments found"
            }
        });

        // Reload table when filters change
        $('#courseFilter, #enrollDateRange').on('change', function () {
            table.ajax.reload();
        });

        // Reset Filters
        $('#resetFilters').click(function() {
            $('#courseFilter').val('');
            $('#enrollDateRange').val('');
            table.ajax.reload();
        });
    });
</script>
@endsection
