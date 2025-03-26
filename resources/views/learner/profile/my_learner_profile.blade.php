@extends('learner.layout.master')

@section('title') Learner Profile @endsection

@section('content_learner')
<!-- Body Start -->
<div class="wrapper _bg4586">
    <div class="_216b01">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <div class="section3125 rpt145">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="#" class="_216b22">
                                    <span><i class="uil uil-cog"></i></span>Setting
                                </a>
                                <form action="{{ route('upload.profile.image') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="dp_dt150">
                                        <div class="img148">
                                            @if(!empty(auth()->user()->profile_picture_url))
                                                <img src="{{ asset(Auth::user()->profile_picture_url) }}" alt="Profile Image" id="profileImage" style="width:200px; height:200px; object-fit: cover;">
                                            @else
                                                <img src="" alt="Default Profile" id="profileImage" style="display:none;">
                                                <h1 class="profile-default" id="profileInitial">{{ substr(Auth::user()->username, 0, 1) }}</h1>
                                            @endif
                                        </div>
                                        <div class="prfledt1">
                                            <h2>{{ Auth::user()->username }}</h2>
                                            <i id="editProfileBtn_learner" class="uil uil-camera"></i>
                                            <input type="file" id="fileInput" name="profile_image" style="display:none;" onchange="previewImage(event)">
                                            <button id="saveProfileBtn" class="upload_btn" style="display:none;">Save Profile</button>
                                        </div>
                                    </div>
                                </form> 
                            </div>
                            <div class="col-lg-6">
                                <a href="{{ route('learner.setting') }} " class="_216b12">
                                    <span><i class="uil uil-cog"></i></span>Setting
                                </a>
                                <div class="rgt-145">
                                    
                                </div>
                                <ul class="_bty149">                                    
                                    <li><a href="{{ route('learner.setting') }}"><button class="msg125 btn500">Edit</button></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="_215b15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="course_tabs">
                        <nav>
                            <div class="nav nav-tabs tab_crse" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-about-tab" data-bs-toggle="tab"
                                    href="#nav-about" role="tab" aria-selected="true">About</a>
                                <a class="nav-item nav-link" id="nav-courses-tab" data-bs-toggle="tab"
                                    href="#nav-courses" role="tab" aria-selected="false">Courses</a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="_215b17">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="course_tab_content">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-about" role="tabpanel">
                                <div class="_htg451">
                                    <div class="_htg452">
                                        <h3>About Me</h3>
                                        <p>{{ $leanerData->learnerprofile->short_description ?: 'No Information'}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-courses" role="tabpanel">
                                <div class="crse_content">
                                    <h3>My courses</h3>
                                    <div class="_14d25">
                                        <div class="row mt-5">
                                            @if ($mycourse  ->isEmpty())
                                                <!-- No Records Found -->
                                                <div class="no-categories-container text-center fade-in-animation footer">
                                                    <i class="uil uil-folder-minus bounce-effect"
                                                        style="font-size: 50px; color: #d1d1d1;"></i>
                                                    <h3 class="mt-3 scale-in-text" style="color: #777;">No Course Found</h3>
                                                    <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have any
                                                        Course yet. Add one now to get started!</p>
                                                </div>
                                            @else
                                                @foreach ($mycourse as $course)
                                                @php
                                                    $transaction = $paymentTransactions->firstWhere('order.order_items.0.course.id', $course->course->id);
                                                @endphp
                                                    <div class="col-lg-3 col-md-4">
                                                        <div class="fcrse_1 mt-30">
                                                            <a href="{{ route('course.show', $course->course->id) }}" class="fcrse_img">
                                                                <img src="{{ $course->course->thumbnail_url ? asset('courseThumbnail/' . $course->course->thumbnail_url) : asset('images/courses/img-2.jpg') }}"
                                                                    alt="Course Thumbnail">    
            
                                                                <div class="course-overlay" style="position: absolute;width : 100%;"> 
                                                                    @if ($course->course->is_active)
                                                                        <div class="badge_seller">Active</div>
                                                                    @else
                                                                        <div class="badge_seller">InActive</div>
                                                                    @endif
                                                                    <div class="crse_reviews">
                                                                        <i class="uil uil-star"></i> 5
                                                                    </div>
                                                                    <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                                    <div class="crse_timer">{{ $course->course->duration ?? 'N/A' }} hours</div>
                                                                </div>
                                                            </a>
                                                            <div class="fcrse_content">
                                                                <div class="eps_dots more_dropdown">
                                                                    <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                                    <div class="dropdown-content text-dark p-1">
                                                                        
                                                                    @if ($transaction)
                                                                         
                                                                             <a href="{{ route('invoice.view', $transaction->id) }}"  title="View Invoice">
                                                                                 <i class="uil uil-eye"></i> Invoice 
                                                                             </a>
                                                                             <br>
                                                                             <a href="{{ route('invoice.download', $transaction->id) }}" title="Download Invoice">
                                                                                 <i class="uil uil-download-alt"></i> Invoice
                                                                             </a>
                                                                         
                                                                     @endif
                                                                        {{-- <span><i class="uil uil-eye"></i>View Invoice</span>
                                                                        <span><i class='uil uil-download-alt'></i>Download Invoice</span>             --}}
                                                                    </div>
                                                                </div>
                                                                <div class="vdtodt">
                                                                    <span class="vdt14">50 views</span>
                                                                    <span
                                                                        class="vdt14">{{ $course->course->created_at->diffForHumans() }}</span>
            
                                                                </div>
                                                                <a href="{{ route('course.show', $course->course->id) }}"
                                                                    class="crse14s">{{ $course->course->title }}</a>
                                                                <a href="#"
                                                                    class="crse-cate">{{ $course->course->category->name ?? 'Uncategorized' }}</a>
                                                                <div class="auth1lnkprce">
                                                                    <p>By <a
                                                                            href="javascript:;">{{ $course->course->user->first_name . ' ' . $course->course->user->last_name ?? 'unknown' }}</a>
                                                                    </p>
                                                                    <div class="prce142">₹{{ $course->course->price ?? 'Free' }}</div>
            
                                                                </div>
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
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
         // When the "Edit Profile" button is clicked, trigger file input
         document.getElementById('editProfileBtn').addEventListener('click', function () {
             console.log("Edit Profile button clicked!");
             document.getElementById('fileInput').click(); // Open file picker dialog
         });
 
         // Function to handle file input change event
         function previewImage(event) {
             const file = event.target.files[0]; // Get selected file
             const saveButton = document.getElementById('saveProfileBtn');
             const profileImage = document.getElementById('profileImage');
             
             if (file) {
                 console.log("Selected file:", file);
 
                 const reader = new FileReader(); // Create a FileReader instance
 
                 // Once the file is read, update the profile image preview
                 reader.onload = function (e) {
                     console.log("File loaded successfully:", e.target.result); // Log base64 string
                     profileImage.src = e.target.result; // Set image source
                     saveButton.style.display = 'inline-block'; // Show the save profile button
                 };
 
                 // Read the file as a data URL (this will create the preview)
                 reader.readAsDataURL(file);
             } else {
                 console.log("No file selected.");
                 saveButton.style.display = 'none'; // Hide the save profile button if no image is selected
 
                 // Optionally reset the image to the default avatar
                 profileImage.src = 'path_to_default_avatar.jpg'; // Replace with your default avatar path
             }
         }
 
         // Attach the previewImage function to the file input's change event
         document.getElementById('fileInput').addEventListener('change', previewImage);
     });
     </script>
@endsection