<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="Gambolthemes">
	<meta name="author" content="Gambolthemes">
	<title>@yield('title') | CodePilot</title>
	@include('learner.layout.head-css')
	<script src="{{ asset('js/vertical-responsive-menu.min.js') }}"></script>
	<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

@section('body')
@include('learner.layout.body')
@show

@include('learner.layout.header')
@include('learner.layout.sidebar')	

@yield(	'content_learner')

@include('learner.layout.vendor-script')

</body>

</html>