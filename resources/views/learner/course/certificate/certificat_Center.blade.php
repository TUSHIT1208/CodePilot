@extends('learner.course.certificate.master')

@section('title')
    Certificate Center
@endsection

@section('content')
    <!-- Body Start -->
    <div class="wrapper _bg4586 _new89">
        <div class="_215certibg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cert_banner_text">
                            <h1>Certification Center</h1>
                            <p>For Students and Instructors</p>
                            <ul class="certi_icons">
                                <li><a href="#" class="edttslogo"><img src="{{ asset('images/logo1.svg') }} " alt=""></a></li>
                                <li>
                                <div class="edttsplus">
                                    <img src="{{ asset('images/plus.svg') }}" alt="">
                                  </div>
                                  
                                </li>
                                <li><a href="#" class="edttslogo1"><img src="{{ asset('images/certicon.svg') }}"
                                            alt=""></a></li>
                            </ul>
                            <a href="{{ route('learner.fill.certificate') }}"><button class="certi-btn">Start
                                    Certification</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="_485td5">
            <div class="container">
                <div class="row justify-content-lg-center justify-content-md-center">
                    <div class="col-lg-12">
                        <div class="titleceti89">
                            <h2>Who Can Get Benefit From This?</h2>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-6">
                        <div class="who_get">
                            <div class="who_img">
                                <img src="{{ asset('images/student.svg') }}" alt="">
                            </div>
                            <h4>Students</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-6">
                        <div class="who_get">
                            <div class="who_img">
                                <img src="{{ asset('images/instructor.svg') }}" alt="">
                            </div>
                            <h4>Instructor</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="_215td5">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-lg-12">
                        <div class="title589">
                            <h2>What Will You Get?</h2>
                            <p>Code pilot, which confirms your skills and knowledge of Certification</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="knowledge_dts">
                            <p>Morbi eget elit eget turpis varius mollis eget vel massa. Donec porttitor, sapien eget
                                commodo vulputate, erat felis aliquam dolor, non condimentum libero dolor vel ipsum. Sed
                                porttitor nisi eget nulla ullamcorper eleifend. Fusce tristique sapien nisi, vel feugiat
                                neque luctus sit amet. Quisque consequat quis turpis in mattis. Maecenas eget mollis nisl.
                                Cras porta dapibus est, quis malesuada ex iaculis at. Vestibulum egestas tortor in urna
                                tempor, in fermentum lectus bibendum. In leo leo, bibendum at pharetra at, tincidunt in
                                nulla. In vel malesuada nulla, sed tincidunt neque. Phasellus at massa vel sem aliquet
                                sodales non in magna. Ut tempus ipsum sagittis neque cursus euismod. Vivamus luctus
                                elementum tortor, ac aliquet dolor vehicula et. Nulla vehicula pharetra lacus ornare
                                gravida. Vivamus mollis ullamcorper dui quis gravida. Aenean pulvinar pulvinar arcu a
                                suscipit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('learner.layout.footer')
@endsection