<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="UTF-8">

	<title>@yield('headTitle','Default')</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{asset('plugins/bootstrap/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('http://fonts.googleapis.com/css?family=Righteous')}}" >
	<link rel="stylesheet" href="{{asset('plugins/fancybox/jquery.fancybox.css')}}">
	<link rel="stylesheet" href="{{asset('plugins/fullcalendar/fullcalendar.css')}}">
	<link rel="stylesheet" href="{{asset('plugins/xcharts/xcharts.min.css')}}">
	<link rel="stylesheet" href="{{asset('plugins/select2/select2.css')}}">
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
	<link rel="stylesheet" href="{{asset('css/style-no-template.css')}}">
	<link rel="stylesheet" href="{{asset('plugins/orbit/css/styles-3.css')}}" >
	<link rel="stylesheet" href="{{asset('plugins/summernote/summernote.css')}}">
</head>
<body>

	@include('template.partials.header')

	<!--Start Container-->
	<div id="main" class="container-fluid">
		<div class="row">
			@if (Auth::user()->hasRole('super_usuario') || Auth::user()->hasRole('administrador'))
				@include('template.partials.sidebar')
				<!--Start Content-->
				<div id="content" class="col-xs-12 col-sm-10">
			@else
				<div id="content" class="col-xs-12 col-sm-12">
			@endif
				<!--Start Indice-->
				@yield('bodyIndice')
				<!--End Indice-->

				<!--Start Contenido-->
				<section>
					<div class="panel-body">
						@yield('bodyContent')
					</div>
				</section>

				<!--End Contenido-->
			</div>
			<!--Agregar Etiqueta para el Modal si es necesario-->
			@include('template.partials.modal')
		</div>
	</div>

	<!--End Container-->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<!--<script src="http://code.jquery.com/jquery.js"></script>-->
	<script src="{{asset('plugins/jquery/jquery.js')}}"></script>
	<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>
	<script src="{{asset('plugins/justified-gallery/jquery.justifiedgallery.min.js')}}"></script>
	<script src="{{asset('plugins/summernote/summernote.js')}}"></script>
	<script src="{{asset('plugins/summernote/lang/summernote-es-ES.js')}}"></script>
	<!-- All functions for this theme + document.ready processing -->
	<script src="{{asset('js/devoops.js')}}"></script>
	<!-- Se Agregaron -->
	<script src="{{asset('plugins/select2/select2.js')}}"></script>

	@yield('bodyJS')

</body>
</html>
