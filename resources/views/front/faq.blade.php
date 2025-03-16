@extends('front.layout.master')

@section('title')
    Courses
@endsection

@section('content')
    <style>
        /* Remove the custom styles for the accordion button */
        .accordion-button:focus {
            box-shadow: none;
            /* Keep removing the default focus box shadow */
        }

        /* Default styling for accordion button, no color change on click */
        .accordion-button.collapsing,
        .accordion-button:focus,
        .accordion-button:not(.collapsed) {
            background-color: transparent !important;
            /* Reset background color */
            color: #000;
            /* Keep text color black */
        }
    </style>

    <main class="main">
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>FAQ</h1>
                            <p class="mb-0">Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint
                                voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores.
                                Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li class="current">Courses</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="px-4">
                        <div class="row">
                            <div class="col-xxl-3 ms-auto">
                                <div class="mb-n5 pb-1 faq-img d-none d-xxl-block">
                                    <img src="{{ URL::asset('build/images/faq-img.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                    <!-- end card -->

                    <div class="row justify-content-evenly mb-4">
                        <div class="col-lg-12">
                            <div class="mt-3">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0 me-1">
                                        <i class="ri-question-line fs-24 align-middle text-success me-1"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fs-16 mb-0 fw-semibold">General Questions</h5>
                                    </div>
                                </div>

                                <div class="accordion accordion-border-box" id="genques-accordion">
                                    @foreach ($faqs as $index => $faq)
                                        <div class="accordion-item mb-3">
                                            <h2 class="accordion-header" id="genques-heading{{ $index }}">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#genques-collapse{{ $index }}" aria-expanded="false"
                                                    aria-controls="genques-collapse{{ $index }}">
                                                    {{ $faq->question }}
                                                </button>
                                            </h2>
                                            <div id="genques-collapse{{ $index }}" class="accordion-collapse collapse"
                                                aria-labelledby="genques-heading{{ $index }}"
                                                data-bs-parent="#genques-accordion">
                                                <pre><div class="accordion-body">{{ $faq->answer }}</div></pre>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!--end accordion-->
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </main>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>
@endsection