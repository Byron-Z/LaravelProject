<!DOCTYPE html>

<html>
	<head>
		<title>Fancy Blog</title>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/font-awesome.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/customized.css') }}" />
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    	<style>
    		body { padding-top: 70px; }
    	</style>
    	<!-- Scripts -->
		<script src="{{ URL::asset('bootstrap/js/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
		<!-- include summernote css/js-->
		<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
		<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
		
		<script src="{{ URL::asset('bootstrap/js/customized.js') }}"></script>
	</head>
	<body>
		@include('layouts.nav')

		@yield('main')

		<hr>
		@include('layouts.footer')
	</body>
</html>