<div class="step-tab-panel step-tab-location" id="tab_step3">
    <div class="tab-from-content">
        <div class="title-icon">
            <h3 class="title"><i class="uil uil-image"></i>Media</h3>
        </div>
        <div class="lecture-video-dt mb-30">
            <span class="video-info">Intro Course overview provider type. (.mp4, YouTube, Vimeo etc.)</span>
            <form action="{{ route('video.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="video-category">
                    <label><input type="radio" name="colorRadio" value="mp4"
                            checked><span>HTML5(mp4)</span></label>
                    <label><input type="radio" name="colorRadio" value="url"><span>External URL</span></label>
                    <label><input type="radio" name="colorRadio" value="embedded"><span>embedded</span></label>
                    <div class="mp4 intro-box" style="display: block;">
                        <div class="row">
                            <div class="col-lg-5 col-md-12">
                                <div class="upload-file-dt mt-30">
                                    <div class="upload-btn">
                                        <input class="uploadBtn-main-input" type="file" id="IntroFile__input--source"
                                            name="introduction_video">
                                        <label for="IntroFile__input--source" title="Zip">Upload Video</label>
                                    </div>
                                    <span class="uploadBtn-main-file">File Format: .mp4</span>
                                    <span class="uploaded-id"></span>
                                </div>
                            </div>
                            <div class="thumbnail-into">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <label class="label25 text-left">Course thumbnail*</label>
                                        <div class="thumb-item">
                                            <img src="{{ asset('images/thumbnail-demo.jpg') }}" alt="">
                                            <div class="thumb-dt">
                                                <div class="upload-btn">
                                                    <input class="uploadBtn-main-input" type="file"
                                                        id="ThumbFile__input--source" name="introduction_thumbnail">
                                                    <label for="ThumbFile__input--source" title="Zip">Choose
                                                        Thumbnail</label>
                                                </div>
                                                <span class="uploadBtn-main-file">Size: 590x300 pixels. Supports:
                                                    jpg,jpeg, or png</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="url intro-box">
                        <div class="new-section">
                            <div class="ui search focus mt-30 lbel25">
                                <label>External URL*</label>
                                <div class="ui left icon input swdh19">
                                    <input class="prompt srch_explore" type="text" name="video_url"
                                        placeholder="External Video URL">
                                </div>
                                <label class="mt-4">video title*</label>
                                <div class="ui left icon input swdh19">
                                    <input class="prompt srch_explore" type="text" name="video_title"
                                        placeholder="Video title">
                                </div>
                                <label class="mt-4">video discription*</label>
                                <div class="ui form swdh30">
                                    <div class="field">
                                        <textarea rows="3" name="video_discription" placeholder="Video discription"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="upload-btn">
                                <input class="uploadBtn-main-input" type="file"
                                    id="video_ThumbFile__input--source" name="video_thumbnail">
                                <label for="video_ThumbFile__input--source" title="Zip">Choose
                                    Thumbnail</label>
                            </div>
                        </div>
                    </div>
                    <div class="embedded intro-box">
                        <div class="new-section">
                            <div class="ui search focus mt-30 lbel25">
                                <label>Code Title*</label>
                                <div class="ui left icon input swdh19">
                                    <input class="prompt srch_explore" type="text" name="code_title"
                                        placeholder="Code Title">
                                </div>
                                <label class="mt-3">Embedded Code*</label>
                                <div class="ui form swdh30">
                                    <div class="field">
                                        <textarea rows="3" name="code" placeholder="Place your embedded code here"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="main-btn mt-3" id="submitButton">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Video Preview
        document.getElementById("IntroFile__input--source").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const videoPreview = document.createElement("video");
                videoPreview.src = URL.createObjectURL(file);
                videoPreview.controls = true;
                videoPreview.style.maxWidth = "50%";
                videoPreview.style.height = "auto";

                const previewContainer = document.querySelector(".uploaded-id");
                previewContainer.innerHTML = "";
                previewContainer.appendChild(videoPreview);
            }
        });

        // Thumbnail Preview
        document.getElementById("ThumbFile__input--source").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector(".thumb-item img").src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
