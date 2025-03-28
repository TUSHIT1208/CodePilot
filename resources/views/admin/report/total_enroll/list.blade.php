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
                            @if ($courses->isEmpty() && $categories->isEmpty())
                                <div class="no-categories-container text-center fade-in-animation footer">
                                    <i class="uil uil-transaction bounce-effect"
                                        style="font-size: 50px; color: #d1d1d1;"></i>
                                    <h3 class="mt-3 scale-in-text" style="color: #777;">No Enroll Found</h3>
                                    <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                                        Enroll yet. Add one now to get started!</p>
                                </div>
                            @else
                                <!-- Filters: Course and Enroll Date -->
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="courseFilter">Filter by Course:</label>
                                        <select id="courseFilter" class="form-control dt-input">
                                            <option value="">All Courses</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="enrollDateRange" class="font-weight-bold">Filter by Enroll Date:</label>
                                        <div class="input-group">
                                            <input type="text" id="enrollDateRange" class="form-control"
                                                placeholder="Select Date Range">

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="category">Select Category</label>
                                        <select id="category" class="form-control dt-input">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="subcategory">Select Subcategory</label>
                                        <select id="subcategory" class="form-control dt-input">
                                            <option value="">-- Select Subcategory --</option>
                                        </select>
                                    </div>
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.layouts.footer')
    </div>

    <!-- DataTables and Date Range Picker Script -->

    <script>
        $(document).ready(function() {
            $('#enrollDateRange').val('').attr('placeholder', 'Select Date Range');
            // Initialize Date Range Picker
            $('#enrollDateRange').daterangepicker({
                singleDatePicker: false,
                showDropdowns: true,
                autoApply: true, // Don't automatically apply today's date
                autoUpdateInput: false,
                linkedCalendars: false, // Ensures only one month is displayed
                opens: "left",
                locale: {
                    format: 'YYYY-MM-DD'
                },
                maxDate: moment(), // Prevent future date selection
            });

            // Trigger filter on date selection
            $('#enrollDateRange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
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
                    data: function(d) {
                        d.course_id = $('#courseFilter').val();
                        d.date_range = $('#enrollDateRange').val();
                        d.category_id = $('#category').val();
                        d.subcategory_id = $('#subcategory').val();
                    }
                },
                columns: [{
                        data: "learner_name",
                        name: "learner_name"
                    },
                    {
                        data: "course_title",
                        name: "course_title"
                    },
                    {
                        data: "created_at",
                        name: "created_at"
                    }
                ],
                language: {
                    emptyTable: "No enrollments found"
                }
            });

            // Reload table when filters change
            $('#courseFilter, #enrollDateRange').on('change', function() {
                table.ajax.reload();
            });

            // Reset Filters
            $('#resetFilters').click(function() {

                table.ajax.reload();
            });
            // Reload DataTable when filters change
            $('#category, #subcategory, #courseFilter, #enrollDateRange').on('change', function() {
                console.log("Category Selected: ", $('#category').val()); // ✅ Debugging
                console.log("Subcategory Selected: ", $('#subcategory').val()); // ✅ Debugging
                table.ajax.reload();
            });

            // Load Subcategories based on Selected Category
            $('#category').change(function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: "/get-subcategories/" + categoryId,
                        type: "GET",
                        success: function(data) {
                            $('#subcategory').empty().append(
                                '<option value="">Select Subcategory</option>');
                            $.each(data, function(key, value) {
                                $('#subcategory').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategory').empty().append('<option value="">Select Subcategory</option>');
                }
            });
        });
    </script>
@endsection
