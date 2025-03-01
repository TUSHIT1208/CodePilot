<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Codepilot</title>
    @include('instructor.layouts.head-css')
    <script src="{{ asset('js/vertical-responsive-menu.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

</head>

@section('body')    
@include('instructor.layouts.body')
@show

@include('instructor.layouts.header')
@include('instructor.layouts.left_sidebar')

@yield( 'content')

@include('instructor.layouts.vendor-script')

</body>

</html>