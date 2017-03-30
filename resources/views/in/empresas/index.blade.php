@extends('template.in_main')

@section('headTitle', 'Empresas | Tabla de Empresas')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Empresas</a></li>
        <li><a>Tabla de Empresas</a></li>
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
        <h4 class="page-header">Tabla de Empresas
        @if(Entrust::can('crear_empresa'))
          <a href="{{ route('in.empresas.create') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
            <span><i class="fa fa-plus"></i></span>
            Registar Empresa
          </a>
        @endif
        </h4>
        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')
        <!-- Tabla -->
        <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="dev-table">
          <!-- columnas de la tabla -->
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre Comercial</th>
              <th>Rubro Empresarial</th>
              <th>Domicilio</th>
              <th>Telefono</th>
              <th>Estado</th>
              <th style="width:75px">Acción</th>
            </tr>
          </thead>
          <!-- contenido de la tabla -->
          <tbody>
            @foreach( $pjuridicas as $pjuridica)
              <tr>
                <td>{{ $pjuridica->id }}</td>
                <td>{{ $pjuridica->nombre_comercial }}</td>
                <td>{{ $pjuridica->rubroEmpresarial->nombre_rubro_empresarial }}</td>
                <td>{{ $pjuridica->persona->direccion->domicilio }}</td>
                <td>{{ $pjuridica->persona->telefonos[0]->nro_telefono }}</td>
                <td>{{ $pjuridica->persona->estado_persona }}</td>
                <!-- envio el parametro del metodo edit y destroy-->
                <td>
                  @if(Entrust::can('modificar_empresa'))
                    <a href="{{ route('in.empresas.edit', $pjuridica->id) }}" class="btn btn-primary"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                  @endif
                  @if(Entrust::can('eliminar_empresa'))
                    {!! Form::open(['route' => ['in.empresas.destroy', $pjuridica->persona_id], 'method' => 'DELETE', 'style' => "display: inline-block"]) !!}
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#delSpk" data-title="Eliminar Empresa"
                    data-message="¿Seguro que quiere eliminar la Empresa {{$pjuridica->nombre_comercial}}?"><span class=" fa fa-trash-o" aria-hidden="true"></span></a>
                    {!! Form::close() !!}
                  @endif
              </tr>
            @endforeach
          </tbody>
        </table>
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
