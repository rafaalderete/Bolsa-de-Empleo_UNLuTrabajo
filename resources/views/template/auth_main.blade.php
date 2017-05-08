<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="UTF-8">

	<title>@yield('headTitle','Default')</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="{{asset('img/escudounlu.png')}}"/>
	<link rel="stylesheet" href="{{asset('plugins/bootstrap/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('http://fonts.googleapis.com/css?family=Righteous')}}" >
	<link rel="stylesheet" href="{{asset('plugins/select2/select2.css')}}">
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
	<link rel="stylesheet" href="{{asset('css/style-no-template.css')}}">

</head>
<body>

	@yield('bodyContent')

	@include('template.partials.footer')

	<!--End Container-->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <!--<script src="http://code.jquery.com/jquery.js"></script>-->
  <script src="{{asset('plugins/jquery/jquery.js')}}"></script>
  <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>
  <script src="{{asset('plugins/select2/select2.js')}}"></script>

	@yield('bodyJS')

</body>
</html>
