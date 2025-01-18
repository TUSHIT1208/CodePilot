<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, shrink-to-fit=9">
  <meta name="description" content="Cursus - Change Password">
  <meta name="author" content="Gambolthemes">
  <title>Cursus - Change Password</title>

  <!-- Favicon Icon -->
  <link rel="icon" type="image/png" href="{{ asset('images/fav.png') }}">

  <!-- Stylesheets -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,500" rel="stylesheet">
  <link href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" rel="stylesheet">
  <link href="{{ asset('vendor/unicons-2.0.1/css/unicons.css') }}" rel="stylesheet">
  <link href="{{ asset('css/vertical-responsive-menu.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
  <link href="{{ asset('css/night-mode.css') }}" rel="stylesheet">

  <!-- Vendor Stylesheets -->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/OwlCarousel/assets/owl.carousel.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/OwlCarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-select/docs/docs/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/semantic/semantic.min.css') }}" rel="stylesheet">

</head>

<body class="sign_in_up_bg">
  <!-- Change Password Start -->
  <div class="container">
    <div class="row justify-content-lg-center justify-content-md-center">
      <div class="col-lg-12">
        <div class="main_logo25" id="logo">
          <a href="index.html"><img src="images/logo.svg" alt=""></a>
          <a href="index.html"><img class="logo-inverse" src="images/ct_logo.svg" alt=""></a>
        </div>
      </div>

      <div class="col-lg-6 col-md-8">
        <div class="sign_form">
          <h2>Change Your Password</h2>
          @if (session('success'))
        <div class="alert alert-dark">
        {{ session('success') }}
        </div>
      @endif
          @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
        </ul>
        </div>
      @endif
          <!-- Form for changing password -->
          <form method="POST" action="{{ route('changePassword.update') }}">
            @csrf
            <!-- Current Password -->
            <div class="ui search focus mt-50">
              <div class="ui left icon input swdh95">
                <input class="prompt srch_explore @error('currentPassword') is-invalid @enderror" type="password"
                  name="currentPassword" value="{{ old('currentPassword') }}" id="currentPassword" maxlength="64"
                  placeholder="Current Password">
                <i class="uil uil-lock icon icon2"></i>
              </div>
              @error('currentPassword')
          <strong class="text-danger">{{ $message }}</strong>
        @enderror
            </div>

            <!-- New Password -->
            <div class="ui search focus mt-30">
              <div class="ui left icon input swdh95">
                <input class="prompt srch_explore @error('newPassword') is-invalid @enderror" type="password"
                  name="newPassword" id="newPassword" maxlength="64" placeholder="New Password">
                <i class="uil uil-lock icon icon2"></i>
              </div>
              @error('newPassword')
          <strong class="text-danger">{{ $message }}</strong>
        @enderror
            </div>

            <!-- Confirm New Password -->
            <div class="ui search focus mt-30">
              <div class="ui left icon input swdh95">
                <input class="prompt srch_explore @error('newPassword_confirmation') is-invalid @enderror"
                  type="password" name="newPassword_confirmation" id="confirmPassword" maxlength="64"
                  placeholder="Confirm New Password">
                <i class="uil uil-lock icon icon2"></i>
              </div>
              @error('newPassword_confirmation')
          <strong class="text-danger">{{ $message }}</strong>
        @enderror
            </div>

            <!-- Submit Button -->
            <button class="login-btn" type="submit">Change Password</button>
          </form>

          <p class="mb-0 mt-30">Go Back <a href="{{ route('login')}}">Sign In</a></p>
        </div>
        <div class="sign_footer"><img src="images/sign_logo.png" alt="">© 2024 <strong>Cursus</strong>. All Rights
          Reserved.</div>
      </div>
    </div>
  </div>
  <!-- Change Password End -->

  <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/OwlCarousel/owl.carousel.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js') }}"></script>
  <script src="{{ asset('vendor/semantic/semantic.min.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  <script src="{{ asset('js/night-mode.js') }}"></script>


</body>

</html>