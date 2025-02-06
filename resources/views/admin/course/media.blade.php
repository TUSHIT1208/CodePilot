<div class="step-tab-panel step-tab-location" id="tab_step3">
    <div class="tab-from-content">
        <div class="title-icon">
            <h3 class="title"><i class="uil uil-image"></i>Media</h3>
        </div>
        <div class="lecture-video-dt mb-30">
            <span class="video-info">Intro Course overview provider type. (.mp4, YouTube, Vimeo etc.)</span>
            <div class="video-category">
                <label ><input type="radio" name="colorRadio" value="mp4" checked><span>HTML5(mp4)</span></label>
                <label><input type="radio" name="colorRadio" value="url"><span>External URL</span></label>
                <label><input type="radio" name="colorRadio" value="youtube"><span>YouTube</span></label>
                <label><input type="radio" name="colorRadio" value="vimeo"><span>Vimeo</span></label>
                <label><input type="radio" name="colorRadio" value="embedded"><span>embedded</span></label>
                <div class="mp4 intro-box" style="display: block;">
                    <div class="row">
                        <div class="col-lg-5 col-md-12">
                            <div class="upload-file-dt mt-30">
                                <div class="upload-btn">													
                                    <input class="uploadBtn-main-input" type="file" id="IntroFile__input--source">
                                    <label for="IntroFile__input--source" title="Zip">Upload Video</label>
                                </div>
                                <span class="uploadBtn-main-file">File Format: .mp4</span>
                                <span class="uploaded-id"></span>
                            </div>
                        </div>														
                    </div>
                </div>
                <div class="url intro-box">
                    <div class="new-section">
                        <div class="ui search focus mt-30 lbel25">
                            <label>External URL*</label>
                            <div class="ui left icon input swdh19">
                                <input class="prompt srch_explore" type="text" placeholder="External Video URL" name="" id="" value="">															
                            </div>
                        </div>
                    </div>														
                </div>
                <div class="youtube intro-box">
                    <div class="new-section">
                        <div class="ui search focus mt-30 lbel25">
                            <label>Youtube URL*</label>
                            <div class="ui left icon input swdh19">
                                <input class="prompt srch_explore" type="text" placeholder="Youtube Video URL" name="" id="" value="">															
                            </div>
                        </div>
                    </div>														
                </div>
                <div class="vimeo intro-box">
                    <div class="new-section">
                        <div class="ui search focus mt-30 lbel25">
                            <label>Vimeo URL*</label>
                            <div class="ui left icon input swdh19">
                                <input class="prompt srch_explore" type="text" placeholder="Vimeo Video URL" name="" id="" value="">															
                            </div>
                        </div>
                    </div>														
                </div>
                <div class="embedded intro-box">
                    <div class="new-section">
                        <div class="ui search focus mt-30 lbel25">
                            <label>Embedded Code*</label>
                            <div class="ui form swdh30">
                                <div class="field">
                                    <textarea rows="3" name="" id="" placeholder="Place your embedded code here"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>														
                </div>
            </div>
        </div>
        <div class="thumbnail-into">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <label class="label25 text-left">Course thumbnail*</label>
                    <div class="thumb-item">
                        <img src="images/thumbnail-demo.jpg" alt="">
                        <div class="thumb-dt">													
                            <div class="upload-btn">													
                                <input class="uploadBtn-main-input" type="file" id="ThumbFile__input--source">
                                <label for="ThumbFile__input--source" title="Zip">Choose Thumbnail</label>
                            </div>
                            <span class="uploadBtn-main-file">Size: 590x300 pixels. Supports: jpg,jpeg, or png</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="step-footer step-tab-pager">
    <button data-direction="prev" class="btn btn-default steps_btn">PREVIOUS</button>
    <button data-direction="next" class="btn btn-default steps_btn">Next</button>
    {{-- <button data-direction="finish" class="btn btn-default steps_btn">Submit for Review</button> --}}
</div>