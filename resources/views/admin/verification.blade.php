@section('body')
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">			
            <div class="row">
                <div class="col-lg-12">	
                    <h2 class="st_title"><i class="uil uil-check-circle"></i> Verification</h2>
                </div>					
            </div>				
            <div class="row justify-content-xl-center justify-content-lg-center justify-content-md-center">					
                <div class="col-xl-6 col-lg-8 col-md-8">
                    <div class="verification_content">
                        <img src="images/verified-account.svg" alt="">
                        <h4>Verification with Edututs+</h4>
                        <p>Praesent sed sapien gravida, tempus nunc nec, euismod turpis. Mauris quis scelerisque arcu. Quisque et aliquet nisl, id placerat est. Morbi quis imperdiet nulla.</p>
                        <ul class="alert_verification">
                            <li>
                                <div class="required_group">
                                    <div class="edututs_required_img">
                                        <i class="uil uil-dashboard"></i>
                                    </div>
                                    <div class="edututs_required">
                                        <span><strong>14 subscribers</strong></span>
                                        <span>500 required</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="required_group">
                                    <div class="edututs_required_img">
                                        <i class="uil uil-dashboard"></i>
                                    </div>
                                    <div class="edututs_required">
                                        <span><strong>10 public watch hours</strong></span>
                                        <span>1,500 required</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="apply_verify_text"><i class="uil uil-check-circle"></i>We'll send you an email when you're eligible to apply</div>
                        <div class="verification_form">
                            <h4>Verify Your ID</h4>
                            <form>
                                <div class="ui search focus mt-50 lbel25">
                                    <label>Course Title*</label>
                                    <div class="ui left icon input swdh19">
                                        <input class="prompt srch_explore" type="text" placeholder="Full Name" name="fullname" maxlength="60" id="full[name]" value="">
                                    </div>
                                </div>
                                <div class="part_input mt-30 lbel25">
                                    <label>Upload Document*</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile06">
                                            <label class="custom-file-label" for="inputGroupFile06">No Choose</label>
                                        </div>
                                    </div>
                                </div>
                                <button class="verify_submit_btn" type="submit">Submit Now</button>
                            </form>
                        </div>
                    </div>						
                </div>
            </div>
        </div>
    </div>
@endsection