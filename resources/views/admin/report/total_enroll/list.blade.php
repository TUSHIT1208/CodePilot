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
                            @if ($userCourses->isEmpty())
                                <!-- No Records Found -->
                                <div class="no-categories-container text-center fade-in-animation footer">
                                    <i class="uil uil-folder-minus bounce-effect" style="font-size: 50px; color: #d1d1d1;"></i>
                                    <h3 class="mt-3 scale-in-text" style="color: #777;">No Enroll Found</h3>
                                   
                                </div>
                            @else
                            {{-- <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="courseFilter">Filter by Course:</label>
                                    <select id="courseFilter" class="form-control">
                                        <option value="">All Courses</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
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

<!-- DataTables Script -->
<script>
    $(document).ready(function () {
            $('#userCourseTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('total.enroll') }}",
                columns: [
                    { data: "learner_name", name: "learner_name" },
                { data: "course_title", name: "course_title" },
                { data: "created_at", name: "created_at" }
                ], language: {
                    emptyTable: "No enrollments found"
                },
                error: function (xhr) {
                    console.log("AJAX Error: ", xhr.responseText);
                }
            });
        });
</script>
@endsection
