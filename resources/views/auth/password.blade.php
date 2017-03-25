@extends('template.auth_main')

@section('headTitle', 'Mail para restablecer Contraseña')

@section('bodyContent')

	<div class="container-fluid">
		<div id="page-login" class="row">
			<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="box">
					<div class="box-content">
						<div class="text-center">
							<h3 class="page-header">UNLu Trabajo</h3>
						</div>
            {!! Form::open(['route' => 'password.email']) !!}

						@include('flash::message')
						@include('template.partials.errors')

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

@endsection
