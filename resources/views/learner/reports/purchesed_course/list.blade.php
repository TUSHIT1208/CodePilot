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
                            @if ($formattedCourses->isEmpty())
                            <!-- No Records Found -->
                            <div class="no-categories-container text-center fade-in-animation footer mt-5">
                                <i class="uil uil-folder-minus bounce-effect"
                                    style="font-size: 50px; color: #d1d1d1;"></i>
                                <h3 class="mt-3 scale-in-text" style="color: #777;">No Purchased Course Found</h3>
                                <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have
                                    any
                                    Purchased Course yet. Add one now to get started!</p>
                            </div>
                        @else
                        <div class="row">
                            <div class="col-md-3">
                                <label for="enrollDateRange" class="font-weight-bold">Filter by Purchased Course date:</label>
                                <div class="input-group">
                                    <input type="text" id="enrollDateRange" class="form-control" placeholder="Select Date Range">
                                    
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
                            <table id="purchasedCoursesTable" class="table ucp-table">
                                <thead>
                                    <tr>
                                        <th>Course Title</th>
                                        <th>Amount Paid</th>
                                        <th>Purchased On</th>
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
        @include('learner.layout.footer')
    </div>
</div>

<!-- DataTables Script -->
<script>
    $(document).ready(function () {
        // $(document).ready(function () {
    // Initialize DataTable first

        let table = $('#purchasedCoursesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('learner.purchased.course') }}",
                type: "GET",
                data: function (d) {
                    d.date_range = $('#enrollDateRange').val(); // Pass the selected date range to the server
                    d.category_id = $('#category').val();
                    d.subcategory_id = $('#subcategory').val(); 
                }
            },
            columns: [
                { data: 'title', name: 'title' },
                { data: 'total_amount', name: 'total_amount' },
                { data: 'created_at', name: 'created_at' }
            ],
            language: {
                emptyTable: "No purchased courses found"
            }
        });

        // Initialize Date Range Picker
        
            // Initialize Date Range Picker
            $('#enrollDateRange').daterangepicker({
                singleDatePicker: false,
                showDropdowns: true,
                autoApply: true,            // Don't automatically apply today's date
                autoUpdateInput: false,
                linkedCalendars: false, // Ensures only one month is displayed
                opens: "left",
                locale: {
                    format: 'YYYY-MM-DD'
                },
                maxDate: moment(), // Prevent future date selection
            });
        // When date range is selected, update the input and reload DataTable
        $('#enrollDateRange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
            table.ajax.reload(); // Reload DataTable with the new date range
        });

        // When date range is cleared, reset input and reload DataTable
        $('#enrollDateRange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            table.ajax.reload();
        });
                // Reload DataTable when filters change
            $('#category, #subcategory, #enrollDateRange').on('change', function () {
                console.log("Category Selected: ", $('#category').val());  // ✅ Debugging
                console.log("Subcategory Selected: ", $('#subcategory').val());  // ✅ Debugging
            table.ajax.reload();
            });

        $('#category').change(function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: "/get-subcategories/" + categoryId,
                        type: "GET",
                        success: function(data) {
                            $('#subcategory').empty().append('<option value="">Select Subcategory</option>');
                            $.each(data, function(key, value) {
                                $('#subcategory').append('<option value="' + value.id + '">' + value.name + '</option>');
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
