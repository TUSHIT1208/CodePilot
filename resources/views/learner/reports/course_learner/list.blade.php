@extends('learner.layout.master')

@section('title', 'Total Purchased Courses')

@section('content_learner')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title">Total Learner in Course</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card_dash1">
                        @if ($courses->isEmpty() && $categories->isEmpty())
                            <!-- No Records Found -->
                            <div class="no-categories-container text-center fade-in-animation footer mt-5">
                                <i class="uil uil-folder-minus bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                                <h3 class="mt-3 scale-in-text" style="color: #777;">No Learner Found in Course.</h3>
                                <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have
                                    any
                                    Purchased Course yet. Add one now to get started!</p>
                            </div>
                        @else
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="courseFilter">Filter by Course:</label>
                                    <select id="courseFilter" class="form-control dt-input">
                                        <option value="">All Courses</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->course->id }}">{{ $course->course->title }}
                                            </option>
                                        @endforeach
                                    </select>
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

                            <div class="table-responsive mt-3">
                                <table id="courseTable" class="ucp-table">
                                    <thead>
                                        <tr>
                                            <th>Course Title</th>
                                            <th>Payable Amount</th>
                                            <th>Total Learners</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @include('learner.layout.footer')
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#courseTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('learner.courses.list') }}",
                    data: function(d) {
                        d.course_id = $('#courseFilter').val();
                        d.category_id = $('#category').val();
                        d.subcategory_id = $('#subcategory').val();
                    }
                },
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'final_price',
                        name: 'final_price'
                    },
                    {
                        data: 'total_learners',
                        name: 'total_learners'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    emptyTable: "No Course found"
                }
            });

            // ✅ Reload DataTable when filters change
            $('#category, #subcategory, #courseFilter').on('change', function() {
                console.log("Category Selected: ", $('#category').val()); // ✅ Debugging
                console.log("Subcategory Selected: ", $('#subcategory').val()); // ✅ Debugging
                table.ajax.reload();
            });

            // ✅ Load Subcategories when Category Changes
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
                            $('#subcategory').trigger(
                                'change'); // ✅ Ensures subcategory change is detected
                        }
                    });
                } else {
                    $('#subcategory').empty().append('<option value="">Select Subcategory</option>');
                    table.ajax.reload();
                }
            });
        });
    </script>
@endsection
