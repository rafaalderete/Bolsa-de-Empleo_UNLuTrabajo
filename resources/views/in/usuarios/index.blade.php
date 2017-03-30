@extends('template.in_main')

@section('headTitle', 'Usuarios | Tabla de Usuarios')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Usuarios</a></li>
        <li><a>Tabla de Usuarios</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')

  <div class="row">
    <!-- Box -->
    <div class="box" style="margin-top: -20px">
      <!-- Cuerpo del Box-->
      <div class="box-content dropbox">
        <!-- Titulo del Cuerpo del Box -->
        <h4 class="page-header">Tabla de Usuarios
          @if(count($personas) > 0)
            @if(Entrust::can('crear_usuario'))
              <a href="{{ route('in.usuarios.create') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
                <span><i class="fa fa-plus"></i></span>
                Registar Usuario
              </a>
            @endif
          @endif
        </h4>
        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')
        @if(count($personas) > 0)
          <!-- Tabla -->
          <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="dev-table">
            <!-- columnas de la tabla -->
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre Usuario</th>
                <th>Persona</th>
                <th>Email</th>
                <th>Estado</th>
                <th style="width:75px">Acción</th>
              </tr>
            </thead>
            <!-- contenido de la tabla -->
            <tbody>
              @foreach( $usuarios as $usuario)
                <tr>
                  <td>{{ $usuario->id }}</td>
                  <td>{{ $usuario->nombre_usuario }}</td>
                  @if($usuario->persona->tipo_persona == 'fisica')
                    <td>{{ $usuario->persona->fisica->nombre_persona.' '.$usuario->persona->fisica->apellido_persona }}</td>
                  @else
                    <td>{{ $usuario->persona->juridica->nombre_comercial }}</td>
                  @endif
                  <td>{{ $usuario->email }}</td>
                  <td>{{ $usuario->estado_usuario }}</td>
                  <!-- envio el parametro del metodo edit y destroy-->
                  <td>
                    @if( (Entrust::can('modificar_usuario') && (!$usuario->hasRole('super_usuario'))) || (Entrust::hasRole('super_usuario')) )
                      <a href="{{ route('in.usuarios.edit', $usuario->id) }}" class="btn btn-primary"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                    @endif
                    @if( (Entrust::can('eliminar_usuario') && (!$usuario->hasRole('super_usuario'))) || (Entrust::hasRole('super_usuario')) )
                      {!! Form::open(['route' => ['in.usuarios.destroy', $usuario->id], 'method' => 'DELETE', 'style' => "display: inline-block"]) !!}
                      <a href="" class="btn btn-danger" data-toggle="modal" data-target="#delSpk" data-title="Eliminar Usuario"
                        data-message="¿Seguro que quiere eliminar el Usuario {{$usuario->nombre_usuario}}?"><span class=" fa fa-trash-o" aria-hidden="true"></span></a>
                      {!! Form::close() !!}
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <div class="text-center">
            <span>Debe crear al menos una Persona para poder crear un Usuario.</span>
          </div>
        @endif
      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('plugins/datatables/ZeroClipboard.js')}}"></script>
  <script src="{{asset('plugins/datatables/TableTools.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>

  <script type="text/javascript">
  // Run Datables plugin and create 3 variants of settings
  $(document).ready(function(){

    //Modal
    $('#delSpk').on('show.bs.modal', function (e) {
      $message = $(e.relatedTarget).attr('data-message');
      $(this).find('.modal-body p').text($message);
      $title = $(e.relatedTarget).attr('data-title');
      $(this).find('.modal-title').text($title);
      var form = $(e.relatedTarget).closest('form');
      $(this).find('.modal-footer #confirm').data('form', form);
    });
    $('#delSpk').find('.modal-footer #confirm').on('click', function(){
      $(this).data('form').submit();
    });

    // Tabla
    $('#dev-table').dataTable( {
      "bStateSave": "false",
      "aaSorting": [[ 0, "asc" ]],
      "sDom": "<'pull-left'f><'pull-right'l>rt<'text-center'p>",
      "sPaginationType": "bootstrap",
      "oLanguage": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     '<select><option value="5">5</option>'+
        '<option value="10">10</option>'+
        '<option value="25">25</option></select>',
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "",
        "sInfo":           "",
        "sInfoEmpty":      "",
        "sInfoFiltered":   "",
        "sInfoPostFix":    "",
        "sSearch":         "",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  "",
          "sSortDescending": ""
        }
      },
    });

    // Multiseletc para la tabla
    $('select').select2();
    $('.dataTables_filter').each(function(){
      $(this).find('label input[type=text]').attr('placeholder', 'Buscar');
    });
  });

  </script>

@endsection
