<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="UTF-8">

	<title>@yield('headTitle','Default')</title>

	@yield('headContent')

</head>
<body>

	@yield('bodyHeader')


	<!--Start Container-->
	<div id="main" class="container-fluid">
	    <div class="row">

	    	@yield('bodySidebar')

	   	    <!--Start Content-->
	        <div id="content" class="col-xs-12 col-sm-10">

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

	@yield('bodyJS')

</body>
</html>
