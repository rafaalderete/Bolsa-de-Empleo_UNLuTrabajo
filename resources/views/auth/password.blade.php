<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Recuperar Contraseña</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{asset('plugins/bootstrap/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('http://fonts.googleapis.com/css?family=Righteous')}}" >
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
	<div class="container-fluid">
		<div id="page-login" class="row">
			<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="box">
					<div class="box-content">
						<div class="text-center">
							<h3 class="page-header">UNLu Trabajo</h3>
						</div>
            {!! Form::open(['route' => 'password.email']) !!}

						@include('template.partials.errors')
						@if(session('status'))
							<div class="alert alert-success">
								{{ session('status') }}
							</div>
						@endif

						<div class="form-group">
							{!! Form::label('email','E-mail') !!}
							{!! Form::text('email',null,['class' => 'form-control', 'placeholder' => 'example@correo.com', 'autocomplete' => 'off', 'required'])!!}
						</div>
						<div class="text-center">
							{!! Form::submit('Enviar',['class' => 'btn btn-success']) !!}
						</div>

						{!!Form::close()!!}
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
