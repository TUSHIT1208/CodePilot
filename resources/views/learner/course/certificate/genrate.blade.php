@extends('learner.course.certificate.master')

@section('title')
    Result
@endsection

@section('content')
    <!-- Body Start -->

    <style>
        .loader_btn {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid #fff;
    border-top: 2px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-left: 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

    </style>
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
                                            <li class="breadcrumb-item active" aria-current="page"><a
                                                    href="{{ route('learner.dashboard') }}">Home</a>
                                            </li>


                                            <li class="breadcrumb-item active" aria-current="page">Result
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
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


                                            @if($p_marks < $test_result->overall_score)
                                                <h2>Congratulation! {{ Auth::user()->username }}</h2>
                                                <p>You are eligible for this certificate</p>
                                                <form action="{{ route('downloadCerty') }}" id="certDownloadForm">
                                                    @csrf
                                                    <button type="submit" class="download_btn" target="_blank" id="downloadBtn">
                                                        <span id="btnText">Download Certificate</span>
                                                        <span class="loader_btn" id="btnLoader" style="display: none;"></span>
                                                    </button>
                                                </form>
                                            @else
                                                BETTER LUCK NEXT TIME......
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
        
        @include('learner.layout.footer')
        {{-- <script>
             document.getElementById("certDownloadForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission

        let form = this;
        let btnLoader = document.getElementById("btnLoader");
        let downloadBtn = document.getElementById("downloadBtn");

        btnLoader.style.display = "inline-block"; // Show loader
        downloadBtn.disabled = true; // Disable button to prevent multiple clicks

        // Send AJAX request to download the certificate
        fetch(form.action, {
            method: "POST",
            body: new FormData(form),
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            }
        }).then(response => response.blob()) // Handle file download response
          .then(blob => {
              let url = window.URL.createObjectURL(blob);
              let a = document.createElement("a");
              a.href = url;
              a.download = "certificate.pdf"; // Adjust file name as needed
              document.body.appendChild(a);
              a.click();
              document.body.removeChild(a);
          }).catch(error => {
              alert("Error downloading certificate. Please try again.");
              console.error(error);
          }).finally(() => {
              btnLoader.style.display = "none"; // Hide loader
              downloadBtn.disabled = false; // Re-enable button
          });
    });
        </script> --}}
@endsection