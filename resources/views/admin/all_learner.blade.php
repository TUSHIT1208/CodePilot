@extends('admin.layouts.header')
@section('body')
<!-- Body Start -->
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-8">
                    <div class="section3125">
                        <div class="explore_search">
                            <div class="ui search focus">
                                <div class="ui left icon input swdh11">
                                    <input class="prompt srch_explore" type="text" placeholder="Search Tutors...">
                                    <i class="uil uil-search-alt icon icon2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="_14d25">
                        <div class="row">
                            @foreach ($learner as $user)
                                <div class="col-xl-3 col-lg-4 col-md-6">
                                    <div class="fcrse_1 mt-30">
                                        <div class="tutor_img text-center">
                                            <!-- Display user profile picture -->
                                            <a href="instructor_profile_view.html">
                                                <img src="{{ $user->profile_picture_url ? asset('images/' . $user->profile_picture_url) : asset('images/default-profile.png') }}"
                                                    alt="{{ $user->username }}" class="rounded-circle"
                                                    style="width: 120px; height: 120px; object-fit: cover;">
                                            </a>
                                        </div>
                                        <div class="tutor_content_dt">
                                            <div class="tutor150">
                                                <a href="instructor_profile_view.html"
                                                    class="tutor_name">{{$user->username}}</a>
                                                <div class="mef78" title="Verify">
                                                    <i class="uil uil-check-circle"></i>
                                                </div>
                                            </div>
                                            <div class="tutor_cate">{{$user->email}}</div>
                                            <ul class="tutor_social_links">
                                                <li><a href="#" class="tw"><i class="uil uil-edit"></i></a></li>
                                                <li><a href="#" class="yu"><i class="uil uil-trash-alt"></i></a></li>

                                            </ul>



                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Pagination Loader -->
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
<!-- Body End -->
<script src="js/vertical-responsive-menu.min.js"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/OwlCarousel/owl.carousel.js"></script>
<script src="vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js"></script>
<script src="vendor/semantic/semantic.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/night-mode.js"></script>
@endsection