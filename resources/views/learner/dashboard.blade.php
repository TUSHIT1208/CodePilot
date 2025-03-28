@extends('learner.layout.master')

@section('title')
	Dashboard
@endsection

@section('content_learner')
	<style>
		.rating-stars {
			display: flex;
			gap: 2px;
			/* Adjust spacing between stars */
			font-size: 18px;
			/* Adjust star size */
		}
	</style>
	<div class="wrapper">
		<div class="sa4d25">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h2 class="st_title"><i class="uil uil-apps"></i> Student Dashboard</h2>
					</div>
					<div class="col-xl-4 col-lg-6 col-md-6">
						<div class="card_dash">
							<div class="card_dash_left">
								<h5>Total Purchased Courses</h5>
								<h2>{{ $total_purcharsed_course }}</h2>
								<a href="{{ route('learner.purchased.course')}}">View all purchased course</a>
							</div>
						</div>

					</div>
					<div class="col-xl-4 col-lg-6 col-md-6">
						<div class="card_dash">
							<div class="card_dash_left">
								<h5>Total Course</h5>
								<h2>{{ $total_course }}</h2>
								<a href="{{ route('learner.course')}}">View all Courses</a>
								{{-- <span class="crdbg_4">New 3</span> --}}
							</div>
							<div class="card_dash_right">
								<img src="images/dashboard/knowledge.svg" alt="">
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-md-6">
						<div class="card_dash">
							<div class="card_dash_left">
								<h5>Total Learner in courses</h5>
								<h2>{{ $total_learners }}</h2>
								<a href="{{ route('learner.courses.list')}}">View all Learner in courses</a>
								{{-- <span class="crdbg_4">New 3</span> --}}
							</div>
							<div class="card_dash_right">
								<img src="images/dashboard/knowledge.svg" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 col-lg-6 col-md-6">
						<div class="section3125 mt-50">
							<h4 class="item_title">Most Selling Courses</h4>
							<div class="la5lo1">
								<div class="owl-carousel courses_performance owl-theme">
								@if($most_courses->isEmpty())
									<div class="alert alert-info text-center">
										No course found.
									</div>
								@else
									@foreach($most_courses as $course)
										<div class="item">
											<div class="fcrse_1">
												<a href="{{ route('course.show', $course->id) }}" class="fcrse_img">
													<img src="{{ asset('courseThumbnail/' . $course->thumbnail_url ?? 'images/default-course.jpg') }}"
														alt="{{ $course->title }}">
													<div class="course-overlay" style="width:100%"></div>
												</a>
												<div class="fcrse_content">
													<div class="vdtodt">
														<span class="vdt14">
															{{ $course->created_at ? \Carbon\Carbon::parse($course->created_at)->diffForHumans() : 'Not Published' }}
														</span>
													</div>
													<a href="{{ route('course.show', $course->id) }}"
														class="crsedt145">{{ $course->title }}</a>
													<p class="course-description">
														{!! Str::limit($course->course_description, 100) !!}
													</p>


													<div class="allvperf">
														<div class="crse-perf-left">Price</div>
														<div class="crse-perf-right">
															@if($course->discount)
																<del>₹{{ number_format($course->price, 2) }}</del>
																₹{{ number_format($course->price - $course->discount, 2) }}
															@else
																₹{{ number_format($course->price, 2) }}
															@endif
														</div>
													</div>

													<div class="allvperf">
														<div class="crse-perf-left">Category</div>
														<div class="crse-perf-right">{{ $course->category->name ?? 'N/A' }}
														</div>
													</div>

													<div class="allvperf">
														<div class="crse-perf-left">Subcategory</div>
														<div class="crse-perf-right">{{ $course->subcategory->name ?? 'N/A' }}
														</div>
													</div>

													<div class="allvperf">
														<div class="crse-perf-left">Course Level</div>
														<div class="crse-perf-right">{{ $course->course_level }}</div>
													</div>

													<div class="auth1lnkprce">
														<a href="#" class="cr1fot50">See Reviews
															({{ $course->reviews_count ?? 0 }})</a>
													</div>
												</div>
											</div>
										</div>
									@endforeach
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-md-6">
						<div class="section3125 mt-50">
							<h4 class="item_title">Latest Course</h4>
							<div class="la5lo1">
								<div class="owl-carousel courses_performance owl-theme">
									@foreach($latest_courses as $course)
										<div class="item">
											<div class="fcrse_1">
												<a href="{{ route('course.show', $course->id) }}" class="fcrse_img">
													<img src="{{ asset('courseThumbnail/' . $course->thumbnail_url ?? 'images/default-course.jpg') }}"
														alt="{{ $course->title }}">
													<div class="course-overlay" style="width:100%"></div>
												</a>
												<div class="fcrse_content">
													<div class="vdtodt">
														<span class="vdt14">
															{{ $course->created_at ? \Carbon\Carbon::parse($course->created_at)->diffForHumans() : 'Not Published' }}
														</span>
													</div>
													<a href="{{ route('course.show', $course->id) }}"
														class="crsedt145">{{ $course->title }}</a>
													<p class="course-description">
														{!! Str::limit($course->course_description, 100) !!}
													</p>


													<div class="allvperf">
														<div class="crse-perf-left">Price</div>
														<div class="crse-perf-right">
															@if($course->discount)
																<del>₹{{ number_format($course->price, 2) }}</del>
																₹{{ number_format($course->price - $course->discount, 2) }}
															@else
																₹{{ number_format($course->price, 2) }}
															@endif
														</div>
													</div>

													<div class="allvperf">
														<div class="crse-perf-left">Category</div>
														<div class="crse-perf-right">{{ $course->category->name ?? 'N/A' }}
														</div>
													</div>

													<div class="allvperf">
														<div class="crse-perf-left">Subcategory</div>
														<div class="crse-perf-right">{{ $course->subcategory->name ?? 'N/A' }}
														</div>
													</div>

													<div class="allvperf">
														<div class="crse-perf-left">Course Level</div>
														<div class="crse-perf-right">{{ $course->course_level }}</div>
													</div>

													<div class="auth1lnkprce">
														<a href="#" class="cr1fot50">See Reviews
															({{ $course->reviews_count ?? 0 }})</a>
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
						<div class="container mt-5">
							<h2 class="fw-bold">Course Reviews</h2>
							<div style="max-height: 620px; overflow-y: auto; padding-right: 10px">
								@if($courses->isEmpty())
									<div class="alert alert-info text-center">
										No reviews available for any course.
									</div>
								@else
									@foreach($courses as $course)
										<div class="mb-4">
											<h3 class="fw-bold text-primary">{{ $course->title }}</h3> <!-- Course Name -->

											@foreach($course->review as $review)
												<div class="mb-3 shadow-sm border-0 p-3">
													{{-- User Info --}}
													<div class="d-flex align-items-center">
														<div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center"
															style="width: 40px; height: 40px; font-size: 18px;">
															{{ strtoupper(substr(optional($review->user)->username ?? 'A', 0, 1)) }}
														</div>
														<div class="ms-3">
															<h6 class="fw-bold mb-0">
																{{ optional($review->user)->username ?? 'Anonymous' }}
															</h6>
															<small class="text-muted">
																{{ $review->created_at->diffForHumans() }}
															</small>
														</div>
													</div>

													{{-- Rating & Review Content --}}
													<div class="mt-2">
														<span class="rating-stars text-warning">
															@for ($i = 1; $i <= 5; $i++)
																@if ($i <= $review->rating)
																	<span>&#9733;</span> <!-- Filled Star -->
																@else
																	<span>&#9734;</span> <!-- Empty Star -->
																@endif
															@endfor
														</span>
														<p class="mt-1 text-muted">
															"{{ $review->review }}"
														</p>
													</div>
												</div>
											@endforeach
										</div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="container mt-5">
					<h3 class="fw-bold">Course Purchases Trend</h3>
					<canvas id="coursePurchasesChart"></canvas>
				</div>
			</div>

			@include('learner.layout.footer')
		</div>
	</div>
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			var ctx = document.getElementById("coursePurchasesChart").getContext("2d");

			var chartData = {
				labels: @json($purchasesByMonth->pluck('month')),
				datasets: [{
					label: "Courses Purchased",
					data: @json($purchasesByMonth->pluck('total_purchases')),
					borderColor: "#3e95cd",
					backgroundColor: "rgba(62, 149, 205, 0.5)",
					fill: true,
					tension: 0.4
				}]
			};

			new Chart(ctx, {
				type: "line",
				data: chartData,
				options: {
					responsive: true,
					plugins: {
						legend: {
							display: true,
							position: "top"
						}
					},
					scales: {
						y: {
							beginAtZero: true,
							min: 0,
							max: 5, // Adjust based on data range
							ticks: {
								stepSize: 1,
								precision: 0
							},
							grid: {
								display: true,  // Enables grid lines
								color: "rgba(200, 200, 200, 0.2)", // Light gray grid
								drawBorder: false
							}
						},
						x: {
							grid: {
								display: true,  // Enables grid lines for X-axis
								color: "rgba(200, 200, 200, 0.2)",
								drawBorder: false
							}
						}
					}
				}
			});
		});

	</script>
@endsection