<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <title>@yield('title') | Codepilot</title>
    @include('admin.layouts.head-css')
    <script src="{{ asset('js/vertical-responsive-menu.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
</head>

@section('body')
@include('admin.layouts.body')
@show

   @include('admin.layouts.header')
@include('admin.layouts.left_sidebar')

@yield(section: 'content')

@include('admin.layouts.vendor-script')

</body>

</html>