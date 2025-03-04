@extends('learner.layout.master')

@section('title') purches Courses @endsection

@section('content_learner')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-8">
                        <div class="section3125 mt-3">
                            <h1>Courses</h1>
                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="_14d25">
                            <div class="row mt-5">
                                @if ($courses->isEmpty())
                                    <!-- No Records Found -->
                                    <div class="no-categories-container text-center fade-in-animation footer">
                                        <i class="uil uil-folder-minus bounce-effect"
                                            style="font-size: 50px; color: #d1d1d1;"></i>
                                        <h3 class="mt-3 scale-in-text" style="color: #777;">No Course Found</h3>
                                        <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                                            Course yet. Add one now to get started!</p>
                                    </div>
                                @else
                                    @foreach($courses as $course)
                                        <div class="col-lg-3 col-md-4">
                                            <div class="fcrse_1 mt-30">
                                                    <a href="{{ route('course.show', $course->id) }}" class="fcrse_img">
                                                    <img src="{{ isset($course->courseattachment->thumbnail_url) && $course->courseattachment->thumbnail_url != null ? asset('courseThumbnail/' . $course->courseattachment->thumbnail_url) : asset('images/courses/img-2.jpg') }}"
                                                        alt="Course Thumbnail">

                                                    <div class="course-overlay">
                                                        @if($course->is_active)
                                                            <div class="badge_seller">Active</div>
                                                        @else
                                                            <div class="badge_seller">InActive</div>
                                                        @endif
                                                        <div class="crse_reviews">
                                                            <i class="uil uil-star"></i> 5
                                                        </div>
                                                        <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                        <div class="crse_timer">{{ $course->duration ?? 'N/A' }} hours</div>
                                                    </div>
                                                </a>
                                                <div class="fcrse_content">
                                                    <div class="eps_dots more_dropdown">
                                                        <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                        <div class="dropdown-content">
                                                            <span><i class='uil uil-share-alt'></i>Share</span>
                                                            <form class="wishlistForm">
                                                                @csrf
                                                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                            <span class="wishlistButton"><i class="uil uil-heart"></i>Save</span>
                                                            </form>
                                                            
                                                        <span><i class="uil uil-windsock"></i>Report</span>
                                                        </div>
                                                    </div>
                                                    <div class="vdtodt">
                                                        <span class="vdt14">50 views</span>
                                                        <span class="vdt14">{{ $course->created_at->diffForHumans() }}</span>

                                                    </div>
                                                    <a href="{{ route('course.show', $course->id) }}"
                                                        class="crse14s">{{ $course->title }}</a>
                                                    <a href="#"
                                                        class="crse-cate">{{ $course->category->name ?? 'Uncategorized' }}</a>
                                                    <div class="auth1lnkprce">
                                                        <p class="cr1fot">By <a
                                                                href="#">{{ $course->user->first_name . ' ' . $course->user->last_name ?? 'unknown'}}</a>
                                                        </p>
                                                        <div class="prce142">${{ $course->price ?? 'Free' }}</div>
                                                        <form class="cartForm">
                                                            @csrf
                                                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                            <button type="submit" class="shrt-cart-btn" title="Add to Cart">
                                                                <i class="uil uil-shopping-cart-alt"></i>
                                                            </button>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="col-md-12">
                                    <div class="main-loader mt-50">
                                        <div class="spinner">
                                            <div class="bounce1"></div>
                                            <div class="bounce2"></div>
                                            <div class="bounce3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('learner.layout.footer')
    </div>
    <script>
        

        document.addEventListener("DOMContentLoaded", function() {
            let wishlistButtons = document.getElementsByClassName('wishlistButton');
            let wishlistForms = document.getElementsByClassName('wishlistForm');

            Array.from(wishlistButtons).forEach((button, index) => {
                button.addEventListener('click', function() {
                    let form = wishlistForms[index];
                    let formData = new FormData(form);
                    
                    fetch("{{ route('wishlist.store') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
                        }
                    })
                    .then(response => response.json().then(data => ({ status: response.status, body: data })))
                    .then(({ status, body }) => {
                        if (status === 201) {
                            toastr.success(body.message); // Show success message
                        } else if (status === 409) {
                            toastr.warning(body.message); // Show warning for duplicate entry
                        } else {
                            toastr.error("Something went wrong!");
                        }
                    })
                    .catch(() => {
                        toastr.error("Error adding to wishlist");
                    });
                });
            });


            // Handle Cart
            document.querySelectorAll('.cartForm').forEach((form, index) => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    let formData = new FormData(this);
                    let messageDiv = document.querySelectorAll('.cartMessage')[index];
        
                    fetch("{{ route('cart.store') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
                        }
                    })
                    .then(response => response.json().then(data => ({ status: response.status, body: data })))
                    .then(({ status, body }) => {
                        if (status === 201) {
                            toastr.success(body.message); // Show success message
                        } else if (status === 409) {
                            toastr.warning(body.message); // Show warning for duplicate entry
                        } else {
                            toastr.error("Something went wrong!");
                        }
                    })
                    .catch(() => {
                        toastr.error("Error adding to cart");
                    });
                });
            });
        });
        </script>
        
@endsection