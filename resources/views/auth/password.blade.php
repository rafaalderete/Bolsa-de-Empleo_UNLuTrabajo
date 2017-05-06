@extends('template.auth_main')

@section('headTitle', 'Mail para restablecer Contraseña')

@section('bodyContent')

	<div class="container-fluid">
		<div id="page-login" class="row fondo">
			<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="box">
					<div class="box-content">
						<div class="text-center">
							<h3 class="page-header">UNLu Trabajo</h3>
							<a href={{ route('auth.login') }}><img src="{{asset('img/escudounlu.png')}}" class="img-rounded logo-login" alt="Logo" /></a>
						</div>
            {!! Form::open(['route' => 'password.email']) !!}

						@include('flash::message')
						@include('template.partials.errors')

						<div class="form-group">
							<div class="mensaje-login text-center">
								<p>Ingresar el E-mail de su Usuario registrado.</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('email','E-mail') !!}
							{!! Form::text('email',null,['class' => 'form-control', 'placeholder' => 'ejemplo@correo.com', 'autocomplete' => 'off', 'required'])!!}
						</div>
						<div class="text-center">
							{!! Form::submit('Enviar',['class' => 'btn btn-info']) !!}
						</div>

						{!!Form::close()!!}
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
