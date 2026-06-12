<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | CodePilot</title>
    @include('front.layout.head-css')
</head>

@section('body')
    @include('admin.layouts.body')
@show
@include('front.layout.header')
@yield('content')
@include('front.layout.footer')
</body>
@include('front.layout.vendor-script')
</html>
