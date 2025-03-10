@extends('learner.layout.master')

@section('title')
    Cart
@endsection

@section('content_learner')
<div class="wrapper">		
    <div class="_215b15">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">						
                    <div class="title125">						
                        <div class="titleleft">					
                            <div class="ttl121">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('learner.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="title126">	
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb4d25">
       
        <div class="container">	
            @if($cartItems->isEmpty())
            <div class="no-categories-container text-center fade-in-animation footer">
                <i class="uil uil-shopping-cart-alt bounce-effect" 
                    style="font-size: 50px; color: #d1d1d1;"></i>
                <h3 class="mt-3 scale-in-text" style="color: #777;">Your Cart is Empty</h3>
                <p class="mb-4 fade-in-text" style="color: #aaa;">
                    Looks like you haven't added anything to your cart yet.
                </p>
            </div>
            
            @else
            <div class="row">
                <div class="col-lg-8">
                    
                        @foreach($cartItems as $cartItem)
                            <div class="fcrse_1 mt-2">
                                <a href="{{ route('course.show', $cartItem->course->id) }}" class="hf_img">
                                    <img class="cart_img" src="{{ asset('courseThumbnail/' . $cartItem->course->thumbnail_url) }}" alt="{{ $cartItem->course->title }}">
                                </a>
                                <div class="hs_content">
                                    <div class="eps_dots eps_dots10 more_dropdown">
                                        <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                                <i class='uil uil-times'></i>
                                            </button>
                                        </form>
                                        
                                    </div>
                                    <a href="" class="crse14s title900 pt-2">{{ $cartItem->course->title }}</a>
                                    <a href="#" class="crse-cate">{{ $cartItem->course->category->name ?? 'No Category' }}</a>
                                    <div class="auth1lnkprce">
                                        <p class="cr1fot">By <a href="#">{{ $cartItem->course->user->first_name }}</a></p>
                                        <div class="prce142">${{ $cartItem->course->price }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                   
                </div>

                <div class="col-lg-4">
                    <div class="membership_chk_bg rght1528">
                        <div class="checkout_title">
                            <h4>Total</h4>
                            <img src="{{ asset('images/line.svg') }}" alt="">
                        </div>
                        <div class="order_dt_section">
                            <div class="order_title">
                                <h4>Original Price</h4>
                                <div id="originalPrice" data-value="{{ $cartItems->sum('course.price') }}">
                                    ${{ $cartItems->sum('course.price') }}
                                </div>
                            </div>
                            <div class="order_title">
                                <h6>Discount Price</h6>
                                <div id="discountPrice" data-value="{{ $cartItems->sum('course.discount') }}">
                                    ${{ $cartItems->sum('course.discount') }}
                                </div>
                            </div>
                            <div class="order_title">
                                <h2>Total</h2>
                                <div id="totalPrice"></div> <!-- total price-->
                            </div>
                            <a href="{{ route('order.index') }}" class="chck-btn22">Checkout Now</a>
                        </div>
                    </div>
                </div>	
                 						
            </div>				
        </div>
        @endif
    </div>
    <script>

    document.addEventListener("DOMContentLoaded", function () {
        var originalPrice = parseFloat(document.getElementById("originalPrice").getAttribute("data-value")) || 0;
        var discountPrice = parseFloat(document.getElementById("discountPrice").getAttribute("data-value")) || 0;

        var totalPrice = originalPrice - discountPrice;

        document.getElementById("totalPrice").innerText = "$" + totalPrice.toFixed(2);
    });




    </script>
@endsection
