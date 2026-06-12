@extends('front.layout.master')

@section('title')
Privacy Policy
@endsection

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Privacy Policy<br></h1>
                            <p class="mb-0">At CodePilot, we value your privacy and are committed to safeguarding your
                                personal information. This Privacy Policy outlines how we collect, use, and protect
                                your data.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li class="current">Privacy Policy<br></li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

                <!-- Privacy Policy Content -->
                <section class="privacy-content section">
                    <div class="" data-aos="fade-up" data-aos-delay="100">
                        <div class="row">
                            <div class="col-lg-10 mx-auto">
                                <h2>1. Introduction</h2>
                                <p>CodePilot is an online learning platform that provides courses and learning materials. We
                                    collect and process user data to enhance our services and provide a better learning
                                    experience.</p>
        
                                <h2>2. Information We Collect</h2>
                                <p>We collect different types of information depending on how you interact with our platform.</p>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Type of Data</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Personal Information</strong></td>
                                            <td>Includes your name, email, phone number, and billing information.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Account Data</strong></td>
                                            <td>Your login credentials, preferences, and activity history.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Usage Data</strong></td>
                                            <td>Information about how you use the platform, including course enrollments and progress.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Payment Information</strong></td>
                                            <td>Processed securely via third-party providers; we do not store credit card details.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Cookies & Tracking</strong></td>
                                            <td>We use cookies to personalize content, analyze trends, and improve user experience.</td>
                                        </tr>
                                    </tbody>
                                </table>
        
                                <h2>3. How We Use Your Information</h2>
                                <p>We use your data for the following purposes:</p>
                                <ul>
                                    <li><i class="bi bi-check-circle"></i>To provide and manage your access to courses and learning materials.</li>
                                    <li><i class="bi bi-check-circle"></i>To process transactions and ensure secure payments.</li>
                                    <li><i class="bi bi-check-circle"></i>To send notifications about course updates, promotions, and important announcements.</li>
                                    <li><i class="bi bi-check-circle"></i>To analyze usage patterns and improve our platform.</li>
                                    <li><i class="bi bi-check-circle"></i>To comply with legal and regulatory requirements.</li>
                                </ul>
        
                                <h2>4. Data Sharing and Disclosure</h2>
                                <p>We do not sell your personal information. However, we may share data with:</p>
                                <ul>
                                    <li><i class="bi bi-check-circle"></i>Third-party service providers for payment processing, analytics, and platform functionality.</li>
                                    <li><i class="bi bi-check-circle"></i>Legal authorities if required by law.</li>
                                </ul>
        
                                <h2>5. Security Measures</h2>
                                <p>We implement multiple security measures, including:</p>
                                <ul>
                                    <li><i class="bi bi-check-circle"></i>Data encryption for sensitive information.</li>
                                    <li><i class="bi bi-check-circle"></i>Regular security audits and monitoring.</li>
                                    <li><i class="bi bi-check-circle"></i>Secure third-party payment gateways.</li>
                                </ul>
        
                                <h2>6. Your Rights and Choices</h2>
                                <p>Depending on your location, you may have the following rights:</p>
                                <ul>
                                    <li><i class="bi bi-check-circle"></i>Access your personal data.</li>
                                    <li><i class="bi bi-check-circle"></i>Request correction or deletion of your data.</li>
                                    <li><i class="bi bi-check-circle"></i>Opt out of marketing communications.</li>
                                    <li><i class="bi bi-check-circle"></i>Restrict data processing in certain cases.</li>
                                </ul>
        
                                <h2>7. Children's Privacy</h2>
                                <p>CodePilot is not intended for users under the age of 13. If we discover data from a child, we
                                    will take steps to remove it.</p>
        
                                <h2>8. Changes to This Policy</h2>
                                <p>We may update this Privacy Policy periodically. Any changes will be posted on this page, and we
                                    encourage you to review it regularly.</p>
        
                                <h2>9. Contact Us</h2>
                                <p>If you have any questions regarding this Privacy Policy, please contact us at
                                    <a href="mailto:support@CodePilot.com">support@CodePilot.com</a>.</p>
                            </div>
                        </div>
                    </div>
                </section><!-- End Privacy Policy Content -->
    </main>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>
@endsection