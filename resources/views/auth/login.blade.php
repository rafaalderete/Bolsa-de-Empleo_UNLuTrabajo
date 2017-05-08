@extends('template.auth_main')

@section('headTitle', 'UNLu Trabajo - Login')

@section('bodyContent')

	<div class="container-fluid">
		<div id="page-login">
			<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="box">
					<div class="box-content">
						<div class="text-center">
							<h3 class="page-header">UNLu Trabajo</h3>
							<a href={{ route('auth.login') }}><img src="{{asset('img/escudounlu.png')}}" class="img-rounded logo-login" alt="Logo" /></a>
						</div>
						{!!Form::open(['route' => 'auth.login','method' => 'POST'])!!}

						@include('flash::message')
						@include('template.partials.errors')

						<div class="form-group">
							{!! Form::label('email','E-mail') !!}
							{!! Form::text('email',null,['class' => 'form-control', 'placeholder' => 'ejemplo@correo.com', 'required'])!!}
						</div>
						<div class="form-group">
							{!! Form::label('password','Contraseña') !!}
							<input type="password" name="password" class="form-control" placeholder="********" autocomplete="off" required>
						</div>
						<div class="text-center">
							{!! Form::submit('Acceder',['class' => 'btn btn-info']) !!}
						</div>

						{!!Form::close()!!}
						<div class="text-center">
							{!!link_to('password/email', $title = '¿Olvidaste tu contraseña?', $attributes = null, $secure = null)!!}
						</div>
						<div class="text-center">
							{!!link_to('registro-estudiante', $title = 'Registrarse', $attributes = null, $secure = null)!!}
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

@endsection
