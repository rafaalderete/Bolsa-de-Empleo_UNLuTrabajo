@extends('template.in_main')

@section('headTitle', 'Usuarios | Editar Usuario')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Usuarios</a></li>
        <li><a>Editar Usuario</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')

  <div class="row" style="margin-top:-20px">
    <!-- Box -->
    <div class="box">
      <!-- Cuerpo del Box-->
      <div class="box-content dropbox">
        <h4 class="page-header">Editar Usuario - {{$usuario->nombre_usuario}}</h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => ['in.usuarios.update', $usuario], 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}

          <div class="form-group">
            {!! Form::label('nombre_usuario','Nombre', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('nombre_usuario',$usuario->nombre_usuario, ['class' => 'form-control', 'placeholder' => 'Nombre Usuario', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'required'])!!}
            </div>
            {!! Form::label('persona_id','Persona/Empresa', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::select('persona_id',$personas, $my_persona, ['id' => 'selectPersona', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('email','E-mail', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('email', $usuario->email, ['class' => 'form-control', 'placeholder' => 'yyyy@xxxx.zzz', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('roles','Roles Asignados', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::select('roles[]',$roles, $my_roles, ['multiple', 'id' => 'selectRoles', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('imagen','Imagen', ['class' => 'col-sm-2 control-label'])!!}
            <div class="col-sm-4">
              <div class="row">
                <div class="col-sm-6">
                  <div class="row">
                    <div class="col-sm-12">
                      {!!Form::hidden('img_default',asset('/img/fotoPerfil.jpg'),['id' => 'img_default'])!!}
                      {!!Form::hidden('imagen_cambiada',0,['id' => 'imagen_cambiada'])!!}
                      @if (($usuario->imagen == null))
                        {!!Form::hidden('img_usuario_anterior',asset('/img/fotoPerfil.jpg'),['id' => 'img_usuario_anterior'])!!}
                        <div class="avatar-grande">
                          <img id="imagen_usuario" src={{asset('/img/fotoPerfil.jpg')}} class='img-rounded' alt="Avatar" />
                        </div>
                      @else
                        {!!Form::hidden('img_usuario_anterior',asset('img/usuarios'.'/'.$usuario->imagen),['id' => 'img_usuario_anterior'])!!}
                        <div class="avatar-grande">
                          <img id="imagen_usuario" src={{asset('img/usuarios'.'/'.$usuario->imagen)}} class='img-rounded' alt="Avatar" />
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="row eliminar_imagen">
                    <div class="col-sm-12">
                      <span class="fa fa-trash-o" aria-hidden="true"><a>Eliminar Imagen</a></span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="imagen-info">
                    <p>La imagen debe ser jpeg, png, bmp, gif, o svg y no pesar más de 500kb</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  {!! Form::file('imagen', ['id' => 'imgInp']) !!}
                </div>
              </div>
              <div class="row error-imagen">
                <div class="col-sm-12">
                  <span>La imagen debe pesar menos de 500kb</span>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group" style="margin-top: -5px">
            {!! Form::label('estado_usuario','Estado', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              <!-- ES mas facil hacerlo con etiqutas -->
              {!! Form::select('estado_usuario', ['' => '','activo'=>'Activo', 'inactivo'=>'Inactivo'], $usuario->estado_usuario, ['class'=>'populate placeholder', 'id'=>'selectEstado'] ) !!}﻿
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-2">
              <button type="submit" class="btn btn-info btn-label-left">
                <span><i class="fa fa-check-square"></i></span>
                Aceptar
              </button>
            </div>
            <div class="col-sm-2">
              <button type="reset" class="btn btn-default btn-label-left" id="reset">
                <span><i class="fa fa-times-circle txt-danger"></i></span>
                Restablecer
              </button>
            </div>
          </div>

        {!! Form::close()!!}

        <a href="{{ route('in.usuarios.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver a la Tabla
        </a>
      </div>
    </div>
  </div>

@endsection


@section('bodyJS')

  <script type="text/javascript">

    $(document).ready(function() {

      $('#selectPersona').on('change', function() {
        var select = $("#selectRoles");
        select.select2('data', null);
        var url = '../../getRoles';
        var data = {
          "persona_id": this.value
        }

        $.get (url,data,function (result) {
          select.empty();
          $.each(result.roles, function(index,value) {
            select.append($("<option></option>")
               .attr("value", index).text(value));
            select.prop('disabled', false);
          });
        })

      });

      function readURL(input) {
        if (input.files && input.files[0]) {
          if (input.files[0].size > 512000) {
            $('.error-imagen').css('visibility', 'visible');
            $('#imgInp').val(null);
            $('#imagen_cambiada').val(0);
          }
          else {
            $('#imagen_cambiada').val(1);
            var reader = new FileReader();

            reader.onload = function (e) {
              $('#imagen_usuario').attr('src', e.target.result);
              $('.error-imagen').css('visibility', 'hidden');
            }

            reader.readAsDataURL(input.files[0]);
          }
        }
      }

      $("#imgInp").change(function(){
          readURL(this);
      });

      $('.eliminar_imagen').click(function() {
        $('#imgInp').val(null);
        $('#imagen_usuario').attr('src', $('#img_default').val());
        $('#imagen_cambiada').val(1);
      });

      $('#reset').click(function() {
        $('#imgInp').val();
        $('#imagen_usuario').attr('src', $('#img_usuario_anterior').val());
        $('#imagen_cambiada').val(0);
      });

      // Select
      $('#selectPersona').select2({
        placeholder: "Persona"
      });


      $('#selectRoles').select2({
        placeholder: "Asignar Roles"
      });

      $('#selectEstado').select2({
        placeholder: "Estado"
      });

    });

  </script>

@endsection
