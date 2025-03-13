@extends('learner.course.certificate.master')

@section('title')
    Result
@endsection

@section('content')
    <!-- Body Start -->
    <!-- Body Start -->
    <div class="wrapper _bg4586 _new89">
        <div class="_215b15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title125">
                            <div class="titleleft">
                                <div class="ttl121">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                            <li class="breadcrumb-item"><a href="certification_center.html">Certification
                                                    Center</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Result</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                            <div class="titleright">
                                <a href="certification_center.html" class="blog_link"><i
                                        class="uil uil-angle-double-left"></i>Back to Certification Center</a>
                            </div>
                        </div>
                        <div class="title126">
                            <h2>Result</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="faq1256">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-6">
                        <div class="certi_form rght1528">
                            @if(isset($test_result))
                                    <div class="test_result_bg">
                                        <ul class="test_result_left">
                                            <li>
                                                <div class="result_dt">
                                                    <i class="uil uil-check right_ans"></i>
                                                    <p>Right<span>{{$test_result->total_correct_answer}}</span></p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="result_dt">
                                                    <i class="uil uil-times wrong_ans"></i>
                                                    <p>Wrong<span>({{$test_result->total_wrong_answer}})</span></p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="result_dt">
                                                    <h4>{{$test_result->total_attempted	}}</h4>
                                                    <p>{{$test_result->total_attempted	}}</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="result_content">
                                            <h2>Congratulation! Joginder</h2>
                                            <p>You are eligible for this certificate</p>

                                            <form action="/cirty">
                                                @csrf
                                                <button type="submit" class="download_btn" target="_blank">Download
                                                    Certificate</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>

        @include('frontside.layouts.footer')
@endsection