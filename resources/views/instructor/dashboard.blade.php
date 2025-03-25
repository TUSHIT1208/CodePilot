@extends('instructor.layouts.master')

@section('title') Dashboard @endsection

@section('content')
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="st_title"><i class="uil uil-apps"></i> Instructor Dashboard</h2>
                    <h2>Welcome {{ Auth::user()->username}} !!</h2>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card_dash">
                        <div class="card_dash_left">
                            <h5>Total Earning</h5>
                            <h2>{{ number_format($total_earning, 0) }}</h2>
                            {{-- <span class="crdbg_1">New $50</span> --}}
                            <a href="{{ route('total.instructor.earning') }}">View Net Earning</a>
                        </div>
                        <div class="card_dash_right">
                            <img src="{{ asset('images/dashboard/achievement.svg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card_dash">
                        <div class="card_dash_left">
                            <h5>Total Enroll</h5>
                            <h2>{{ $total_enrollments }}</h2>
                            {{-- <span class="crdbg_2">New 125</span> --}}
                            <a href="{{ route('total.instructor.enroll') }}">View All Enroll</a>
                        </div>
                        <div class="card_dash_right">
                            <img src="images/dashboard/graduation-cap.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card_dash">
                        <div class="card_dash_left">
                            <h5>Total Courses</h5>
                            <h2>{{ $total_course }}</h2>
                            {{-- <span class="crdbg_3">New 5</span> --}}
                            <a href="{{ route('totalCourses') }}">View courses</a>
                        </div>
                        <div class="card_dash_right">
                            <img src="images/dashboard/online-course.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card_dash1">
                        <div class="card_dash_left1">
                            <i class="uil uil-book-alt"></i>
                            <h1>Jump Into Course Creation</h1>
                        </div>
                        <div class="card_dash_right1">
                            <a href="{{ route('course.create') }}" class="upload_btn" title="Create New Course">Create New Course</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="section3125 mt-50">
                        <h4 class="item_title">Latest Courses</h4>
                        <div class="la5lo1">
                            <div class="owl-carousel courses_performance owl-theme">
                                @foreach($courses as $course)
                                    <div class="item">
                                        <div class="fcrse_1">
                                            <a href="{{ route('course.show', $course->id) }}" class="fcrse_img">
                                                <img src="{{ asset('courseThumbnail/'.$course->thumbnail_url ?? 'images/default-course.jpg') }}" alt="{{ $course->title }}">
                                                <div class="course-overlay" style="width:100%"></div>
                                            </a>
                                            <div class="fcrse_content">
                                                <div class="vdtodt">
                                                    <span class="vdt14">
                                                        {{ $course->created_at ? \Carbon\Carbon::parse($course->created_at)->diffForHumans() : 'Not Published' }}
                                                    </span>
                                                </div>
                                                <a href="{{ route('course.show', $course->id) }}" class="crsedt145">{{ $course->title }}</a>
                                                <p class="course-description">{!! Str::limit($course->course_description, 100) !!}</p>


                                                <div class="allvperf">
                                                    <div class="crse-perf-left">Price</div>
                                                    <div class="crse-perf-right">
                                                        @if($course->discount)
                                                            <del>₹{{ number_format($course->price, 2) }}</del> ₹{{ number_format($course->price - $course->discount, 2) }}
                                                        @else
                                                        ₹{{ number_format($course->price, 2) }}
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="allvperf">
                                                    <div class="crse-perf-left">Category</div>
                                                    <div class="crse-perf-right">{{ $course->category->name ?? 'N/A' }}</div>
                                                </div>

                                                <div class="allvperf">
                                                    <div class="crse-perf-left">Subcategory</div>
                                                    <div class="crse-perf-right">{{ $course->subcategory->name ?? 'N/A' }}</div>
                                                </div>

                                                <div class="allvperf">
                                                    <div class="crse-perf-left">Course Level</div>
                                                    <div class="crse-perf-right">{{ $course->course_level }}</div>
                                                </div>

                                                <div class="auth1lnkprce">
                                                    <a href="#" class="cr1fot50">See Reviews ({{ $course->reviews_count ?? 0 }})</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="section3125 mt-50">
                        <h4 class="item_title">Most Selling Courses</h4>
                        <div class="la5lo1">
                            <div class="owl-carousel courses_performance owl-theme">
                                @foreach($most_courses as $course)
                                    <div class="item">
                                        <div class="fcrse_1">
                                            <a href="{{ route('course.show', $course->id) }}" class="fcrse_img">
                                                <img src="{{ asset('courseThumbnail/'.$course->thumbnail_url ?? 'images/default-course.jpg') }}" alt="{{ $course->title }}">
                                                <div class="course-overlay" style="width:100%"></div>
                                            </a>
                                            <div class="fcrse_content">
                                                <div class="vdtodt">
                                                    <span class="vdt14">
                                                        {{ $course->created_at ? \Carbon\Carbon::parse($course->created_at)->diffForHumans() : 'Not Published' }}
                                                    </span>
                                                </div>
                                                <a href="{{ route('course.show', $course->id) }}" class="crsedt145">{{ $course->title }}</a>
                                                <p class="course-description">{!! Str::limit($course->course_description, 100) !!}</p>


                                                <div class="allvperf">
                                                    <div class="crse-perf-left">Price</div>
                                                    <div class="crse-perf-right">
                                                        @if($course->discount)
                                                            <del>₹{{ number_format($course->price, 2) }}</del> ₹{{ number_format($course->price - $course->discount, 2) }}
                                                        @else
                                                        ₹{{ number_format($course->price, 2) }}
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="allvperf">
                                                    <div class="crse-perf-left">Category</div>
                                                    <div class="crse-perf-right">{{ $course->category->name ?? 'N/A' }}</div>
                                                </div>

                                                <div class="allvperf">
                                                    <div class="crse-perf-left">Subcategory</div>
                                                    <div class="crse-perf-right">{{ $course->subcategory->name ?? 'N/A' }}</div>
                                                </div>

                                                <div class="allvperf">
                                                    <div class="crse-perf-left">Course Level</div>
                                                    <div class="crse-perf-right">{{ $course->course_level }}</div>
                                                </div>

                                                <div class="auth1lnkprce">
                                                    <a href="#" class="cr1fot50">See Reviews ({{ $course->reviews_count ?? 0 }})</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{-- {{--  --}}
                        <div class="section3125 mt-50">
                            <h4 class="item_title">Submit Courses</h4>
                            <div class="la5lo1">
                                <div class="fcrse_1">
                                    <div class="fcrse_content">
                                        @if($pendingCourse)
                                        <div class="upcming_card">
                                            <a href="{{ route('course.show', $pendingCourse->id) }}" class="crsedt145">
                                                {{ $pendingCourse->title }} 
                                                <span class="pndng_145">Pending</span>
                                            </a>
                                            <p class="submit-course">Submitted <span>{{ $pendingCourse->created_at->diffForHumans() }}</span></p>
                                        </div>
                                        @else
                                        <div class="upcming_card">
                                            <p class="text-muted">No pending courses found.</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="section3125 mt-50">
                    <h4 class="item_title">Top Orders</h4>
                    <div class="la5lo1">
                        <div class="fcrse_1">
                            <div class="fcrse_content">
                                <table id="ordersTable" class="display ucp-table">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Course Name</th>
                                            <th>Total Courses</th>
                                            <th>Total Amount</th>
                                            <th>Discount</th>
                                            <th>Payable Amount</th>
                                            <th>Booking Number</th>
                                            <th>Payment Status</th>
                                            <th>Phone</th>
                                            <th>Date & Time</th>
                                        </tr>
                                    </thead>
                                </table>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.footer')
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#ordersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('instructor.dashboard') }}",
            columns: [
                { data: 'user', name: 'user' },
                { data: 'course_name', name: 'course_name' }, // Add course name column
                { data: 'total_course', name: 'total_course' },
                { data: 'total_amount', name: 'total_amount' },
                { data: 'total_discount', name: 'total_discount' },
                { data: 'payable_amount', name: 'payable_amount' },
                { data: 'booking_number', name: 'booking_number' },
                { data: 'payment_status', name: 'payment_status' },
                { data: 'phone', name: 'phone' },
                { data: 'created_at', name: 'created_at' }
            ]
        });
    });
</script>
@endsection