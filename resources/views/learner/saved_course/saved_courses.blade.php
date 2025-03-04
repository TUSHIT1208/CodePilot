@extends('learner.layout.master')

@section('title')
    Saved Courses
@endsection
@section('content_learner')
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">			
            <div class="row">
                {{-- <div class="col-lg-3 col-md-4 ">
                    <div class="section3125 hstry142">
                        <div class="grp_titles pt-0">
                            <div class="ht_title">Saved Courses</div>
                            <a href="#" class="ht_clr">Remove All</a>
                        </div>
                        <div class="tb_145">
                            <div class="wtch125">
                                <span class="vdt14">4 Courses</span>
                            </div>
                            <a href="#" class="rmv-btn"><i class='uil uil-trash-alt'></i>Remove Saved Courses</a>
                        </div>						
                    </div>							
                </div>					 --}}
                <div class="col-md-12">
                    <div class="_14d25 mb-20">						
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mhs_title">Saved Courses</h4>
                                @if ($wishlistItem->isEmpty())
                                    <!-- No Wishlist Found Block -->
                                <div class="no-categories-container text-center fade-in-animation footer">
                                    <i class="uil uil-heart-sign bounce-effect" 
                                        style="font-size: 50px; color: #d1d1d1;"></i>
                                    <h3 class="mt-3 scale-in-text" style="color: #777;">No Wishlist Found</h3>
                                    <p class="mb-4 fade-in-text" style="color: #aaa;">
                                        It looks like you don't have any wishlist yet. 
                                    
                                    </p>
                                    
                                </div>
                                @else
                                    @foreach($wishlistItem as $item)
                                        <div class="fcrse_1 mt-3">
                                            <a href="{{ route('course.show', $item->course->id) }}" class="hf_img">
                                                <img src="{{ asset($item->course->courseattachment->thumbnail_url ?? 'images/default-thumbnail.jpg') }}" alt="{{ $item->course->title }}">
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
                                                    <form class="delete-wishlist" data-id="{{ $item->id }}" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" style="border: none; background: none; cursor: pointer;">
                                                            <i class='uil uil-times'></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="vdtodt">
                                                    <span class="vdt14">0 views</span>
                                                    <span class="vdt14">{{ $item->course->created_at->diffForHumans() }}</span>
                                                </div>
                                                <a href="course_detail_view.html" class="crse14s title900">{{ $item->course->title }}</a>
                                                <a href="#" class="crse-cate">{{ $item->course->category->name ?? 'Uncategorized' }}</a>
                                                <div class="auth1lnkprce">
                                                    <p class="cr1fot">By <a href="#">{{ $item->course->user->first_name ?? 'Unknown' }}</a></p>
                                                    <div class="prce142">${{ $item->course->price }}</div>
                                                    <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
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
    {{-- @include('admin.layouts.footer') --}}
    <script>
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
                    courseDiv.fadeOut(300, function() { $(this).remove(); }); // Smoothly remove the div
                },
                error: function(xhr) {
                    alert("Failed to delete item.");
                }
            });
        });
    </script>
@endsection