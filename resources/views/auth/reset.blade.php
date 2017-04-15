@extends('template.auth_main')

@section('headTitle', 'Restablecer Contraseña')

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
            {!! Form::open(['route' => 'password.reset']) !!}

						@include('flash::message')
						@include('template.partials.errors')

            {!!Form::hidden('token',$token,null)!!}

            {!!Form::hidden('email',$_GET['email'],null)!!}

						<div class="form-group">
              {!! Form::label('password','Contraseña') !!}
							{!!Form::password('password', ['class' => 'form-control', 'placeholder' => '********', 'autocomplete' => 'off', 'required'])!!}
						</div>
            <div class="form-group">
              {!! Form::label('password_confirmation','Confirmar Contraseña') !!}
							{!!Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => '********', 'autocomplete' => 'off', 'required'])!!}
						</div>
						<div class="text-center">
							{!! Form::submit('Restablecer Contraseña',['class' => 'btn btn-success']) !!}
						</div>

						{!!Form::close()!!}
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
