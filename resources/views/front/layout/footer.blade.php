<footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="{{ route('index') }}" class="logo d-flex align-items-center me-auto">
                    <img src="{{ asset('images/logo4.png')}}" alt="" style="max-height : 69px;">
                    {{-- <h1 class="sitename">CodePilot</h1> --}}
                </a><br>
                <p>
                    CodePilot is an online coding education platform that enables users to learn, code, and debug in
                    real-time while
                    watching instructional videos.
                </p>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('terms-of-service')}}">Terms of service</a></li>
                    <li><a href="{{ route('privacy-policy')}}">Privacy policy</a></li>


                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><a href="{{ route('about') }}">About us</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 footer-about">
                <h4>Address</h4>
                <div class="footer-contact pt-3">
                    <p>A108 Adam Street</p>
                    <p>New York, NY 535022</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>+91 88456 72389</span></p>
                    <p><strong>Email:</strong> <span>codepilot1213@gmail.com</span></p>
                </div>
                <div class="social-links d-flex mt-4">
                    <a href="javascript: void(0);"><i class="bi bi-twitter-x"></i></a>
                    <a href="javascript: void(0);"><i class="bi bi-facebook"></i></a>
                    <a href="javascript: void(0);"><i class="bi bi-instagram"></i></a>
                    <a href="javascript: void(0);"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© 2025 <span>Copyright</span> <strong class="px-1 sitename">CodePilot</strong> <span>All Rights
                Reserved</span>
        </p>
        
    </div>

</footer>