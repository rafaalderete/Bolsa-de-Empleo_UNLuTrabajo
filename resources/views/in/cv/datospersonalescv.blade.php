@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Gestionar CV | Datos Personales')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Datos Personales</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')


<div class="row" style="margin-top:-20px">
  <!-- Box -->
  <div class="box no-box-shadow">
    <!-- Cuerpo del Box-->

    @include('template.partials.sidebar-gestionarcv')

    <div class="box-content dropbox">
      <h4 class="page-header">Datos Personales</h4>

      <div class="form-group col-sm-12">
          {!! Form::label('nombre_persona','Nombre: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <span>{{$pfisica->nombre_persona}}</span>
          </div>
          {!! Form::label('apellido_persona','Apellido: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <span>{{$pfisica->apellido_persona}}</span>
          </div>
      </div>

      <div class="form-group col-sm-12">
          {!! Form::label('nombre_persona','Fecha Nacimiento: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <span>{{$pfisica->fecha_nacimiento}}</span>
          </div>
          {!! Form::label('apellido_persona','Documento: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <span>{{$pfisica->tipoDocumento->nombre_tipo_documento}}</span> -
            <span>{{$pfisica->nro_documento}}</span>
          </div>
      </div>

      <div class="form-group col-sm-12">
          {!! Form::label('nombre_persona','Domicilio: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <span>{{$pfisica->persona->direccion->domicilio}}</span>
          </div>
          {!! Form::label('apellido_persona','Localidad: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <span>{{$pfisica->persona->direccion->localidad}}</span>
          </div>
      </div>

      <div class="form-group col-sm-12">
          {!! Form::label('nombre_persona','Telefono Fijo: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <span>{{$telefono_fijo}}</span>
          </div>
          {!! Form::label('apellido_persona','Celular: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <span>{{$telefono_celular}}</span>
          </div>
      </div>

      <div class="form-group col-sm-12">
          {!! Form::label('nombre_persona','E-Mail: ', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <span>{{Auth::user()->email}}</span>
          </div>
          {!! Form::label('imagen','Imagen: ', ['class' => 'col-sm-2 control-label'])!!}
          <div class="col-sm-4">
            <div class="row">
              <div class="col-sm-12">
                {!!Form::hidden('img_default',asset('/img/fotoPerfil.jpg'),['id' => 'img_default'])!!}
                {!!Form::hidden('imagen_cambiada',0,['id' => 'imagen_cambiada'])!!}
                @if ((Auth::user()->imagen == null))
                  {!!Form::hidden('img_usuario_anterior',asset('/img/fotoPerfil.jpg'),['id' => 'img_usuario_anterior'])!!}
                  <div class="avatar-grande">
                    <img id="imagen_usuario" src={{asset('/img/fotoPerfil.jpg')}} class='img-rounded' alt="Avatar" />
                  </div>
                @else
                  {!!Form::hidden('img_usuario_anterior',asset('img/usuarios'.'/'.Auth::user()->imagen),['id' => 'img_usuario_anterior'])!!}
                  <div class="avatar-grande">
                    <img id="imagen_usuario" src={{asset('img/usuarios'.'/'.Auth::user()->imagen)}} class='img-rounded' alt="Avatar" />
                  </div>
                @endif
              </div>
            </div>
          </div>
      </div>

    </div>
  </div>
</div>

@endsection
