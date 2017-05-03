@extends('template.in_main')

@section('headTitle', 'Usuario | Registrar Usuario')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Usuarios</a></li>
        <li><a>Registrar Usuario</a></li>
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
      <h4 class="page-header">Registro de Usuario</h4>

      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <!-- Formulario -->
      {!! Form::open(['route' => 'in.usuarios.store', 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true]) !!}

        <div class="form-group">
          {!! Form::label('nombre_usuario','Nombre Usuario', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('nombre_usuario',null,['class' => 'form-control', 'placeholder' => 'Nombre Usuario', 'data-toggle' => "tooltip", 'data-placement' => "bottom", 'required'])!!}
          </div>
          {!! Form::label('persona_id','Persona/Empresa', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            <select name="persona_id" class="populate placeholder" id="selectPersona" required>
              <option value=""></option>
              @foreach( $personas as $persona)
                @if($persona->tipo_persona == 'fisica')
                  <option value="{{$persona->id}}">{{$persona->fisica->nombre_persona.' '.$persona->fisica->apellido_persona}}</option>
                @else
                  <option value="{{$persona->id}}">{{$persona->juridica->nombre_comercial}}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('email','E-mail', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'ejemplo@correo.com', 'required'])!!}
          </div>
          {!! Form::label('password','Contraseña', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('password',null,['class' => 'form-control', 'placeholder' => '*********', 'required'])!!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('roles','Roles Asignados', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::select('roles[]',['none'], null, ['multiple', 'disabled', 'class' =>'populate placeholder', 'id' => 'selectRoles', 'required'])!!}
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
                    <div class="avatar-grande">
                      <img id="imagen_usuario" src={{asset('/img/fotoPerfil.jpg')}} class='img-rounded' alt="Avatar" />
                    </div>
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

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-2">
            <button type="submit" class="btn btn-primary btn-label-left">
              <span><i class="fa fa-check-square"></i></span>
              Aceptar
            </button>
          </div>
          <div class="col-sm-2">
            <button type="reset" class="btn btn-default btn-label-left" id="reset">
              <span><i class="fa fa-times-circle txt-danger"></i></span>
              Borrar
            </button>
          </div>
        </div>

      {!! Form::close()!!}

      <a href="{{ route('in.usuarios.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
        <span><i class="fa fa-reply"></i></span>
        Volver a la Tabla</a>
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
      var url = '../getRoles';
      var data = {
        "persona_id": this.value
      }

      $.get (url,data,function (result) {

        select.empty(); // remove old options
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
        }
        else {
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
    });

    $('#reset').click(function() {
      $('#imgInp').val(null);
      $('#imagen_usuario').attr('src', $('#img_default').val());
    });

    $('#selectRoles').select2({
      placeholder: "Roles",
    });

    $('#selectPersona').select2({
      placeholder: "Persona"
    });

  });

</script>

@endsection
