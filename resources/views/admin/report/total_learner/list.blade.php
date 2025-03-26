@extends('admin.layouts.master')
@section('title')
    Learners
@endsection
@section('content')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title">Total Learners</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card_dash1">

                        <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                            @if ($learners->isEmpty())
                                <!-- No Records Found -->
                                <div class="no-categories-container text-center fade-in-animation footer mt-5">
                                    <i class="uil uil-folder-minus bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                                    <h3 class="mt-3 scale-in-text" style="color: #777;">No Learner Found</h3>
                                    <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have
                                        any
                                        learner's yet.</p>
                                </div>
                            @else
                                <div class="row mb-4">
                                    <div class="col-sm-3">
                                        <label for="category">Select Category</label>
                                        <select id="category" class="form-control _dlor1">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="subcategory">Select Subcategory</label>
                                        <select id="subcategory" class="form-control _dlor1">
                                            <option value="">-- Select Subcategory --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="table-responsive mt-3">
                                    <table class="ucp-table" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Course</th>
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
            </div>
        </div>
        @include('admin.layouts.footer')

        <script>
            $(document).ready(function () {
                var table = $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('totalLearners') }}",
                        data: function (d) {
                            d.category_id = $('#category').val();
                            d.subcategory_id = $('#subcategory').val();
                        }
                    },
                    columns: [{
                            data: 'course_title',
                        }, {
                            data: 'profile_picture_url',
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
                            data: 'is_active',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                // Reload DataTable when category or subcategory changes
                $('#category, #subcategory').change(function () {
                    table.ajax.reload();
                });

                // Load Subcategories when Category is Selected
                $('#category').change(function () {
                    var categoryId = $(this).val();
                    if (categoryId) {
                        $.ajax({
                            url: "/get-subcategories/" + categoryId,
                            type: "GET",
                            success: function (data) {
                                $('#subcategory').empty().append(
                                    '<option value="">-- Select Subcategory --</option>');
                                $.each(data, function (key, value) {
                                    $('#subcategory').append('<option value="' + value.id +
                                        '">' + value.name + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#subcategory').empty().append('<option value="">-- Select Subcategory --</option>');
                    }
                });
            });
        </script>

@endsection