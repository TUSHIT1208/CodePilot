<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <title>@yield('title') | codepilot</title>
    @include('admin.layouts.head-css')
    @include('admin.layouts.vendor-script')
</head>

@section('body')
@include('admin.layouts.body')
@show

@include('admin.layouts.header')
@include('admin.layouts.left_sidebar')
@yield(section: 'content')

</body>

</html>