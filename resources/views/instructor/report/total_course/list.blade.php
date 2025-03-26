@extends('instructor.layouts.master')
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
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label>Category</label>
                                <select id="categoryFilter" class="form-control _dlor1 mt-2">
                                    <option value=""> - - All Categories - - </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label>Sub-Category</label>
                                <select id="subCategoryFilter" class="form-control _dlor1 mt-2">
                                    <option value=""> - - All Sub-Categories - - </option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label>Course Type</label>
                                <select id="courseTypeFilter" class="form-control _dlor1 mt-2">
                                    <option value=""> - - Course Type - - </option>
                                    <option value="free">Free</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label>Instructor</label>
                                <select id="instructorFilter" class="form-control _dlor1 mt-2">
                                    <option value=""> - - All Instructors - - </option>
                                    @foreach ($instructors as $instructor)
                                        <option value="{{ $instructor->id }}">{{ $instructor->first_name }}
                                            {{ $instructor->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane fade show active mt-5" id="pills-my-courses" role="tabpanel">
                            <div class="table-responsive mt-3">
                                <table class="ucp-table" id="coursesTable">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th>Created By</th>
                                            <th>Price</th>
                                            <th>Published At</th>
                                            <th>Status</th>
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
            var table = $('#coursesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('totalCourses') }}',
                    data: function(d) {
                        d.category_id = $('#categoryFilter').val();
                        d.sub_category_id = $('#subCategoryFilter').val();
                        d.course_type = $('#courseTypeFilter').val();
                        d.instructor_id = $('#instructorFilter').val();
                    }
                },
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'sub_category',
                        name: 'sub_category'
                    },
                    {
                        data: 'instructor',
                        name: 'instructor'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'published_at',
                        name: 'published_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ]
            });

            // Category Filter Change
            $('#categoryFilter').change(function() {
                var categoryId = $(this).val();
                $('#subCategoryFilter').html('<option value="">All Sub-Categories</option>');

                if (categoryId) {
                    $.ajax({
                        url: '{{ route('getSubcategories') }}',
                        type: 'GET',
                        data: {
                            category_id: categoryId
                        },
                        success: function(response) {
                            $.each(response, function(index, subCategory) {
                                $('#subCategoryFilter').append('<option value="' +
                                    subCategory.id + '">' + subCategory.name +
                                    '</option>');
                            });
                        }
                    });
                }
                table.ajax.reload();
            });

            $('#subCategoryFilter, #courseTypeFilter, #instructorFilter').change(function() {
                table.ajax.reload();
            });
        });
    </script>
@endsection
