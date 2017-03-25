@extends('template.auth_main')

@section('headTitle', 'Login')

@section('bodyContent')

	<div class="container-fluid">
		<div id="page-login" class="row">
			<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="box">
					<div class="box-content">
						<div class="text-center">
							<h3 class="page-header">UNLu Trabajo</h3>
						</div>
						{!!Form::open(['route' => 'auth.login','method' => 'POST'])!!}

						@include('flash::message')
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
						<div class="text-center">
							{!!link_to('password/email', $title = '¿Olvidaste tu contraseña?', $attributes = null, $secure = null)!!}
						</div>
						<div class="text-center">
							{!!link_to('registro', $title = 'Registrarse', $attributes = null, $secure = null)!!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
