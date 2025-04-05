@extends('learner.layout.master')

@section('title')
Saved Courses
@endsection
@section('content_learner')
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section3125 mt-3">
                        <h2 class="st_title"><i class="uil uil-heart-alt"></i> Saved Courses</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="_14d25 mb-20">
                        <div class="row">
                            <div class="col-md-12">
                                @if ($wishlistItem->isEmpty())
                                <!-- No Wishlist Found Block -->
                                <div class="no-categories-container text-center fade-in-animation footer mt-5">
                                    <i class="uil uil-heart-sign bounce-effect"
                                        style="font-size: 50px; color: #d1d1d1;"></i>
                                    <h3 class="mt-3 scale-in-text" style="color: #777;">No Wishlist Found</h3>
                                    <p class="mb-4 fade-in-text" style="color: #aaa;">
                                        It looks like you don't have any wishlist yet.
                                    </p>
                                </div>
                                @else
                                @foreach ($wishlistItem as $item)
                                <div class="fcrse_1 mt-3">
                                    <a href="{{ route('course.show', $item->course->id) }}" class="hf_img">
                                        <img src="{{ asset('courseThumbnail/' . $item->course->thumbnail_url ?? 'images/default-thumbnail.jpg') }}"
                                            alt="{{ $item->course->title }}">
                                        <div class="course-overlay">
                                            {{-- <div class="badge_seller">Bestseller</div>
                                            <div class="crse_reviews">
                                                <i class="uil uil-star"></i>4.5
                                            </div> --}}
                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                            <div class="crse_timer">
                                                {{ $item->course->duration ?? 'N/A' }} hours
                                            </div>
                                        </div>
                                    </a>
                                    <div class="hs_content">
                                        <div class="eps_dots eps_dots10 more_dropdown">
                                            <form class="delete-wishlist" data-id="{{ $item->id }}"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    style="border: none; background: none; cursor: pointer;">
                                                    <i class='uil uil-times'></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="vdtodt">
                                            <span class="vdt14">0 views</span>
                                            <span class="vdt14">{{ $item->course->created_at->diffForHumans() }}</span>
                                        </div>
                                        <a href="course_detail_view.html" class="crse14s title900">{{
                                            $item->course->title }}</a>
                                        <a href="#" class="crse-cate">{{ $item->course->description ?? 'Uncategorized'
                                            }}</a>
                                        <div class="auth1lnkprce">
                                            <p class="cr1fot">By <a href="#">{{ $item->course->user->first_name ??
                                                    'Unknown' }} {{ $item->course->user->last_name ?? '' }}</a></p>
                                            <div class="prce142">
                                                @if ($item->course->price == 0)
                                                Free
                                                @else
                                                @if ($item->course->discount > 0)
                                                <s style="text-decoration-color: red; font-size: 0.9em;">₹{{
                                                    $item->course->price }}</s>
                                                @endif
                                                ₹{{ $item->course->price - ($item->course->discount ?? 0) }}
                                                @endif
                                            </div>
                                            @if ($item->course->price != 0)
                                            <form class="cartForm">
                                                @csrf
                                                <input type="hidden" name="course_id" value="{{ $item->course->id }}">
                                                <button type="submit" class="shrt-cart-btn" title="Add to Cart">
                                                    <i class="uil uil-shopping-cart-alt"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
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
                    .then(response => response.json().then(data => ({
                        status: response.status,
                        body: data
                    })))
                    .then(({
                        status,
                        body
                    }) => {
                        if (status === 201) {
                            toastr.options = {
                                closeButton: true,
                                debug: false,
                                newestOnTop: true,
                                progressBar: true,
                                positionClass: "toast-top-right",
                                preventDuplicates: true,
                                timeOut: 5000,
                                extendedTimeOut: 1000,
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                onShown: function() {
                                    $(".toast-success").css({
                                        'background-color': '#28a745', // Green for success
                                        'opacity': '1' // Adjust opacity
                                    });
                                }
                            };
                            toastr.success(body.message); // Show success message
                        } else if (status === 409) {
                            toastr.options = {
                                closeButton: true,
                                debug: false,
                                newestOnTop: true,
                                progressBar: true,
                                positionClass: "toast-top-right",
                                preventDuplicates: true,
                                timeOut: 5000,
                                extendedTimeOut: 1000,
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                onShown: function() {
                                    $(".toast-warning").css({
                                        'background-color': '#ffc107', // Green for success
                                        'opacity': '1' // Adjust opacity
                                    });
                                }
                            };
                            toastr.warning(body.message); // Show warning for duplicate entry
                        } else {
                            toastr.options = {
                                closeButton: true,
                                debug: false,
                                newestOnTop: true,
                                progressBar: true,
                                positionClass: "toast-top-right",
                                preventDuplicates: true,
                                timeOut: 5000,
                                extendedTimeOut: 1000,
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                onShown: function() {
                                    $(".toast-error").css({
                                        'background-color': '#dc3545', // Green for success
                                        'opacity': '1' // Adjust opacity
                                    });
                                }
                            };
                            toastr.error("Something went wrong!");
                        }
                    })
                    .catch(() => {
                        toastr.options = {
                            closeButton: true,
                            debug: false,
                            newestOnTop: true,
                            progressBar: true,
                            positionClass: "toast-top-right",
                            preventDuplicates: true,
                            timeOut: 5000,
                            extendedTimeOut: 1000,
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut",
                            onShown: function() {
                                $(".toast-error").css({
                                    'background-color': '#dc3545', // Green for success
                                    'opacity': '1' // Adjust opacity
                                });
                            }
                        };
                        toastr.error("Error adding to cart");
                    });
            });
        });
        $(document).on('click', '.delete-wishlist button', function(e) {
            e.preventDefault();

            let form = $(this).closest('form');
            let itemId = form.data('id');
            let courseDiv = form.closest('.fcrse_1'); // Select the parent container

            $.ajax({
                url: "{{ route('wishlist.destroy', '') }}/" + itemId,
                type: "POST",
                data: {
                    _method: "DELETE",
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    courseDiv.fadeOut(300, function() {
                        $(this).remove();
                    }); // Smoothly remove the div
                },
                error: function(xhr) {
                    alert("Failed to delete item.");
                }
            });
        });
</script>
@endsection