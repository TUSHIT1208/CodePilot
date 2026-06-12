@extends('front.layout.master')

@section('title')
Terms of service
@endsection

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Terms of service<br></h1>
                            <p class="mb-0">Welcome to CodePilot! These Terms of Service govern your use of our platform, including courses, services, and content. 
                                By accessing or using CodePilot, you agree to these terms.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li class="current">Terms of Service<br></li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->
    </main>
    <section class="terms-content section">
        <div class="" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                {{-- <section class="terms-content"> --}}
                <h2>1. Introduction</h2>
                <p>CodePilot is an interactive online learning platform that offers coding courses, real-time debugging tools, 
                    and structured learning paths for users worldwide. These Terms apply to all users, including learners, instructors, and administrators.</p>

                <!-- User Eligibility -->
                <h2>2. User Eligibility</h2>
                <p>By using CodePilot, you confirm that you:</p>
                <ul>
                    <li><i class="bi bi-check-circle"></i> Are at least 18 years old, or have parental/guardian consent if under 18.</li>
                    <li><i class="bi bi-check-circle"></i> Have not been restricted from using our services due to past violations.</li>
                    <li><i class="bi bi-check-circle"></i> Agree to comply with all applicable laws and regulations.</li>
                </ul>

                <!-- Account Registration -->
                <h2>3. Account Registration</h2>
                <p>To access certain features, you must create an account. You agree to:</p>
                <ul>
                    <li><i class="bi bi-check-circle"></i> Provide accurate and up-to-date information.</li>
                    <li><i class="bi bi-check-circle"></i> Maintain the confidentiality of your login credentials.</li>
                    <li><i class="bi bi-check-circle"></i> Be responsible for all activity under your account.</li>
                </ul>

                <!-- Course Enrollment & Payments -->
                <h2>4. Course Enrollment & Payments</h2>
                <p>When you enroll in a course:</p>
                <ul>
                    <li><i class="bi bi-check-circle"></i> You receive a **non-transferable, limited license** to access the course.</li>
                    <li><i class="bi bi-check-circle"></i>Payments are processed securely via **Razorpay**.</li>
                    <li><i class="bi bi-check-circle"></i>Courses are **non-refundable** unless stated otherwise.</li>
                </ul>

                <!-- Instructor Responsibilities -->
                <h2>5. Instructor Responsibilities</h2>
                <p>Instructors must:</p>
                <ul>
                    <li><i class="bi bi-check-circle"></i> Provide accurate course content and descriptions.</li>
                    <li><i class="bi bi-check-circle"></i> Ensure that content follows intellectual property laws.</li>
                    <li><i class="bi bi-check-circle"></i> Engage with learners in a professional manner.</li>
                </ul>

                <!-- Content Ownership -->
                <h2>6. Content Ownership & Usage</h2>
                <p>By submitting content to CodePilot, you grant us a **license to use and distribute** it for educational purposes. 
                    You retain ownership, but CodePilot may showcase your content for promotional purposes.</p>

                <!-- Prohibited Conduct -->
                <h2>7. Prohibited Conduct</h2>
                <p>Users may not:</p>
                <ul>
                    <li><i class="bi bi-check-circle"></i> Engage in plagiarism, cheating, or unethical practices.</li>
                    <li><i class="bi bi-check-circle"></i> Share or sell CodePilot content without authorization.</li>
                    <li><i class="bi bi-check-circle"></i> Use the platform for unlawful or harmful activities.</li>
                </ul>

                <!-- CodePilot's Rights -->
                <h2>8. CodePilot's Rights</h2>
                <p>We reserve the right to:</p>
                <ul>
                    <li><i class="bi bi-check-circle"></i> Modify, suspend, or terminate any user account or course.</li>
                    <li><i class="bi bi-check-circle"></i> Remove content that violates these Terms.</li>
                    <li><i class="bi bi-check-circle"></i> Monitor platform activity for compliance and security.</li>
                </ul>

                <!-- Limitations of Liability -->
                <h2>9. Limitations of Liability</h2>
                <p>CodePilot is not responsible for:</p>
                <ul>
                    <li><i class="bi bi-check-circle"></i> Technical issues, data loss, or third-party actions.</li>
                    <li><i class="bi bi-check-circle"></i> Errors in course materials provided by instructors.</li>
                    <li><i class="bi bi-check-circle"></i> Any indirect, incidental, or consequential damages.</li>
                </ul>

                <!-- Dispute Resolution -->
                <h2>10. Dispute Resolution</h2>
                <p>In case of disputes:</p>
                <ul>
                    <li><i class="bi bi-check-circle"></i> Users agree to first attempt resolution through customer support.</li>
                    <li><i class="bi bi-check-circle"></i> If unresolved, disputes will be handled through arbitration under **Indian law**.</li>
                </ul>

                <!-- Updates to Terms -->
                <h2>11. Updates to These Terms</h2>
                <p>We may update these Terms periodically. Continued use of CodePilot after modifications constitutes acceptance of the updated Terms.</p>

                <!-- Contact Information -->
                <h2>12. Contact Us</h2>
                <p>If you have any questions or concerns, please contact us at: <a href="mailto:support@CodePilot.com">support@CodePilot.com</a></p>
            </div>
        </div>
    </section>
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>
@endsection 