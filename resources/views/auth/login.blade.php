<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<meta name="description" content="description">
	<meta name="author" content="Evgeniya">
	<meta name="keyword" content="keywords">
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
						<div class="text-center logo_login">
							<img src="./img/escudounlu.png" alt="Logo" />
						</div>
						<div class="text-center">
							<h3 class="page-header">UNLu Trabajo</h3>
						</div>
						{!!Form::open(['route' => 'auth.login','method' => 'POST'])!!}

						@include('template.partials.errors')

						<div class="form-group">
							{!! Form::label('email','E-mail') !!}
							{!! Form::text('email',null,['class' => 'form-control', 'placeholder' => 'example@correo.com', 'autocomplete' => 'off', 'required'])!!}
						</div>
						<div class="form-group">
							{!! Form::label('password','Password') !!}
							<input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required>
						</div>
						<div class="text-center">
							{!! Form::submit('Acceder',['class' => 'btn btn-success']) !!}
						</div>

						{!!Form::close()!!}
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
