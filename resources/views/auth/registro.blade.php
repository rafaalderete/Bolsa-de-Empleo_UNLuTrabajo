@extends('template.auth_main')

@section('headTitle', 'Registro')

@section('bodyContent')

	<div class="container-fluid">
		<div id="page-login" class="row">
			<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="box">
					<div class="box-content">
						<div class="text-center">
							<h3 class="page-header">UNLu Trabajo</h3>
						</div>
						{!!Form::open(['route' => 'registro','method' => 'POST'])!!}

						@include('flash::message')
						@include('template.partials.errors')

						<div class="row">
							<div class="form-group">
								{!! Form::label('nombre_persona','Nombre', ['class' => 'col-sm-2 control-label']) !!}
								<div class="col-sm-4">
									{!! Form::text('nombre_persona',null,['class' => 'form-control', 'placeholder' => 'Nombre', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'required'])!!}
								</div>
								{!! Form::label('apellido_persona','Apellido', ['class' => 'col-sm-2 control-label']) !!}
								<div class="col-sm-4">
									{!! Form::text('apellido_persona',null,['class' => 'form-control', 'placeholder' => 'Apellido', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'required'])!!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								{!! Form::label('legajo','Legajo', ['class' => 'col-sm-2 control-label']) !!}
								<div class="col-sm-4">
									{!! Form::text('legajo',null,['class' => 'form-control', 'placeholder' => 'N°Legajo', 'required'])!!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
									{!! Form::label('email','Email', ['class' => 'col-sm-2 control-label']) !!}
								<div class="col-sm-10">
									{!! Form::text('email',null,['class' => 'form-control', 'placeholder' => 'example@correo.com', 'autocomplete' => 'off', 'required'])!!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								{!! Form::label('tipo_documento','Documento', ['class' => 'col-sm-3 control-label']) !!}
								<div class="col-sm-3">
									<select name="tipo_documento" class="populate placeholder" id="selectSimple" required>
										<option value=""></option>
										@foreach($tipos_documento as $tipo_documento)
											<option value="{{$tipo_documento->id}}">{{$tipo_documento->nombre_tipo_documento}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-6">
									{!! Form::text('nro_documento_persona', null, ['class' => 'form-control', 'placeholder' => 'N° Documento', 'required'])!!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								{!! Form::label('nombre_usuario','Nombre de Usuario', ['class' => 'col-sm-3 control-label']) !!}
								<div class="col-sm-7">
									{!! Form::text('nombre_usuario',null,['class' => 'form-control', 'placeholder' => 'Nombre de Usuario', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'required'])!!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								{!! Form::label('password','Password', ['class' => 'col-sm-3 control-label']) !!}
								<div class="col-sm-5">
									{!!Form::password('password', ['class' => 'form-control', 'placeholder' => '********', 'autocomplete' => 'off', 'required'])!!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								{!! Form::label('password_confirmation','Confirmar Password', ['class' => 'col-sm-3 control-label']) !!}
								<div class="col-sm-5">
										{!!Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => '********', 'autocomplete' => 'off', 'required'])!!}
								</div>
							</div>
						</div>
						<div class="text-center">
							{!! Form::submit('Registrarse',['class' => 'btn btn-success']) !!}
						</div>

						{!!Form::close()!!}
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    $(document).ready(function() {

      // Select
      $('#selectSimple').select2({
        placeholder: "Tipo"
      });
    });

  </script>

@endsection
